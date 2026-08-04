# Tiflis — Phase 0 security hardening

Status date: 2026-08-04

## Why this phase exists

The original portal sends privileged credentials and authentication data to the browser. The production database also exposes legacy tables without Row Level Security. Enabling RLS immediately would stop the current portal, so the migration must be staged.

## Completed in this phase

- Created the `security/phase-0` branch.
- Replaced the browser-side Supabase service-role credential with a publishable key in the branch.
- Disabled the legacy static portal key in browser code.
- Disabled browser access to the Telegram bot token and added local-storage cleanup.
- Removed the `tg_bot_token` record from the production `settings` table.
- Added `.gitignore` rules for local secret files.
- Added a CI scanner for privileged credentials in deployable browser files.
- Added the `staff_profiles` Auth bridge in production.
- Enabled RLS on `staff_profiles` and denied anonymous access.
- Added role helpers whose execution is denied to the anonymous role.
- Deployed `tiflis-secure-api` with `verify_jwt=true`.
- Restricted the new server API to active staff with administrator or notification permissions.

## Still critical

### Rotate compromised credentials

Removing a credential from the latest commit does not remove it from Git history or from previously loaded browser code.

The following credentials must be rotated in their provider dashboards:

1. Supabase legacy JWT signing secret / service-role key that was committed publicly.
2. Telegram bot token that was previously delivered to browsers.
3. Any AI-provider keys if they were ever copied into browser code, logs, screenshots, or public commits.
4. The old portal shared key must remain disabled and must never be reused.

After rotation, old sessions and cached browser data should be treated as untrusted.

## Production risks that remain

- Legacy passwords are stored as plaintext in `public.users` and `public.registration_requests`.
- Legacy sessions contain plaintext credentials.
- Seventeen legacy public tables still have RLS disabled.
- `quick-responder` still accepts unauthenticated Telegram webhook traffic and contains legacy portal endpoints.
- The current production UI still authenticates by downloading user rows and comparing passwords in the browser.

## Safe rollout order

1. Rotate exposed provider credentials.
2. Create Supabase Auth accounts for active staff.
3. Fill `staff_profiles.legacy_user_id` mappings.
4. Replace the legacy login screen with Supabase Auth.
5. Move Telegram, AI and administrator actions to JWT-protected Edge Functions.
6. Move browser database access to authenticated Supabase clients.
7. Add table-specific RLS policies and test each module.
8. Enable RLS one module at a time.
9. Delete plaintext password and legacy session columns only after every active user has migrated.
10. Remove `quick-responder` legacy portal actions and preserve only authenticated server/Telegram webhook routes.

## Do not merge yet if

- The replacement Supabase credentials have not been rotated.
- Staff Auth accounts have not been prepared.
- A test deployment has not verified login, schedule, cash, duties and menu flows.
- The secure API origin allow-list has not been configured.

## Current database foundation

Migration file:

`supabase/migrations/20260804_phase0_auth_foundation.sql`

Secure Edge Function source:

`supabase/functions/tiflis-secure-api/index.ts`

The foundation is intentionally additive. It does not enable RLS on the legacy tables and therefore does not interrupt the current production portal.
