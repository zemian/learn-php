<?php
$db = new PDO('sqlite:memory');
$stmt = $db->query('SELECT 1 + 2');
$mysql_version = $stmt->fetch()[0];
echo $mysql_version;