<?php 
// A simple php to browse a Document Root directory where it list all the learning PHP script.
// - A "*.*" file should be listed as a link and load the page when clicked.
// - A sub-folder should be listed separately and when clicked, it should browse the content for ".php" files again. 
// - If we are in a sub-folder listing, we should provide a link to go back to parent directory.

// Page vars
$dirs = [];
$files = [];
$browse_dir = '';
$parent_browse_dir = $browse_dir = $_GET['parent'] ?? '';
$error = '';

// Find what $browse_dir and $list_path is
$root_path = __DIR__;
$list_path = $root_path;
if (isset($_GET['dir'])) {
    $browse_dir = $_GET['dir'];
    $list_path .= "$browse_dir";
}

// Now get list of dirs and files
// We get rid off the first two entries for "." and ".." returned by scandir().
if (is_dir($list_path)) {
    $list = array_slice(scandir($list_path), 2);
    foreach ($list as $item) {
        if (is_dir("$list_path/$item")) {
            array_push($dirs, $item);
        } else {
            array_push($files, $item);
        }
    }
} else {
    $error = "ERROR: Invalid directory.";
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
    <title>Learning PHP</title>
</head>
<body>
<div class="section">
    <div class="level">
        <div class="level-item">
            <a href="index.php"><h1 class="title">Learning PHP</h1></a>
        </div>
    </div>
    <div class="columns">
        <div class="column is-one-third">
            <!-- List of Sub Folders -->
            <div class="menu">                
                <p class="menu-label">Directory: <?= $browse_dir; ?></p>
                <ul class="menu-list">
                    <?php if ($browse_dir !== '') { ?>
                        <li><a href="index.php?dir=<?= $parent_browse_dir ?>">..</a></li>
                    <?php } ?>
                    <?php foreach ($dirs as $item) { ?>
                    <li><a href="index.php?dir=<?= "$browse_dir/$item" ?>&parent=<?= $browse_dir ?>"><?= $item ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="column">
            <?php if ($error) { ?>
                <div class="notification is-danger">
                    <?= $error ?>
                </div>
            <?php } else { ?>
                <!-- List of Files -->
                <div class="content">
                    <ul>
                        <?php foreach ($files as $item) { ?>
                            <li><a href="<?= "$browse_dir/$item" ?>"><?= $item ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

</body>
</html>
