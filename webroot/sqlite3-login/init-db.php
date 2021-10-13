<?php
$db = new PDO('sqlite:' . __DIR__ . '/app.db');

echo "Create table: users\n";
$sql = <<< HERE
    CREATE TABLE IF NOT EXISTS users (username TEXT NOT NULL PRIMARY KEY, 
    password TEXT NOT NULL, 
    create_ts DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP)
    HERE;
$db->exec($sql);
