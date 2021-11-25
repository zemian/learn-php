<?php
$db = new PDO('mysql:dbname=test;host=localhost', 'zemian', 'test123');
$stmt = $db->query('select * from options');
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<h1>DB TEST</h1>";
echo "<pre>";
var_dump($results);
echo "<pre>";
