CREATE DATABASE IF NOT EXISTS url_shortener;
USE url_shortener;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50),
    email VARCHAR(100),
    password VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE urls (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    original_url TEXT NOT NULL,
    short_code VARCHAR(20) UNIQUE NOT NULL,
    custom_alias VARCHAR(50) DEFAULT NULL,
    clicks INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE clicks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    url_id INT,
    ip_address VARCHAR(45),
    user_agent TEXT,
    referrer TEXT,
    country VARCHAR(50),
    clicked_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
