<?php
require_once 'env.php';

$req_uri = $_SERVER['REQUEST_URI'];
if (substr($req_uri, strlen($req_uri) - 4) !== '.php') {
    $req_uri .= 'index.php';
}
$base_url = sprintf(
    "%s://%s%s",
    isset($_SERVER['HTTPS']) ? 'https' : 'http',
    $_SERVER['SERVER_NAME'],
    dirname($req_uri)
);
$php_files = array();
foreach (scandir(__DIR__) as $file) {
    if ($file !== '.' && $file !== '..') {
        $php_files[]= $file;
    }
}
echo "</ul>\n";
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Learn PHP</title>
    <style>
        body {
            font-size: large;
        }
    </style>
</head>
<body>
<h1>Learn PHP</h1>
<ul>
    <?php
    foreach ($php_files as $file) {
        $link = "$base_url/$file";
        ?>
        <li><a href="<?php echo $link; ?>"><?php echo $file; ?></a></li>
    <?php } ?>
</ul>
</body>
</html>
