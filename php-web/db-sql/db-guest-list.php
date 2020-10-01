<?php

// https://www.w3schools.com/php/php_mysql_select.asp

include_once '../db-config.php';
$conn = new mysqli($db_config['hostname'], $db_config['username'], $db_config['password'], $db_config['dbname']);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, firstname, lastname FROM MyGuests";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
  }
} else {
  echo "0 results";
}
$conn->close();
?> 