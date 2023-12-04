-- Create the database
CREATE DATABASE IF NOT EXISTS usjr2;

-- Switch to the usjr2 database
USE usjr2;

-- Create the users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL
);
SELECT * FROM users;
-- Display the structure of the created table
DESCRIBE users;
