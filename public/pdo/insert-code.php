<?php
require_once '../env.php';
$error = null;
$db = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
$stmt = $db->prepare('INSERT INTO category(name, code) VALUE(?, ?)');
$result = $stmt->execute(['Foo Category', 'FOO']);
if ($result === false) {
    $error = $stmt->errorInfo();
}
$data = ['id' => $db->lastInsertId()];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>php</title>
</head>
<body>
<?php if ($error) { ?>
    <pre>ERROR: <?php print_r($error); ?></pre>
<?php } else { ?>
    <pre>RESULT: <?php print_r($data); ?></pre>
<?php } ?>
</body>
</html>
