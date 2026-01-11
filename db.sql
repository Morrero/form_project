CREATE DATABASE IF NOT EXISTS formtest CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE formtest;
CREATE TABLE IF NOT EXISTS applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    middle_name VARCHAR(50),
    birth_date DATE NOT NULL,
    email VARCHAR(100),
    country_code VARCHAR(5) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    marital_status ENUM('single', 'married', 'divorced', 'widowed') NOT NULL,
    about TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);