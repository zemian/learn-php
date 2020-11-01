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
        $result = $db->query("SELECT slug, content FROM content WHERE id = $content_id_param");
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
    <title>TinyCMS Admin</title>
</head>
<body>

<h1>Edit Content</h1>
<a href="/admin/index.php">Cancel</a>
<form method="POST">
    <input type="hidden" name="id" value="<?= $content_id ?>">
    <div>
        <label>Slug</label>
        <input type="text" name="slug" value="<?= $slug ?>">
    </div>
    <div>
        <label>ContentType</label>
        <input type="text" name="content_type" value="<?= $content_type ?>">
    </div>
    <div>
        <label>Content</label>
        <textarea name="content" rows="25" cols="80"><?= $content ?></textarea>
    </div>
    <input type="submit" value="Update" name="action">
</form>

</body>
</html>