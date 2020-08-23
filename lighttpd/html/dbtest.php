<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>PHP Hello</title>
</head>
<body>
    <?php
    /*
    https://www.w3schools.com/php/php_mysql_connect.asp

    PHP 5 and later can work with a MySQL database using:

        MySQLi extension (the "i" stands for improved)
        PDO (PHP Data Objects)

    PDO will work on 12 different database systems, whereas MySQLi will only work with MySQL databases.
    */

    // Example (MySQLi Object-Oriented)
    $servername = "localhost";
    $username = "zemian";
    $password = "test123";

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";

    // The connection will be closed automatically when the script ends. To close the connection before, use the following:
    $conn->close();
    ?> 
</body>
</html>
