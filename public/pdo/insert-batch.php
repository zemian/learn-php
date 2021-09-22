<?php
require_once '../env.php';
$error = null;
$db = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
$stmt = $db->prepare('INSERT INTO category(name, code) VALUE(?, ?)');
$data = [];
for ($i = 0; $i < 100; $i++) {
    $result = $stmt->execute(["Bar Category#$i", "BAR$i"]);
    if ($result === false) {
        $error = $stmt->errorInfo();
        break;
    }
    $data []= ['id' => $db->lastInsertId()];
}
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
