try { localStorage.removeItem('tiflis_tg_token'); } catch(e) {}

// ╔═══════════════════════════════════════════════════════════════╗
// ║  PHASE 0 AUTH BRIDGE                                          ║
// ║  Одноразово мігрує старий логін у Supabase Auth і надалі      ║
// ║  зберігає лише JWT/refresh token — ніколи пароль.              ║
// ╚═══════════════════════════════════════════════════════════════╝
const AUTH_STORAGE_KEY = 'tiflis_auth_session_v1';
const AUTH_ENDPOINT = `${SUPA_URL}/functions/v1/tiflis-auth-migrate`;
const _nativeFetch = window.fetch.bind(window);

const AuthBridge = {
  _refreshTimer: null,

  _read() {
    try {
      const raw = localStorage.getItem(AUTH_STORAGE_KEY);
      return raw ? JSON.parse(raw) : null;
    } catch(e) { return null; }
  },

  _write(payload) {
    try { localStorage.setItem(AUTH_STORAGE_KEY, JSON.stringify(payload)); } catch(e) {}
    AuthBridge._scheduleRefresh(payload?.session);
  },

  clear() {
    if (AuthBridge._refreshTimer) clearTimeout(AuthBridge._refreshTimer);
    AuthBridge._refreshTimer = null;
    try { localStorage.removeItem(AUTH_STORAGE_KEY); } catch(e) {}
    try { localStorage.removeItem('tiflis_session'); } catch(e) {}
    try { sessionStorage.removeItem('tiflis_session'); } catch(e) {}
  },

  _scheduleRefresh(session) {
    if (AuthBridge._refreshTimer) clearTimeout(AuthBridge._refreshTimer);
    if (!session?.expires_at) return;
    const delay = Math.max(15_000, session.expires_at * 1000 - Date.now() - 90_000);
    AuthBridge._refreshTimer = setTimeout(() => {
      AuthBridge.refresh().catch(() => AuthBridge.clear());
    }, delay);
  },

  async _post(body) {
    const res = await _nativeFetch(AUTH_ENDPOINT, {
      method: 'POST',
      headers: {
        'apikey': SUPA_KEY,
        'Authorization': `Bearer ${SUPA_KEY}`,
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(body),
    });
    let data = null;
    try { data = await res.json(); } catch(e) {}
    if (!res.ok || !data?.ok) throw new Error(data?.error || 'Помилка захищеного входу');
    return data;
  },

  async login(login, password) {
    const data = await AuthBridge._post({ action: 'login', login, password });
    AuthBridge._write({ session: data.session, user: data.user });
    AuthBridge._clearLegacyPasswordSessions();
    return data.user;
  },

  async refresh() {
    const saved = AuthBridge._read();
    if (!saved?.session?.refresh_token) throw new Error('Сесію не знайдено');
    const data = await AuthBridge._post({
      action: 'refresh',
      refresh_token: saved.session.refresh_token,
    });
    AuthBridge._write({ session: data.session, user: data.user });
    return data.user;
  },

  async restore() {
    const saved = AuthBridge._read();
    if (saved?.session?.access_token && saved?.user) {
      if ((saved.session.expires_at || 0) * 1000 > Date.now() + 90_000) {
        AuthBridge._scheduleRefresh(saved.session);
        return saved.user;
      }
      try { return await AuthBridge.refresh(); }
      catch(e) { AuthBridge.clear(); }
    }

    // Одноразова безшовна міграція старої localStorage/sessionStorage сесії.
    const legacy = AuthBridge._readLegacyPasswordSession();
    if (!legacy?.login || !legacy?.password) return null;
    try { return await AuthBridge.login(legacy.login, legacy.password); }
    catch(e) { AuthBridge._clearLegacyPasswordSessions(); return null; }
  },

  accessToken() {
    return AuthBridge._read()?.session?.access_token || '';
  },

  _readLegacyPasswordSession() {
    let raw = null;
    try { raw = localStorage.getItem('tiflis_session'); } catch(e) {}
    if (!raw) { try { raw = sessionStorage.getItem('tiflis_session'); } catch(e) {} }
    if (!raw) return null;
    try { return JSON.parse(raw); } catch(e) { return null; }
  },

  _clearLegacyPasswordSessions() {
    try { localStorage.removeItem('tiflis_session'); } catch(e) {}
    try { sessionStorage.removeItem('tiflis_session'); } catch(e) {}
  },
};

// Не переписуємо кожен старий sb.* метод окремо: після Auth входу
// JWT автоматично додається до всіх запитів на власний Supabase-проєкт.
window.fetch = function(input, init = {}) {
  let url = '';
  try { url = typeof input === 'string' ? input : input.url; } catch(e) {}
  const token = AuthBridge.accessToken();
  if (!token || !url.startsWith(SUPA_URL) || url === AUTH_ENDPOINT) {
    return _nativeFetch(input, init);
  }

  const headers = new Headers(
    init.headers || (typeof Request !== 'undefined' && input instanceof Request ? input.headers : undefined)
  );
  headers.set('Authorization', `Bearer ${token}`);
  return _nativeFetch(input, { ...init, headers });
};

function _secureCurrentUser(user) {
  return {
    ...user,
    displayName: user.display_name || user.login,
    tg: user.tg_username || '',
  };
}

async function _enterPortalWithAuth(user) {
  await App.loadCache();
  currentUser = _secureCurrentUser(user);
  const loginScreen = $('login-screen');
  if (loginScreen) loginScreen.remove();
  $('app').classList.remove('hidden');
  App.initUI();
  const lastPage = localStorage.getItem('tiflis_last_page')
    || sessionStorage.getItem('tiflis_last_page') || 'home';
  App.navigate(lastPage);
  App.startPolling();
  if (typeof Morakx !== 'undefined') Morakx.init();
}

// Замінюємо стару авторизацію, яка читала users.password із браузера.
App.login = async function() {
  const login = $('li').value.trim();
  const pass = $('lp').value;
  const errEl = $('login-err');
  if (!login || !pass) {
    errEl.textContent = 'Введіть логін та пароль';
    errEl.classList.remove('hidden');
    return;
  }

  const btn = document.querySelector('#login-screen .btn-gold');
  btnLock(btn);
  const status = $('login-loading-status');
  if (status) status.textContent = 'Створення захищеної сесії...';

  try {
    const user = await AuthBridge.login(login, pass);
    $('lp').value = '';
    errEl.classList.add('hidden');
    await _enterPortalWithAuth(user);
    setTimeout(() => logEvent('auth', 'Захищений вхід через Supabase Auth'), 500);
  } catch(e) {
    errEl.textContent = e?.message || 'Невірний логін або пароль';
    errEl.classList.remove('hidden');
    if (status) status.textContent = '';
    btnUnlock(btn);
  }
};

App.restoreSession = async function() {
  try {
    const user = await AuthBridge.restore();
    if (!user) return false;
    await _enterPortalWithAuth(user);
    return true;
  } catch(e) {
    console.error('[secure restoreSession] FAILED:', e);
    AuthBridge.clear();
    return false;
  }
};

App.logout = function() {
  showConfirm('Вийти з акаунту?', () => {
    App.stopPolling();
    AuthBridge.clear();
    try { localStorage.removeItem('tiflis_last_page'); } catch(e) {}
    currentUser = null;
    location.reload();
  }, { okLabel: '🚪 Вийти', okClass: 'btn-danger' });
};

// До завершення Auth-міграції не дозволяємо створювати нові plaintext-паролі.
App.register = function() {
  const errEl = $('reg-err');
  if (errEl) {
    errEl.textContent = 'Реєстрацію тимчасово перенесено в захищену систему. Зверніться до адміністратора.';
    errEl.classList.remove('hidden');
  }
};
if (typeof Admin !== 'undefined') {
  Admin.addUser = function() {
    toast('Створення працівників переноситься в Supabase Auth', 'error');
  };
}

// ╔═══════════════════════════════════════════════════════════════╗
// ║  [14/14] СТАРТ (ініціалізація при завантаженні)               ║
// ╚═══════════════════════════════════════════════════════════════╝

document.addEventListener('keydown', e => {
  if (e.key === 'Enter' && document.getElementById('login-screen')) App.login();
});

document.addEventListener('visibilitychange', () => {
  if (!document.hidden && currentUser) App._poll();
});

(async () => {
  Theme.init();
  App._updateOfflineQueueBadge(sb._getQueue().length);

  window.addEventListener('online', () => { sb.flushQueue().catch(() => {}); });
  window.addEventListener('offline', () => { sb._setOffline(true); });

  const ls = $('login-screen');
  if (ls) {
    const loader = document.createElement('div');
    loader.id = 'session-loader';
    loader.style.cssText = 'position:fixed;inset:0;background:var(--eden-dark);z-index:99999;display:flex;align-items:center;justify-content:center;flex-direction:column;gap:16px';
    loader.innerHTML = `
      <div style="font-family:'Cormorant Garamond',serif;font-size:36px;color:var(--gold);letter-spacing:.15em;font-weight:700">ТИФЛІС</div>
      <div style="width:40px;height:40px;border:3px solid var(--gold-border);border-top-color:var(--gold);border-radius:50%;animation:spin .8s linear infinite"></div>`;
    document.body.appendChild(loader);
  }

  await App.restoreSession();

  const loader = document.getElementById('session-loader');
  if (loader) loader.remove();
})();

if ('serviceWorker' in navigator) {
  window.addEventListener('load', () => {
    navigator.serviceWorker.register('./sw.js').catch(err => {
      console.warn('SW registration failed:', err);
    });
  });
}
