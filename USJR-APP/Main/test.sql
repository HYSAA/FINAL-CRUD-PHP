CREATE DATABASE IF NOT EXISTS test;

USE test;

CREATE TABLE IF NOT EXISTS crud (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    middle_name VARCHAR(50),
    email VARCHAR(50),
    gender VARCHAR(10),
    stud_id VARCHAR(20),
    year VARCHAR(10),
    program VARCHAR(100),
    college VARCHAR(100)
);
