<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>PHP Hello</title>
</head>
<body>
    <?php
    /*
    PHP POD requires you compile with the `--with-pdo-mysql` option.

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
    // == Example (PDO)
    */
    try {
      $conn = new PDO("mysql:host=$servername;dbname=zemiandb", $username, $password);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected successfully";
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }

    ?>
</body>
</html>
