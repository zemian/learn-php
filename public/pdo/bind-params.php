<?php 
$db = new PDO('mysql:host=localhost;dbname=employees', 'zemian', 'test123');
$stmt = $db->prepare('SELECT * FROM employees WHERE last_name = ? ORDER BY hire_date DESC LIMIT 10');
$last_name = $_GET['last_name'] ?? 'Flexer';
$stmt->execute([$last_name]);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDO</title>
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
