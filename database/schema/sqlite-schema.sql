CREATE TABLE IF NOT EXISTS "migrations"(
  "id" integer primary key autoincrement not null,
  "migration" varchar not null,
  "batch" integer not null
);
CREATE TABLE IF NOT EXISTS "users"(
  "id" integer primary key autoincrement not null,
  "name" varchar not null,
  "email" varchar not null,
  "email_verified_at" datetime,
  "password" varchar not null,
  "remember_token" varchar,
  "created_at" datetime,
  "updated_at" datetime,
  "admin" tinyint(1) not null default '0'
);
CREATE UNIQUE INDEX "users_email_unique" on "users"("email");
CREATE TABLE IF NOT EXISTS "password_reset_tokens"(
  "email" varchar not null,
  "token" varchar not null,
  "created_at" datetime,
  primary key("email")
);
CREATE TABLE IF NOT EXISTS "sessions"(
  "id" varchar not null,
  "user_id" integer,
  "ip_address" varchar,
  "user_agent" text,
  "payload" text not null,
  "last_activity" integer not null,
  primary key("id")
);
CREATE INDEX "sessions_user_id_index" on "sessions"("user_id");
CREATE INDEX "sessions_last_activity_index" on "sessions"("last_activity");
CREATE TABLE IF NOT EXISTS "cache"(
  "key" varchar not null,
  "value" text not null,
  "expiration" integer not null,
  primary key("key")
);
CREATE TABLE IF NOT EXISTS "cache_locks"(
  "key" varchar not null,
  "owner" varchar not null,
  "expiration" integer not null,
  primary key("key")
);
CREATE TABLE IF NOT EXISTS "jobs"(
  "id" integer primary key autoincrement not null,
  "queue" varchar not null,
  "payload" text not null,
  "attempts" integer not null,
  "reserved_at" integer,
  "available_at" integer not null,
  "created_at" integer not null
);
CREATE INDEX "jobs_queue_index" on "jobs"("queue");
CREATE TABLE IF NOT EXISTS "job_batches"(
  "id" varchar not null,
  "name" varchar not null,
  "total_jobs" integer not null,
  "pending_jobs" integer not null,
  "failed_jobs" integer not null,
  "failed_job_ids" text not null,
  "options" text,
  "cancelled_at" integer,
  "created_at" integer not null,
  "finished_at" integer,
  primary key("id")
);
CREATE TABLE IF NOT EXISTS "failed_jobs"(
  "id" integer primary key autoincrement not null,
  "uuid" varchar not null,
  "connection" text not null,
  "queue" text not null,
  "payload" text not null,
  "exception" text not null,
  "failed_at" datetime not null default CURRENT_TIMESTAMP
);
CREATE UNIQUE INDEX "failed_jobs_uuid_unique" on "failed_jobs"("uuid");
CREATE TABLE IF NOT EXISTS "shul_members"(
  "id" integer primary key autoincrement not null,
  "hebrew_name" varchar,
  "gender" varchar not null,
  "created_at" datetime,
  "updated_at" datetime,
  "ancestors_id" integer not null,
  "forenames" varchar,
  "surname" varchar,
  "paternal_status" varchar check("paternal_status" in('kohen', 'levi', 'yisrael')) not null default 'yisrael',
  "contact_email" varchar,
  foreign key("ancestors_id") references "ancestors"("id") on delete cascade
);
CREATE TABLE IF NOT EXISTS "ancestors"(
  "id" integer primary key autoincrement not null,
  "created_at" datetime,
  "updated_at" datetime,
  "fathers_hebrew_name" varchar not null default 'tatte',
  "paternal_grandfather_hebrew_name" varchar not null default 'tatte tatte',
  "paternal_grandmother_hebrew_name" varchar not null default 'tatte mamme',
  "mothers_hebrew_name" varchar not null default 'mamme',
  "maternal_grandfather_hebrew_name" varchar not null default 'mamme tatte',
  "maternal_grandmother_hebrew_name" varchar not null default 'mamme mamme',
  "maternal_status" varchar check("maternal_status" in('kohen', 'levi', 'yisrael')) not null default 'yisrael',
  "full_name" varchar as(fathers_hebrew_name || ' ben ' || paternal_grandfather_hebrew_name),
  "father_full_name" varchar as(fathers_hebrew_name || ' ben ' || paternal_grandfather_hebrew_name),
  "mother_full_name" varchar as(mothers_hebrew_name || ' bas ' || maternal_grandfather_hebrew_name),
  "father_yahrtzeit_date" date,
  "mother_yahrtzeit_date" date
);

INSERT INTO migrations VALUES(1,'0001_01_01_000000_create_users_table',1);
INSERT INTO migrations VALUES(2,'0001_01_01_000001_create_cache_table',1);
INSERT INTO migrations VALUES(3,'0001_01_01_000002_create_jobs_table',1);
INSERT INTO migrations VALUES(4,'2024_09_20_135432_create_shul_members_table',1);
INSERT INTO migrations VALUES(5,'2024_09_23_153907_add_member_fields',1);
INSERT INTO migrations VALUES(6,'2024_09_23_160319_create_ancestors_table',1);
INSERT INTO migrations VALUES(7,'2024_09_24_213210_split_name_into_forenames_and_surnames',1);
INSERT INTO migrations VALUES(8,'2024_09_25_103429_add_admin_to_users',2);
INSERT INTO migrations VALUES(9,'2024_09_25_130811_add_status_to_members',3);
INSERT INTO migrations VALUES(10,'2024_09_25_141317_add_maternal_status_to_ancestors',4);
INSERT INTO migrations VALUES(11,'2024_09_25_142251_rename_status_paternal_status_shul_members',5);
INSERT INTO migrations VALUES(14,'2024_09_26_105338_add_contact_email_to_shul_members',6);
INSERT INTO migrations VALUES(15,'2024_09_26_115257_add_joined_name_to_ancestors',7);
INSERT INTO migrations VALUES(16,'2024_09_26_120922_add_parent_yahrtzeit_date_to_ancestors',8);
