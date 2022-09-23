<?php
$dbh = new PDO('mysql:host=localhost;dbname=mysql', 'zemian', 'test123');
$stmt = $dbh->query('SELECT 1 + 2');
//$stmt = $dbh->query('SELECT VERSION()');
$result = $stmt->fetch();
print_r($result);
