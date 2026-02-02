-- SQL script to create popup_messages table
-- For SQLite
CREATE TABLE IF NOT EXISTS popup_messages (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NULL,
    title VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    type VARCHAR(20) NOT NULL DEFAULT 'general',
    position VARCHAR(10) NOT NULL DEFAULT 'top',
    is_active BOOLEAN NOT NULL DEFAULT 1,
    start_date TIMESTAMP NULL,
    end_date TIMESTAMP NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- For MySQL/MariaDB
-- CREATE TABLE IF NOT EXISTS popup_messages (
--     id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
--     user_id BIGINT UNSIGNED NULL,
--     title VARCHAR(255) NOT NULL,
--     message TEXT NOT NULL,
--     type ENUM('general', 'user_specific') NOT NULL DEFAULT 'general',
--     position ENUM('top', 'bottom') NOT NULL DEFAULT 'top',
--     is_active BOOLEAN NOT NULL DEFAULT TRUE,
--     start_date TIMESTAMP NULL,
--     end_date TIMESTAMP NULL,
--     created_at TIMESTAMP NULL,
--     updated_at TIMESTAMP NULL,
--     FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
-- );
