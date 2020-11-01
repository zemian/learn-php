<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://unpkg.com/bulma">
    <title>Tiny CMS Admin</title>
</head>
<body>

<nav class="navbar is-primary">
    <div class="navbar-menu is-flex">
        <div class="navbar-start">
            <a class="navbar-item" href="/admin/index.php">Admin</a>
        </div>
        <div class="navbar-end">
            <a class="navbar-item" href="/index.php">Site</a>
        </div>
    </div>
</nav>
<section class="section">
    <nav class="breadcrumb">
        <ul>
            <li class="is-active"><a href="/admin/index.php">Content</a></li>
        </ul>
    </nav>
    <div class="toolbar">
        <a class="button" href="/admin/create.php">New</a>
    </div>
    <table class="table is-fullwidth">
        <tr>
            <td>Action</td>
            <td>ID</td>
            <td>Slug</td>
            <td>Created</td>
            <td>Type</td>
        </tr>
        <?php
        $db = new PDO('mysql:host=localhost;dbname=tinycmsdb;charset=utf8mb4', 'zemian', 'test123');
        $result = $db->query('SELECT id, slug, created_ts, content_type FROM content ORDER BY created_ts LIMIT 10');
        if ($result) {
            while($row = $result->fetch()) {
                ?>
                <tr>
                    <td><a href="edit.php?id=<?= $row['id'] ?>">Edit</a></td>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['slug'] ?></td>
                    <td><?= $row['created_ts'] ?></td>
                    <td><?= $row['content_type'] ?></td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
</section>
</body>
</html>