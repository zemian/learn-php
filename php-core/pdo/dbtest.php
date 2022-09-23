<?php
$dbh = new PDO('sqlite:test.db');
$stmt = $dbh->query('SELECT 1 + 2');
$result = $stmt->fetch();
print_r($result);
