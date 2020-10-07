<?php

// First a non-closure function example:
function cube($n)
{
    return ($n * $n * $n);
}

$a = [1, 2, 3, 4, 5];
$b = array_map('cube', $a);
print_r($b);


// Closure - Anonymous Function
// https://www.php.net/manual/en/functions.anonymous.php
// https://www.php.net/manual/en/language.types.callable.php

$b = array_map(function ($n) {
    return ($n * $n * $n);
}, $a);
print_r($b);

$cube = function ($n) {
    return ($n * $n * $n);
};
$b = array_map($cube, $a);
print_r($b);

// Capturing parent scope vars
$size = 3;
$cube2 = function ($n) use ($size) {
	$ret = $n;
	for ($i = 1; $i < $size; $i++) {
		$ret = $ret * $n;
	}
    return $ret;
};
$b = array_map($cube2, $a);
print_r($b);
