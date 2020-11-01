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
    
    function read($file) {
        return file_get_contents($file);
    }

    function write($file, $contents) {
        return file_put_contents($file, $contents);
    }
}

// Global Vars
$action = $_GET['action'] ?? "file";
$file_service = new FileService(".", ".md");

// Process POST - Create Form
if (isset($_POST['action']) && ($_POST['action'] === 'Create' || $_POST['action'] === 'Update')) {
    $file = $_POST['file'];
    $file_content = $_POST['file_content'];
    $file_service->write($file, $file_content);
} else if ($action === 'edit') {
    // Process GET Edit Form
    $file = $_GET['file'] ?? 'readme.md';
    if (file_exists($file)) {
        $file_content = $file_service->read($file);
    } else {
        $file_content = "File not found: $file";
    }
} else {
    // Process GET file
    $file = $_GET['file'] ?? 'readme.md';
}

// Continue Process GET - Convert Markdown template into HTML
// We do this even after we process a Form
if (file_exists($file)) {
    if (!isset($file_content)) {
        $file_content = $file_service->read($file);
    }
    require_once __DIR__ . '/vendor/autoload.php';
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

<?php if ($action === 'file') { ?>
    <div class="container is-pulled-right pr-1"><a href="index.php?action=edit&file=<?= $file ?>">Edit</a></div>
<?php }?>

<section class="section">
<div class="columns">
    <div class="column is-3 menu">
        <p class="menu-label">DOCS</p>
        <ul class="menu-list">
            <li><a href='index.php'>Home</a></li>
            <li><a href='index.php?action=new'>New</a></li>
        </ul>
        
        <p class="menu-label">FILES</p>
        <ul class="menu-list">
            <?php
            foreach ($file_service->get_files() as $md_file) {
                $is_active = ($md_file === $file) ? "is-active": "";
                echo "<li><a class='$is_active' href='index.php?file=$md_file'>$md_file</a></li>";
            }
            ?>
        </ul>
    </div>
    <div class="column is-9">
        <?php if ($action === 'file') { ?>
            <div class="content">
                <?= $template_result ?>
            </div>
        <?php } else if ($action === 'new') { ?>
            <form method="POST" action="index.php">
                <div class="field">
                    <div class="label">File Name</div>
                    <div class="control"><input class="input" type="text" name="file"></div>
                </div>
                <div class="field">
                    <div class="label">Markdown</div>
                    <div class="control"><textarea class="textarea" rows="20" name="file_content"></textarea></div>
                </div>
                <div class="field">
                    <div class="control"><input class="button" type="submit" name="action" value="Create"></div>
                </div>
            </form>
        <?php } else if ($action === 'edit') { ?>
            <form method="POST" action="index.php">
                <div class="field">
                    <div class="label">File Name</div>
                    <div class="control"><input class="input" type="text" name="file" value="<?= $file ?>"></div>
                </div>
                <div class="field">
                    <div class="label">Markdown</div>
                    <div class="control"><textarea class="textarea" rows="20" name="file_content"><?= $file_content ?></textarea></div>
                </div>
                <div class="field">
                    <div class="control"><input class="button" type="submit" name="action" value="Update"></div>
                </div>
            </form>
        <?php }?>
    </div>
</div>
</section>

</body>
</html>
