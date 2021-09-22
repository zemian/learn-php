<?php
require_once '../env.php';
$error = null;
$data = [];
$db = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
$stmt = $db->query('SELECT VERSION()');
if ($stmt === false) {
    $error = $stmt->errorInfo();
} else {
    $data = $stmt->fetch();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>php</title>
</head>
<body>
<pre>
<?php if ($error) { ?>
    <pre>ERROR: <?php print_r($error); ?></pre>
<?php } else { ?>
    <pre>RESULT: <?php print_r($data); ?></pre>
<?php } ?>
</pre>
</body>
</html>
