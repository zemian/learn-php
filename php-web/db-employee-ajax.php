<?php

// Ref: https://www.w3schools.com/php/php_ajax_database.asp

// NOTE: Ajax result does not always has to be JSON. This example is simply returning HTML table.

// To test this page alone: http://localhost:3000/db-employee-ajax.php?q=2

include_once "db-config.php";
$conn = new mysqli($db_config["hostname"], $db_config["username"], $db_config["password"], $db_config["dbname"]);

if (!$con) {
  die('Could not connect: ' . mysqli_error($con));
}

$q = intval($_GET['q']);
// mysqli_select_db($con, $dbname);
$sql="SELECT * FROM employees WHERE id = ".$q."";
//echo $sql;
$result = mysqli_query($con, $sql);

// NOTE: If you don't check for error, then mysqli_fetch_array() might givey ou
// odd error like this: 
//  mysqli_fetch_array() expects parameter 1 to be mysqli_result, bool given in ...

if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}

echo "<table>
<tr>
<th>Firstname</th>
<th>Lastname</th>
<th>Age</th>
<th>Hometown</th>
<th>Job</th>
</tr>";

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
  //var_dump($row);
  echo "<tr>";
  echo "<td>" . $row['firstname'] . "</td>";
  echo "<td>" . $row['lastname'] . "</td>";
  echo "<td>" . $row['age'] . "</td>";
  echo "<td>" . $row['hometown'] . "</td>";
  echo "<td>" . $row['job'] . "</td>";
  echo "</tr>";
}
echo "</table>";
mysqli_close($con);
?>
