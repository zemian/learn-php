<?php 
// More advance options dealing with file handler
// https://www.php.net/manual/en/function.fopen.php
// 
// NOTE these can be used to write binary data, and not only text.
//
$fh = fopen("file-handler-test.txt", "w");
fwrite($fh, "Hi there\n");
fclose($fh);

$fh = fopen("file-handler-test.txt", "r");
$data = fread($fh, filesize("file-handler-test.txt"));
fclose($fh);
echo $data;

/*
// How to read chunck of data at a time: 
// https://www.php.net/manual/en/function.fread
$handle = fopen("http://www.example.com/", "rb");
if (FALSE === $handle) {
    exit("Failed to open stream to URL");
}

$contents = '';

while (!feof($handle)) {
    $contents .= fread($handle, 8192);
}
fclose($handle);
 */
?>