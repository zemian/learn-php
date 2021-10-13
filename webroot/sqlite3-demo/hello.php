<?php
// https://www.php.net/manual/en/sqlite3.open.php

$db = new SQLite3(__DIR__ . '/app.db');

$db->exec('CREATE TABLE IF NOT EXISTS foo (bar STRING)');
$db->exec("INSERT INTO foo (bar) VALUES ('This is a test')");

$result = $db->query('SELECT bar FROM foo');
while($row = $result->fetchArray()) {
    print_r($row);    
}

$db->close();
