<?php
$db_config = [
    "hostname" => "localhost",
    "username" => "zemian",
    "password" => "test123",
    "dbname" => "learnphpdb"
];

function create_conn() {
	global $db_config;
	$conn = new mysqli($db_config["hostname"], 
		$db_config["username"], 
		$db_config["password"], 
		$db_config["dbname"]);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	return $conn;
}