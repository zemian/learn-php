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
    <title>TinyCMS Admin</title>
</head>
<body>

<h1>Create Content</h1>
<a href="/admin/index.php">Cancel</a>
<form method="POST">
    <div>
        <label>Slug</label>
        <input type="text" name="slug">
    </div>
    <div>
        <label>ContentType</label>
        <input type="text" name="content_type" value="html">
    </div>
    <div>
        <label>Content</label>
        <textarea name="content" rows="25" cols="80"></textarea>
    </div>
    <input type="submit" value="Create" name="action">
</form>

</body>
</html>