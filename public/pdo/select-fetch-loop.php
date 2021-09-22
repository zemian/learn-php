<?php
require_once '../env.php';
$pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
$stmt = $pdo->query('SELECT * FROM employees ORDER BY hire_date DESC LIMIT 10');
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
            <td>First Name</td>
            <td>Last Name</td>
            <td>Hire Date</td>
        </tr>
        <?php while ($row = $stmt->fetch()) { ?>
        <tr>
            <td><?php echo $row['first_name'] ?></td>
            <td><?php echo $row['last_name'] ?></td>
            <td><?php echo $row['hire_date'] ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
