<?php

class FileService {
    var $scan_dir;
    var $file_ext;
    
    function __construct($scan_dir = ".", $file_ext = ".php") {
        $this->scan_dir = $scan_dir;
        $this->file_ext = $file_ext;
    }

    function get_files() {
        $ret = [];
        $files = scandir($this->scan_dir);
        for ($i = 0; $i < count($files); $i++) {
            $file = $files[$i];
            $len = strlen($this->file_ext);
            if (substr_compare($file, $this->file_ext, -$len) === 0) {
                array_push($ret, $file);
            }
        }
        return $ret;
    }
}

require __DIR__ . '/vendor/autoload.php';
$file = $_GET['file'] ?? 'readme.md';
if (file_exists($file)) {
    $file_content = file_get_contents($file);
    $parsedown = new Parsedown();
    $template_result = $parsedown->text($file_content);
} else {
    $template_result = "File not found: $file";
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://unpkg.com/bulma">
    <title>Docs</title>
</head>
<body>

<section class="section">
<div class="columns">
    <div class="column is-3 menu">
        <p class="menu-label">Notes</p>
        <ul class="menu-list">
            <?php
            $service = new FileService(".", ".md");
            foreach ($service->get_files() as $md_file) {
                $is_active = ($md_file === $file) ? "is-active": "";
                echo "<li><a class='$is_active' href='index.php?file=$md_file'>$md_file</a></li>";
            }
            ?>
        </ul>
    </div>
    <div class="column is-9">
        <div class="content">
            <?= $template_result ?>
        </div>
    </div>
</div>
</section>

</body>
</html>
