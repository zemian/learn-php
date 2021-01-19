<?php 
//// https://www.php.net/manual/en/ref.var.php
//echo "\n\nStrings to Booleans:\n";
//var_dump(is_bool("1"));
//var_dump(is_bool("0"));
//var_dump(is_bool(""));
//var_dump(is_bool(boolval("1")));
//var_dump(is_bool(boolval("0")));
//var_dump(is_bool(boolval("1")));
//var_dump(is_bool(boolval("0")));


//
// When operating between int and string, or string and int, the result is always int!
//
//echo "\n\nAuto convert string to int:\n";
//$s = "9";
//$a = $s * 2;
//echo $a . "\n"; // Prints 18, not "99"
//echo gettype($a) . "\n"; // integer

//echo "\n\nAuto convert int to string:\n";
//$a = 89;
//$b = $a + "0";
//echo $b . "\n"; // Prints 89, not "890"
//echo gettype($b) . "\n"; // integer

//echo "\n\nHow to concatenate string and int:\n";
//echo "89" . 123 . "\n"; // 89123

////error_reporting(NULL);
//echo "Bad string to int\n";
//echo "foo" + 89; // prints 89! But it should produce a warning!
