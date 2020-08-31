<?php 
// NOTE: readfile() automatically echo the content, so if you add echo again, it will 
// actually print you the result of the function, which is an int for number of bytes it read.
readfile("file-read.php");
?>