<?php
file_put_contents("file-write-test.txt", "Hi there");
readfile("file-write-test.txt");

// You can't write to dir that does not exists
// error_reporting(E_ALL);
// file_put_contents("temp/foo.txt", "Hi there\n");
