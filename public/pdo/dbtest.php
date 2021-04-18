<?php
require_once '../env.php';
$db = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
$stmt = $db->query('SELECT VERSION()');
$mysql_version = $stmt->fetch()[0];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DB Test</title>
</head>
<body>
MySQL Version: <?php echo $mysql_version; ?>
</body>
</html>
