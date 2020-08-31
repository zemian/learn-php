<?php 

$data = array(
	"mon" => 1,
	"tue" => 2,
	"wed" => 3,
);

// https://www.php.net/manual/en/langref.php
echo json_encode($data), "\n"; 

$json = '{"mon":1,"tue":2,"wed":3, "thu":4}';
$map = json_decode($json);
var_dump($map);

// emtpy array
echo 'empty list with array()=', json_encode(array()), "\n"; 

// empty object
echo 'empty object with array()=', json_encode(array(), JSON_FORCE_OBJECT), "\n"; 
?>
