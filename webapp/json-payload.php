<?php 

// https://www.php.net/manual/en/function.header.php
// Remember that header() must be called before any actual output is sent
header('Content-Type: application/json');

$data = array(
	"mon" => 1,
	"tue" => 2,
	"wed" => 3,
);

echo json_encode($data);

?>