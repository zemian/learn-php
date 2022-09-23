<?php
// NOTE: MySQL store datetime without any timezone info. What you stored is what you get.
// However, the DB Driver (JDBC) will auto convert the datatime value
// to match your serverTimeZone when returning data!
//
// NOTE2: The PHP mysqlnd driver will do similar as well!
//
// It's good practice to use a consistent timezone (eg: UTC) to deal with all dates on
// DB and PHP, and only convert when needed before display.
//
// NOTE3:
// MySQL default DATETIME string format is "YYYY-MM-DD HH:MM:SS", which equivalent of PHP "date('Y-m-d H:i:s')"

require_once '../env.php';
$error = null;
$data = [];
$pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
$stmt = $pdo->prepare('UPDATE category SET modified_dt = ? WHERE id = ?');

// Update modified date column with string input
// NOTE: The PHP date() can return UTC time, depending on your php.ini.
$id = 61;
//$stmt->bindValue(1, date('Y-m-d H:i:s'));
//$stmt->bindValue(1, date('Y-m-d H:i:s', mktime(0, 0, 0, 1, 1, 2021)));
//$stmt->bindValue(1, date('c', strtotime("1959-01-31 17:00:01"))); // This will not work: Wrong MySQL datetime format!
$stmt->bindValue(1, date('Y-m-d H:i:s', strtotime("1959-01-31 17:00:01")));
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
