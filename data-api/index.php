<?php

$db = new PDO('mysql:host=localhost;dbname=testdb', 'zemian', 'test123');
$stmt = $db->query('SELECT VERSION()');
$result = $stmt->fetch();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header('Content-Type: application/json');
echo json_encode($result);
