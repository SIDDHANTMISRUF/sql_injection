CREATE DATABASE IF NOT EXISTS sqli_lab;
USE sqli_lab;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  email VARCHAR(255)
);

INSERT INTO users (username, password, email) VALUES
('admin', 'admin123', 'admin@example.com'),
('alice', 'alicepass', 'alice@example.com');

CREATE TABLE IF NOT EXISTS products (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(200),
  description TEXT
);

INSERT INTO products (name, description) VALUES
('Widget A', 'Basic widget'),
('Widget B', 'Advanced widget with features'),
('Secret Data', 'Sensitive item - for demo only');
