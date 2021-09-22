<?php
require_once '../env.php';
$error = null;
$data = [];
$db = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
$stmt = $db->prepare('INSERT INTO category(name) VALUE(?)');

// Perform insert using statement.execute() and params in one call.
$result = $stmt->execute(['Foo']);
if ($result === false) {
    $error = $stmt->errorInfo();
}
$data[]= ['id' => $db->lastInsertId()];

// Perform insert using statement.bindValue() and execute() separately.
$stmt->bindValue(1, 'Bar', PDO::PARAM_STR);
$result = $stmt->execute();
if ($result === false) {
    $error = $stmt->errorInfo();
}
$data[]= ['id' => $db->lastInsertId()];

// Parent
$stmt = $db->prepare('INSERT INTO category(name) VALUE(?)');
$result = $stmt->execute(['Database']);
if ($result === false) {
    $error = $stmt->errorInfo();
}
$parent_id = $db->lastInsertId();
$data []= ['parent_id' => $db->lastInsertId()];

// Children
$stmt = $db->prepare('INSERT INTO category(name, parent_id, sort_order) VALUE(?, ?, ?)');
$db_list = ['MySQL', 'SQLite', 'MariaDB', 'PostgreSQL', 'OracleDB'];
$order = 1;
foreach ($db_list as $db_name) {
    $stmt->bindValue(1, $db_name, PDO::PARAM_STR);
    $stmt->bindValue(2, $parent_id, PDO::PARAM_INT);
    $stmt->bindValue(3, $order++, PDO::PARAM_INT);
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
    <pre>SUCCESS: <?php print_r($data); ?></pre>
<?php } ?>
</body>
</html>
