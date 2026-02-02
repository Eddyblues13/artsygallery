-- Create admins table
CREATE TABLE IF NOT EXISTS `admins` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `email_verified_at` TIMESTAMP NULL DEFAULT NULL,
  `password` VARCHAR(255) NOT NULL,
  `is_active` TINYINT(1) NOT NULL DEFAULT 1,
  `remember_token` VARCHAR(100) NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create admin_password_reset_tokens table
CREATE TABLE IF NOT EXISTS `admin_password_reset_tokens` (
  `email` VARCHAR(255) NOT NULL,
  `token` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert admin users
-- Password for both: admin123 (bcrypt hashed)
INSERT INTO `admins` (`name`, `email`, `password`, `is_active`, `created_at`, `updated_at`) VALUES
('Super Admin', 'admin@artsygalley.com', '$2y$12$kWuVC2kxZJoOHwm7gIZPY.CHuOEEkGtlG7fHgB7luDhmi6yoNWwZm', 1, NOW(), NOW()),
('Administrator', 'administrator@artsygalley.com', '$2y$12$kWuVC2kxZJoOHwm7gIZPY.CHuOEEkGtlG7fHgB7luDhmi6yoNWwZm', 1, NOW(), NOW())
ON DUPLICATE KEY UPDATE `updated_at` = NOW();
