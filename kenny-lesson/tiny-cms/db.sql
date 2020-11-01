CREATE DATABASE tinycmsdb CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE tinycmsdb;

CREATE TABLE content (
    id SERIAL,
    created_ts TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    slug VARCHAR(200) UNIQUE,
    content LONGTEXT
);
