<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>PHP Hello</title>
</head>
<body>
    <?php
    
    $hostname = "localhost:3306";
    $username = "zemian";
    $password = "test123";
    $dbname = "learnphpdb";

    /*
    // == Older style of mysql_connect()
    // https://www.php.net/manual/en/function.mysql-connect.php
    */
    $link = mysql_connect($hostname, $username, $password);
    if (!$link) {
        die('Could not connect: ' . mysql_error());
    }
    echo 'Connected successfully';

    mysql_select_db($dbname);
    $result = mysqli_query($link, 'SELECT version()');
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    var_dump($row);
    mysql_close($result);

    mysql_close($link);

    ?>
</body>
</html>
