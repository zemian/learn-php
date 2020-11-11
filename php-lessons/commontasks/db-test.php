<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<pre>
    <?php
    $db = new PDO('mysql:host=localhost;dbname=employees', 'zemian', 'test123');
    $result = $db->query('SELECT count(*) FROM employees');
    $row = $result->fetch();
    print_r( $row );
    ?>
</pre>
</body>
</html>