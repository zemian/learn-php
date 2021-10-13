<?php
require_once '../env.php';
$error = null;
$data = [];
$pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD);

//// Get all query
//$stmt = $pdo->prepare(<<<HERE
//    SELECT a.* FROM category a
//    WHERE a.deleted = false
//    ORDER BY a.modified_dt DESC
//HERE
//);

// Get by parent name
$stmt = $pdo->prepare(<<<HERE
    SELECT a.* FROM category a
    LEFT JOIN category b ON b.id = a.parent_id
    WHERE a.deleted = false AND a.parent_id IS NOT NULL AND b.name = ?
    ORDER BY a.modified_dt DESC
HERE
);
//$stmt->bindValue(1, 'Database');
$stmt->bindValue(1, 'Language');

$result = $stmt->execute();
if ($result === false) {
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

