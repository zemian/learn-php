<?php
echo "\n\n";
echo "Is array an object? :\n";
// Note an array is not an object!
$a = array();
var_dump(is_object($a));
$b = new stdClass();
var_dump(is_object($b));
