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

    $servername = "localhost";
    $username = "zemian";
    $password = "test123";

    /*
    // == Example (MySQLi Object-Oriented)
    */ 
    
    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";

    // The connection will be closed automatically when the script ends. To close the connection before, use the following:
    $conn->close();


    /*
    // == Example (MySQLi Procedural)

    // Create connection
    $conn = mysqli_connect($servername, $username, $password);

    // Check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully";
    */

    /*
    // == Example (PDO)
    try {
      $conn = new PDO("mysql:host=$servername;dbname=zemiandb", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected successfully";
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
    */

    ?>
</body>
</html>
