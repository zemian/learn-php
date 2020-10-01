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
    $conn = create_conn();
    echo "Connected successfully";
    $conn->close();
    ?>
</body>
</html>
