-- Add wallet_address and bar_code columns to admins table
-- For MySQL/MariaDB

ALTER TABLE `admins` 
ADD COLUMN `wallet_address` VARCHAR(255) NULL AFTER `phone`,
ADD COLUMN `bar_code` VARCHAR(255) NULL AFTER `wallet_address`;

-- For SQLite

-- ALTER TABLE `admins` 
-- ADD COLUMN `wallet_address` VARCHAR(255) NULL;

-- ALTER TABLE `admins` 
-- ADD COLUMN `bar_code` VARCHAR(255) NULL;

-- For PostgreSQL

-- ALTER TABLE admins 
-- ADD COLUMN wallet_address VARCHAR(255) NULL,
-- ADD COLUMN bar_code VARCHAR(255) NULL;

-- To remove the columns (rollback):

-- ALTER TABLE `admins` DROP COLUMN `wallet_address`, DROP COLUMN `bar_code`;
