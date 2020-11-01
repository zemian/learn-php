<?php
if (isset($_POST['action'])) {
    $db = new PDO('mysql:host=localhost;dbname=tinycmsdb;charset=utf8mb4', 'zemian', 'test123');
    $slug = $db->quote($_POST['slug']);
    $content = $db->quote($_POST['content']);
    $content_type = $db->quote($_POST['content_type']);
    $result = $db->exec("INSERT INTO content (slug, content, content_type) VALUES($slug, $content, $content_type)");
    if (!$result) {
        echo "ERROR: Problem inserting data! " . $db->errorInfo()[2];
    } else {
        header("Location: index.php");
        exit;
    }
}
?>
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
            <li><a href="/admin/index.php">Content</a></li>
            <li class="is-active"><a href="/admin/create.php">New</a></li>
        </ul>
    </nav>
    <h1 class="title">Create Content</h1>
    <form method="POST">
        <div class="field">
            <label class="label">Slug</label>
            <div class="control"><input class="input" type="text" name="slug"></div>
        </div>
        <div class="field">
            <label class="label">ContentType</label>
            <div class="control"><input class="input" type="text" name="content_type" value="html"></div>
        </div>
        <div class="field">
            <label class="label">Content</label>
            <div class="control"><textarea class="textarea" name="content" rows="25" cols="80"></textarea></div>
        </div>
        <div class="field">
            <div class="control"><input class="button" type="submit" value="Create" name="action"></div>
        </div>
    </form>
</section>
</body>
</html>