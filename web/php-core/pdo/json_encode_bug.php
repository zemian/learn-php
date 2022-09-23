<?php
$db = new PDO('mysql:host=localhost;dbname=information_schema', 'zemian', 'test123');
$stmt = $db->query('SELECT * FROM tables');

// Fetch all objects
$results = $stmt->fetchAll(PDO::FETCH_OBJ);
//var_dump($results);

// This works fine!
echo json_encode($results);
//echo json_encode(array_filter($results, function ($e) { return preg_match('/columns_priv/i', $e->TABLE_NAME); }));

//Bug? Why this result missing ']' in json output ?
echo json_encode(array_filter($results, function ($e) { return preg_match('/^a/i', $e->TABLE_NAME); }));
