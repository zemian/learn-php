<?php
require_once '../env.php';
$error = null;
$data = [];
$pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD);

// Retrieve a row from datatype that has mixed field DB data types and see how they are mapped in PHP.
// NOTE: All data from DB are returned as "string" type!
//       This is due to the mysqlnd driver default to use emulated prepared statements!

$stmt = $pdo->query('SELECT * FROM datatype WHERE id = 1');
if ($stmt === false) {
    $error = $stmt->errorInfo();
} else {
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <pre>SUCCESS: <?php var_dump($data); ?></pre>
<?php } ?>
</body>
</html>
