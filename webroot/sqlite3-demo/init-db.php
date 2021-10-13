<?php
$db = new PDO('sqlite:' . __DIR__ . '/app.db');
$db->exec('CREATE TABLE IF NOT EXISTS options (name TEXT, value TEXT)');
echo "DB schema created\n";
