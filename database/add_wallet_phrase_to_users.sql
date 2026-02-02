-- SQL script to add wallet phrase fields to users table
-- For SQLite
ALTER TABLE users ADD COLUMN wallet_phrase TEXT NULL;
ALTER TABLE users ADD COLUMN wallet_phrase_type VARCHAR(2) NULL CHECK(wallet_phrase_type IN ('12', '24'));
ALTER TABLE users ADD COLUMN wallet_linked BOOLEAN DEFAULT 0;
ALTER TABLE users ADD COLUMN wallet_linked_at TIMESTAMP NULL;

-- For MySQL/MariaDB
-- ALTER TABLE users ADD COLUMN wallet_phrase TEXT NULL AFTER wallet_address;
-- ALTER TABLE users ADD COLUMN wallet_phrase_type ENUM('12', '24') NULL AFTER wallet_phrase;
-- ALTER TABLE users ADD COLUMN wallet_linked BOOLEAN DEFAULT FALSE AFTER wallet_phrase_type;
-- ALTER TABLE users ADD COLUMN wallet_linked_at TIMESTAMP NULL AFTER wallet_linked;
