<?php
require_once '../env.php';
$error = null;
$data = [];
$pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD);

// Get top 20 latest rows
$stmt = $pdo->query('SELECT * FROM category WHERE deleted = false ORDER BY modified_dt DESC LIMIT 20');
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
    <table>
        <tr>
            <td>Id</td>
            <td>Category</td>
            <td>Last Updated</td>
        </tr>
        <?php foreach ($data as $row) { ?>
        <tr>
            <td><?php echo $row['id'] ?></td>
            <td><?php echo $row['name'] ?></td>
            <td><?php echo $row['modified_dt'] ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
