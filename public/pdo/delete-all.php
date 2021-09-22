<?php
require_once '../env.php';
$error = null;
$data = [];
$pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD);

//// Delete all rows!
//$stmt = $pdo->prepare('DELETE FROM category');
//$result = $stmt->execute();
//if ($result === false) {
//    $error = $stmt->errorInfo();
//} else {
//    $data[] = ['result' => $result, 'deleted_count' => $stmt->rowCount()];
//}

// Delete all rows! - use pdo.exec()
$result = $pdo->exec('DELETE FROM category');
if ($result === false) {
    $error = $pdo->errorInfo();
} else {
    $data[] = ['deleted_count' => $result];
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
