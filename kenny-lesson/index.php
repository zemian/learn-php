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
<H1>PHP Lessons</H1>
<ul>
    <?php
    $files = scandir(".");
    for ($i = 0; $i < count($files); $i++) {
        $file = $files[$i];
        $len = strlen(".php");
        if (substr( $file, - $len ) === ".php") {
            echo "<li><a href='$file'>$file</a></li>";
        }
    }
    ?>
</ul>

</body>
</html>