<?php
$db = new PDO('mysql:host=localhost;dbname=tinycmsdb;charset=utf8mb4', 'zemian', 'test123');
if (isset($_POST['action'])) {
    $content_id = $_POST['id'];
    $slug = $_POST['slug'];
    $content = $_POST['content'];
    $content_type = $_POST['content_type'];
    
    $content_id_param = $db->quote($content_id);
    $slug_param = $db->quote($slug);
    $content_param = $db->quote($content);
    $content_type_param = $db->quote($content_type);
    
    $result = $db->exec("UPDATE content SET slug = $slug_param, content = $content_param, content_type = $content_type_param WHERE id = $content_id_param");
    if (!$result) {
        echo "ERROR: Problem updating data! " . $db->errorInfo()[2];
    } else {
        header("Location: index.php");
        exit;
    }
} else {
    $content_id = $_GET['id'] ?? -1;
    if ($content_id <= 0) {
        echo "ERROR: Page $content_id not found.";
        exit;
    } else {
        $content_id_param = $db->quote($content_id);
        $result = $db->query("SELECT slug, content, content_type FROM content WHERE id = $content_id_param");
        $row = $result->fetch();
        $slug = $row['slug'];
        $content = $row['content'];
        $content_type = $row['content_type'];
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
            <li class="is-active"><a href="/admin/edit.php">Edit</a></li>
        </ul>
    </nav>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $content_id ?>">
        <div class="field">
            <div class="label"><label>Slug</label></div>
            <div class="control"><input class="input" type="text" name="slug" value="<?= $slug ?>"></div>
        </div>
        <div class="field">
            <div class="label"><label>ContentType</label></div>
            <div class="control"><input class="input" type="text" name="content_type" value="<?= $content_type ?>"></div>
        </div>
        <div class="field">
            <div class="label"><label>Content</label></div>
            <div class="control"><textarea class="textarea" name="content" rows="25" cols="80"><?= $content ?></textarea></div>
        </div>
        <div class="field">
            <div class="control"><input class="button" type="submit" value="Update" name="action"></div>
        </div>
    </form>
</section>
</body>
</html>