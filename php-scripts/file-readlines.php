<?php
$fh = fopen("file-readlines.php", "r") or die("Unable to open file!");
while(!feof($fh)) {
    // fgets() read one line
    echo fgets($fh);
}
fclose($fh);
?>