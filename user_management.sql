-- user_management.sql

-- Create the database
CREATE DATABASE user_management;

-- Select the database
USE user_management;

-- Create the users table
CREATE TABLE users (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    dob DATE NOT NULL
);