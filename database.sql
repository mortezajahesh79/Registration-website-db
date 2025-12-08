CREATE DATABASE IF NOT EXISTS deutsch_class_web CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE deutsch_class_web;

CREATE TABLE registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    full_name VARCHAR(255) NOT NULL,
    phone VARCHAR(50),
    telegram_id VARCHAR(255) NOT NULL,
    nationality VARCHAR(100) NOT NULL,
    country VARCHAR(100) NOT NULL,
    german_level VARCHAR(100) NOT NULL,
    german_level_other TEXT,
    german_level_participate VARCHAR(10) NOT NULL,
    preferred_times TEXT NOT NULL,
    books TEXT NOT NULL,
    books_other TEXT,
    how_found VARCHAR(100) NOT NULL,
    how_found_other TEXT,
    rules_agreed TINYINT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;