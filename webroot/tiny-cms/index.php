<?php
$slug = $_GET['slug'] ?? 'homepage';
$db = new PDO('mysql:host=localhost;dbname=tinycmsdb;charset=utf8mb4', 'zemian', 'test123');
$slug = $db->quote($slug);
$result = $db->query("SELECT content, content_type FROM content WHERE slug = $slug");
if (!$result) {
    echo "Page slug $slug not found!";
} else {
    $row = $result->fetch();
    $content_type = $row['content_type'];
    if ($content_type === 'md' || $content_type === 'markdown') {
        require "parsedown-1.7.4/Parsedown.php";
        $parsedown = new Parsedown();
        echo $parsedown->text($row['content']);
    } else if ($content_type === 'html')  {
        echo $row['content'];
    } else {
        echo "ERROR: Unknown content type: $content_type";
    }
}
