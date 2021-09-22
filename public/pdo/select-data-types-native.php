<?php
require_once '../env.php';
$error = null;
$data = [];
$pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD);

// Retrieve a row from datatype using native mysqlnd driver mode ON (emulation OFF)
// NOTE: the driver will auto map INT and FLOAT types! But not datetimes, they still mapped to strings.
//       Even the decimal is mapped to strings.
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

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
