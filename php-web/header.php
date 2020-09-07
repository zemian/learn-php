<?php 

// https://www.php.net/manual/en/function.header.php
// Remember that header() must be called before any actual output is sent

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("foo-test: bar"); // Date in the past

echo "Hello";

?>