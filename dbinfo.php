<?php
require_once __DIR__ . '/env.php';
$db = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
$stmt = $db->query('SELECT VERSION()');
$mysql_version = $stmt->fetch()[0];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DB Test</title>
</head>
<body>
MySQL Version: <?php echo $mysql_version; ?>
</body>
</html>
