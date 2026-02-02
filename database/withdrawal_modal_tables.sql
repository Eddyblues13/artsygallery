-- Withdrawal Success Modal: tables and default row
-- Run this in your MySQL/MariaDB client (e.g. phpMyAdmin, MySQL Workbench, or: mysql -u user -p database_name < this_file.sql)

-- Table: global message + on/off
CREATE TABLE IF NOT EXISTS `withdrawal_modal_settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `message` text,
  `is_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: per-user overrides (show/hide modal)
CREATE TABLE IF NOT EXISTS `withdrawal_modal_user_overrides` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `show_modal` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `withdrawal_modal_user_overrides_user_id_unique` (`user_id`),
  CONSTRAINT `withdrawal_modal_user_overrides_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Default global setting (one row) — only if table is empty
INSERT INTO `withdrawal_modal_settings` (`message`, `is_enabled`, `created_at`, `updated_at`)
SELECT 'Your withdrawal request has been submitted and is pending review.', 1, NOW(), NOW()
FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM `withdrawal_modal_settings` LIMIT 1);
