<?php
require_once '../env.php';
$db = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
$stmt = $db->query('SELECT VERSION()');
$result = $stmt->fetch()[0];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>php</title>
</head>
<body>
<pre>
RESULT: <?php var_dump($result); ?>
</pre>
</body>
</html>