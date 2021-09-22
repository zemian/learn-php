<?php
require_once '../env.php';
$error = null;
$db = new PDO(DB_DSN, DB_USER, DB_PASSWORD);

$data = [];

// Parent
$parent_id = -1;
$stmt = $db->prepare('INSERT INTO category(name, code) VALUE(?, UUID())');
$result = $stmt->execute(['Parent Category']);
if ($result === false) {
    $error = $stmt->errorInfo();
}
$parent_id = $db->lastInsertId();
$data []= ['parent_id' => $db->lastInsertId()];

// Children
$stmt = $db->prepare('INSERT INTO category(name, code, parent_id) VALUE(?, UUID(), ?)');
for ($i = 0; $i < 7; $i++) {
    $stmt->bindValue(1, "Child Category#$i", PDO::PARAM_STR);
    $stmt->bindValue(2, $parent_id, PDO::PARAM_INT);
    $result = $stmt->execute();
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
