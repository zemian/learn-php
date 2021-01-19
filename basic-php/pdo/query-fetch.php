<?php
$db = new PDO('mysql:host=localhost;dbname=information_schema', 'zemian', 'test123');
$stmt = $db->query('SELECT * FROM tables');

//echo sprintf("%s %s\n", "TABLE_SCHEMA", "TABLE_NAME");
//while ($row = $stmt->fetch()) {
//    echo sprintf("%s %s\n", $row['TABLE_SCHEMA'], $row['TABLE_NAME']);
//}

//// Row return type: PDO::FETCH_BOTH, array with index and column names
//$row = $stmt->fetch();
//var_dump($row);

//// Row return type: object
//$row = $stmt->fetch(PDO::FETCH_OBJ);
//var_dump($row);

// Fetch all objects
$results = $stmt->fetchAll(PDO::FETCH_OBJ);
var_dump($results);
