<?php
require_once '../env.php';
$error = null;
$data = [];
$pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD);

// Delete by id
// NOTE: Even if the ID does not exist in DB, the result will return 1 for success!
$stmt = $pdo->prepare('DELETE FROM category where id = ?');
$id = 1;
$stmt->bindValue(1, $id, PDO::PARAM_INT);
$result = $stmt->execute();
if ($result === false) {
    $error = $stmt->errorInfo();
} else {
    $data[] = ['id' => $id, 'result' => $result, 'deleted_count' => $stmt->rowCount()];
}

// Delete by id - loosely
// NOTE: The parameter can be either int or string!
$stmt = $pdo->prepare('DELETE FROM category where id = ?');
$id = '2';
$result = $stmt->execute([$id]);
if ($result === false) {
    $error = $stmt->errorInfo();
} else {
    $data[] = ['id' => $id, 'result' => $result, 'deleted_count' => $stmt->rowCount()];
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
