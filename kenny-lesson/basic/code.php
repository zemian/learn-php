<?php
class FileService {
    var $scan_dir;
    function __construct($scan_dir = ".") {
        $this->scan_dir = $scan_dir;
    }
    
    function get_php_files() {
        $ret = [];
        $files = scandir($this->scan_dir);
        for ($i = 0; $i < count($files); $i++) {
            $file = $files[$i];
            $ext = ".php";
            $len = strlen($ext);
            if (substr_compare($file, $ext, -$len) === 0) {
                array_push($ret, $file);
            }
        }
        return $ret;
    }
}
?>

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
<H1>How we can organize code</H1>
<ul>
    <?php
    $service = new FileService();
    foreach ($service->get_php_files() as $file) {
        echo "<li><a href='$file'>$file</a></li>";
    }
    ?>
</ul>

</body>
</html>