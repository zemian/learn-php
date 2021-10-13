<?php 
// https://stackoverflow.com/questions/1053424/how-do-i-get-php-errors-to-display

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL | E_STRICT);

echo $foo;


