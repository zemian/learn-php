<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Learning PHP</title>
</head>
<body>
<H1>Learning PHP</H1>
<ul>
    <?php
    foreach (scandir(".") as $file) {
        echo "<li><a href='$file'>$file</a></li>";
    }
    ?>
</ul>

</body>
</html>
