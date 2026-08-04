begin;

create table if not exists public.auth_migration_attempts (
  key_hash text primary key,
  attempts integer not null default 0,
  window_started timestamptz not null default now(),
  locked_until timestamptz,
  updated_at timestamptz not null default now()
);

alter table public.auth_migration_attempts enable row level security;
revoke all on table public.auth_migration_attempts from anon, authenticated;
grant all on table public.auth_migration_attempts to service_role;

comment on table public.auth_migration_attempts is
  'Server-only rate limiting state for one-time legacy login migration.';

commit;
