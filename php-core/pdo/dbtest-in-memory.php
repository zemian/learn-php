<?php
$dbh = new PDO('sqlite::memory:');
$stmt = $dbh->query('SELECT 1 + 2');
$result = $stmt->fetch();
print_r($result);