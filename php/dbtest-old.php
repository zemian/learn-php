<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>PHP Hello</title>
</head>
<body>
    <?php

    $servername = "localhost";
    $username = "zemian";
    $password = "test123";

    /*
    // == Older style of mysql_connect()
    // https://www.php.net/manual/en/function.mysql-connect.php
    */
    $link = mysql_connect($servername, $username, $password);
    if (!$link) {
        die('Could not connect: ' . mysql_error());
    }
    echo 'Connected successfully';
    mysql_close($link);

    ?>
</body>
</html>
