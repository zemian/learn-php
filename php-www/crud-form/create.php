<?php
include_once "db-config.php";
if (empty($db_config)) {
  die("No DB config object defined.");
}
$conn = new mysqli($db_config["servername"], $db_config["username"], $db_config["password"], $db_config["dbname"]);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create DB record with form
echo "Connected successfully";

$conn->close();
?> 