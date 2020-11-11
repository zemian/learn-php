<?php
// PHP basic types
// PHP is a dynamic language, so you don't have to declare type, but it has runtime type
$n = 99;
$n2 = 1234567890;
$n3 = 1234567890123456789;
$f = 3.14;
$f2 = 3.14159265358979323846264338327950288419716939937510;
$flag = true;
$s = "foo";
$s2 = 'foo';
var_dump($n, $n2, $n3, $f, $f2, $flag, $s, $s2);
echo "<hr/>";

// Collection Type

// Array
$a = [7, 8, 9];
$a2 = array(5, 6, 7);
var_dump($a, $a);
echo "<hr/>";

// Associative Array (Map/Dictionary)
$m = array("foo" => 99, "bar" => 88, "baz" => 77);
var_dump($m);
echo "<hr/>";


// End
// Note that if a PHP script file doesn't have any HTML, we normally do want to close the php tag!