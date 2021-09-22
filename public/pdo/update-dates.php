<?php
// NOTE: MySQL store datetime without any timezone info. What you stored is what you get.
// However, the DB Driver (JDBC) will auto convert the datatime value
// to match your serverTimeZone when returning data!
//
// NOTE2: The PHP mysqlnd driver will do similar as well!
//
// It's good practice to use a consistent timezone (eg: UTC) to deal with all dates on
// DB and PHP, and only convert when needed before display.

require_once '../env.php';
$error = null;
$data = [];
$pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
$stmt = $pdo->prepare('UPDATE category SET modified_dt = ? WHERE id = ?');

// Update modified date column with string input
// NOTE: The PHP date() can return UTC time, depending on your php.ini.
$id = 1;
$stmt->bindValue(1, date('Y-m-d H:i:s'));
$stmt->bindValue(2, $id, PDO::PARAM_INT);
$result = $stmt->execute();
if ($result === false) {
    $error = $stmt->errorInfo();
} else {
    $data[] = ['updated_count' => $stmt->rowCount(), 'id' => $id];
}

// Update modified date with local datetime
// Note that we are storing mix timezone datatime into the DB records, which can cause
// major confusion! It's better to stick with only one timezone storage reference.
$stmt = $pdo->prepare('UPDATE category SET modified_dt = ? WHERE id = ?');
$id = 2;
$dt = new DateTime("now", new DateTimeZone('America/New_York'));
$stmt->bindValue(1, $dt->format('Y-m-d H:i:s'));
$stmt->bindValue(2, $id, PDO::PARAM_INT);
$result = $stmt->execute();
if ($result === false) {
    $error = $stmt->errorInfo();
} else {
    $data[] = ['updated_count' => $stmt->rowCount(), 'id' => $id];
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
