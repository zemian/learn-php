<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://unpkg.com/bulma">
    <title>Learning PHP</title>
</head>
<body>

<div class="level">
    <div class="level-item">
        <div class="content">
            <h1>Learning PHP</h1>
            <?php if (isset($_GET['dir'])) { ?>
            <p><a href="index.php">ROOT_DIR</a> / <?= $_GET['dir'] ?></p>
            <?php } ?>
            <ul>
                <?php
                $dir = __DIR__ . '/' . ($_GET['dir'] ?? '');
                $files = array_slice(scandir($dir), 2);
                foreach ($files as $file) {
                    if (is_dir($file)) {
                        echo "<li class='has-text-weight-bold'><a href='$file'>$file</a></li>";
                    }
                }
                foreach ($files as $file) {
                    if (!is_dir($file)) {
                        echo "<li><a href='$file'>$file</a></li>";
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</div>

</body>
</html>
