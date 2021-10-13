CREATE USER IF NOT EXISTS 'zemian'@'localhost' IDENTIFIED BY 'test123';
CREATE DATABASE mycmsdb CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
GRANT ALL PRIVILEGES ON mycmsdb.* TO 'zemian'@'localhost';
