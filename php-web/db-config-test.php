<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>PHP Hello</title>
</head>
<body>
    <?php

    // Test db-config.php
    
    include_once "db-config.php";
    // if (empty($db_config)) {
    //     die("No DB config object defined.");
    // }
    $conn = new mysqli($db_config["hostname"], $db_config["username"], $db_config["password"], $db_config["dbname"]);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";
    $conn->close();
    ?>
</body>
</html>
