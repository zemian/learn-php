<?php
require_once '../env.php';
$error = null;
$data = [];
$pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
$stmt = $pdo->prepare('INSERT INTO category(name) VALUE(?)');
for ($i = 0; $i < 100; $i++) {
    $result = $stmt->execute(["Bar Category#$i"]);
    if ($result === false) {
        $error = $stmt->errorInfo();
        break;
    }
    $data []= ['id' => $pdo->lastInsertId()];
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
    <pre>SUCCESS: <?php print_r($data); ?></pre>
<?php } ?>
</body>
</html>
