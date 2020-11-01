<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tiny CMS Admin</title>
</head>
<body>

<h1>List of Content</h1>
<a href="/admin/create.php">Create</a>
<a href="/index.php">Home</a>
<table>
    <?php
    $db = new PDO('mysql:host=localhost;dbname=tinycmsdb;charset=utf8mb4', 'zemian', 'test123');
    $result = $db->query('SELECT id, slug, created_ts FROM content ORDER BY created_ts LIMIT 10');
    if ($result) {
        while($row = $result->fetch()) {
            //print_r( $row );
            ?>
            <tr>
                <td><a href="edit.php?id=<?= $row['id'] ?>">Edit</a></td>
                <td><?= $row['id'] ?></td>
                <td><?= $row['slug'] ?></td>
                <td><?= $row['created_ts'] ?></td>
            </tr>
            <?php
        }
    }
    ?>
</table>
</body>
</html>