-- Add phone column to admins table
-- For MySQL/MariaDB

ALTER TABLE `admins` 
ADD COLUMN `phone` VARCHAR(255) NULL AFTER `password`;

-- For SQLite

-- ALTER TABLE `admins` 
-- ADD COLUMN `phone` VARCHAR(255) NULL;
