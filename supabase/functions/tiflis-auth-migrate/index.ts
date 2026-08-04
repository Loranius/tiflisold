import "jsr:@supabase/functions-js/edge-runtime.d.ts";
import { createClient } from "https://esm.sh/@supabase/supabase-js@2";

const SUPABASE_URL = Deno.env.get("SUPABASE_URL") ?? "";
const SERVICE_ROLE_KEY = Deno.env.get("SUPABASE_SERVICE_ROLE_KEY") ?? "";
const ANON_KEY = Deno.env.get("SUPABASE_ANON_KEY") ?? "";

const admin = createClient(SUPABASE_URL, SERVICE_ROLE_KEY, {
  auth: { persistSession: false, autoRefreshToken: false },
});
const authClient = createClient(SUPABASE_URL, ANON_KEY, {
  auth: { persistSession: false, autoRefreshToken: false },
});

const CORS = {
  "Access-Control-Allow-Origin": "*",
  "Access-Control-Allow-Methods": "POST, OPTIONS",
  "Access-Control-Allow-Headers": "authorization, apikey, content-type, x-client-info",
  "Cache-Control": "no-store",
};
const WINDOW_MS = 15 * 60 * 1000;
const MAX_ATTEMPTS = 5;

function json(data: unknown, status = 200) {
  return new Response(JSON.stringify(data), {
    status,
    headers: { ...CORS, "Content-Type": "application/json; charset=utf-8" },
  });
}

function sleep(ms: number) {
  return new Promise((resolve) => setTimeout(resolve, ms));
}

async function sha256Hex(value: string) {
  const bytes = new TextEncoder().encode(value);
  const digest = await crypto.subtle.digest("SHA-256", bytes);
  return Array.from(new Uint8Array(digest))
    .map((b) => b.toString(16).padStart(2, "0"))
    .join("");
}

function timingSafeEqual(a: string, b: string) {
  const aa = new TextEncoder().encode(a);
  const bb = new TextEncoder().encode(b);
  let diff = aa.length ^ bb.length;
  const length = Math.max(aa.length, bb.length);
  for (let i = 0; i < length; i++) diff |= (aa[i] ?? 0) ^ (bb[i] ?? 0);
  return diff === 0;
}

async function rateKey(req: Request, login: string) {
  const ip = (req.headers.get("x-forwarded-for") || req.headers.get("cf-connecting-ip") || "unknown")
    .split(",")[0]
    .trim();
  return sha256Hex(`${ip}|${login.normalize("NFKC").toLocaleLowerCase("uk-UA")}`);
}

async function isBlocked(keyHash: string) {
  const { data } = await admin
    .from("auth_migration_attempts")
    .select("attempts,window_started,locked_until")
    .eq("key_hash", keyHash)
    .maybeSingle();

  if (!data) return false;
  const now = Date.now();
  if (data.locked_until && new Date(data.locked_until).getTime() > now) return true;
  if (now - new Date(data.window_started).getTime() > WINDOW_MS) {
    await admin.from("auth_migration_attempts").upsert({
      key_hash: keyHash,
      attempts: 0,
      window_started: new Date().toISOString(),
      locked_until: null,
      updated_at: new Date().toISOString(),
    });
  }
  return false;
}

async function registerFailure(keyHash: string) {
  const now = new Date();
  const { data } = await admin
    .from("auth_migration_attempts")
    .select("attempts,window_started")
    .eq("key_hash", keyHash)
    .maybeSingle();

  const windowExpired = !data || Date.now() - new Date(data.window_started).getTime() > WINDOW_MS;
  const attempts = windowExpired ? 1 : Number(data.attempts || 0) + 1;
  await admin.from("auth_migration_attempts").upsert({
    key_hash: keyHash,
    attempts,
    window_started: windowExpired ? now.toISOString() : data.window_started,
    locked_until: attempts >= MAX_ATTEMPTS ? new Date(Date.now() + WINDOW_MS).toISOString() : null,
    updated_at: now.toISOString(),
  });
}

async function clearFailures(keyHash: string) {
  await admin.from("auth_migration_attempts").delete().eq("key_hash", keyHash);
}

async function findOrCreateAuthUser(legacy: Record<string, unknown>, password: string) {
  const legacyId = String(legacy.id);
  const { data: existingProfile } = await admin
    .from("staff_profiles")
    .select("user_id")
    .eq("legacy_user_id", legacyId)
    .maybeSingle();

  let authUserId = existingProfile?.user_id as string | undefined;
  let email = "";

  if (authUserId) {
    const { data: existingUser, error } = await admin.auth.admin.getUserById(authUserId);
    if (error || !existingUser.user) throw new Error("Mapped Auth user is missing");
    email = existingUser.user.email || "";
    const { error: updateError } = await admin.auth.admin.updateUserById(authUserId, {
      password,
      email_confirm: true,
      user_metadata: { legacy_user_id: legacyId, source: "tiflis-legacy-migration" },
    });
    if (updateError) throw updateError;
  } else {
    const emailHash = await sha256Hex(`tiflis:${legacyId}`);
    email = `legacy-${emailHash.slice(0, 24)}@auth.tiflis.internal`;
    const { data: created, error } = await admin.auth.admin.createUser({
      email,
      password,
      email_confirm: true,
      user_metadata: { legacy_user_id: legacyId, source: "tiflis-legacy-migration" },
    });

    if (error) {
      const { data: listed, error: listError } = await admin.auth.admin.listUsers({ page: 1, perPage: 1000 });
      if (listError) throw error;
      const found = listed.users.find((user) => user.email === email);
      if (!found) throw error;
      authUserId = found.id;
      const { error: updateError } = await admin.auth.admin.updateUserById(authUserId, {
        password,
        email_confirm: true,
      });
      if (updateError) throw updateError;
    } else {
      authUserId = created.user.id;
    }
  }

  const forcedRole = legacyId === "sysadmin"
    ? "sysadmin"
    : (["admin", "sysadmin"].includes(String(legacy.role)) ? String(legacy.role) : String(legacy.role || "staff"));

  const { error: profileError } = await admin.from("staff_profiles").upsert({
    user_id: authUserId,
    legacy_user_id: legacyId,
    display_name: legacy.display_name || legacy.login || "Працівник",
    role: forcedRole,
    role2: legacy.role2 || null,
    active: legacy.fired !== true,
    can_notify: legacy.can_notify === true,
    updated_at: new Date().toISOString(),
  }, { onConflict: "user_id" });
  if (profileError) throw profileError;

  return { authUserId, email };
}

async function safeLegacyUser(legacyId: string) {
  const { data, error } = await admin
    .from("users")
    .select("id,login,role,role2,display_name,nick,avatar,tg_id,tg_username,chat_id,ig,fired,birthday,trainee_days,zodiac,can_notify,credo")
    .eq("id", legacyId)
    .single();
  if (error) throw error;
  if (legacyId === "sysadmin") data.role = "sysadmin";
  return data;
}

async function login(req: Request, body: Record<string, unknown>) {
  const loginValue = String(body.login || "").trim().normalize("NFKC");
  const password = String(body.password || "");
  const keyHash = await rateKey(req, loginValue || "empty");

  if (!loginValue || !password || await isBlocked(keyHash)) {
    await sleep(450);
    return json({ ok: false, error: "Невірний логін або пароль" }, 401);
  }

  const { data: legacy } = await admin
    .from("users")
    .select("id,login,password,role,role2,display_name,fired,can_notify")
    .eq("login", loginValue)
    .limit(1)
    .maybeSingle();

  const valid = Boolean(
    legacy &&
    legacy.fired !== true &&
    typeof legacy.password === "string" &&
    timingSafeEqual(password, legacy.password)
  );

  if (!valid) {
    await registerFailure(keyHash);
    await sleep(450);
    return json({ ok: false, error: "Невірний логін або пароль" }, 401);
  }

  try {
    const { email } = await findOrCreateAuthUser(legacy, password);
    const { data: signedIn, error: signInError } = await authClient.auth.signInWithPassword({ email, password });
    if (signInError || !signedIn.session) throw signInError || new Error("Session creation failed");
    await clearFailures(keyHash);

    return json({
      ok: true,
      session: {
        access_token: signedIn.session.access_token,
        refresh_token: signedIn.session.refresh_token,
        expires_at: signedIn.session.expires_at,
        expires_in: signedIn.session.expires_in,
        token_type: signedIn.session.token_type,
      },
      user: await safeLegacyUser(String(legacy.id)),
    });
  } catch (error) {
    console.error("legacy auth migration failed", error);
    return json({ ok: false, error: "Не вдалося створити захищену сесію" }, 500);
  }
}

async function refresh(body: Record<string, unknown>) {
  const refreshToken = String(body.refresh_token || "");
  if (!refreshToken) return json({ ok: false, error: "Сесію не знайдено" }, 401);

  const { data, error } = await authClient.auth.refreshSession({ refresh_token: refreshToken });
  if (error || !data.session || !data.user) return json({ ok: false, error: "Сесія завершилась" }, 401);

  const { data: profile } = await admin
    .from("staff_profiles")
    .select("legacy_user_id,active")
    .eq("user_id", data.user.id)
    .maybeSingle();
  if (!profile?.legacy_user_id || profile.active !== true) return json({ ok: false, error: "Доступ заблоковано" }, 403);

  return json({
    ok: true,
    session: {
      access_token: data.session.access_token,
      refresh_token: data.session.refresh_token,
      expires_at: data.session.expires_at,
      expires_in: data.session.expires_in,
      token_type: data.session.token_type,
    },
    user: await safeLegacyUser(profile.legacy_user_id),
  });
}

Deno.serve(async (req: Request) => {
  if (req.method === "OPTIONS") return new Response(null, { status: 204, headers: CORS });
  if (req.method !== "POST") return json({ ok: false, error: "Method not allowed" }, 405);

  try {
    const body = await req.json() as Record<string, unknown>;
    const action = String(body.action || "login");
    if (action === "login") return await login(req, body);
    if (action === "refresh") return await refresh(body);
    return json({ ok: false, error: "Unknown action" }, 400);
  } catch (error) {
    console.error("tiflis-auth-migrate request failed", error);
    return json({ ok: false, error: "Некоректний запит" }, 400);
  }
});
