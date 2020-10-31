<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<table>
    <?php
    $conn = new PDO('mysql:host=localhost;dbname=employees', 'zemian', 'test123');
    $result = $conn->query('SELECT * FROM employees ORDER BY hire_date LIMIT 10');
    while($row = $result->fetch()) {
        //print_r( $row );
        ?>
        <tr>
            <td><?= $row['emp_no'] ?></td>
            <td><?= $row['birth_date'] ?></td>
            <td><?= $row['first_name'] ?></td>
            <td><?= $row['last_name'] ?></td>
            <td><?= $row['gender'] ?></td>
            <td><?= $row['hire_date'] ?></td>
        </tr>
        <?php
    }
    ?>
</table>
</body>
</html>