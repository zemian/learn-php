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
<p>Hello World.</p>
<p>Current Time is <?php echo date('D, d M Y H:i:s'); ?></p>

<ul>
    <?php 
    for ($i = 0; $i < 10; $i++) {
        if ($i % 2 == 0) {
            echo "<li style='color: red;'>$i</li>";
        } else {
            echo "<li>" . $i . "</li>";
        }
    } 
    ?>
</ul>
</body>
</html>