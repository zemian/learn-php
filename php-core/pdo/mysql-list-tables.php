<?php
$dbh = new PDO('mysql:host=localhost;dbname=mysql', 'zemian', 'test123');
$stmt = $dbh->query('SELECT * FROM information_schema.tables');
$result = $stmt->fetch();
print_r($result);
