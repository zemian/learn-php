<?php
// https://www.php.net/manual/en/ref.pdo-sqlite.connection.php
// https://www.php.net/manual/en/sqlite3.open.php

$db = new PDO('sqlite:' . __DIR__ . '/app.db');

$db->exec('CREATE TABLE IF NOT EXISTS foo (bar STRING)');
$db->exec("INSERT INTO foo (bar) VALUES ('This is a test')");

$stmt = $db->query('SELECT bar FROM foo');
while($row = $stmt->fetch()) {
    print_r($row);    
}
