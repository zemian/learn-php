<?php
$db = new PDO('mysql:host=localhost;dbname=testdb', 'zemian', 'test123');
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
