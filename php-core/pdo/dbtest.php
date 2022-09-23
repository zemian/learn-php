<?php
$db = new PDO('sqlite:test.db');
$stmt = $db->query('SELECT 1 + 2');
$mysql_version = $stmt->fetch()[0];
echo $mysql_version;