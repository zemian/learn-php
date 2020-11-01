<?php
$slug = $_GET['slug'] ?? 'homepage';
$db = new PDO('mysql:host=localhost;dbname=tinycmsdb;charset=utf8mb4', 'zemian', 'test123');
$slug = $db->quote($slug);
$result = $db->query("SELECT content FROM content WHERE slug = $slug");
if (!$result) {
    echo "Page slug $slug not found!";
} else {
    $content = $result->fetch()[0];
    echo $content;
}
