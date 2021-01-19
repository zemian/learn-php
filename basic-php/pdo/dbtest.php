<?php
$db = new PDO('mysql:host=localhost;dbname=information_schema', 'zemian', 'test123');
$stmt = $db->query('SELECT VERSION()');
$mysql_version = $stmt->fetch()[0];
echo $mysql_version;