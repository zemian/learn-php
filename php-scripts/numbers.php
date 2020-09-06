<?php
// Int numbers
// ===========
$a = 1234; // decimal number
$a = 0123; // octal number (equivalent to 83 decimal)
$a = 0x1A; // hexadecimal number (equivalent to 26 decimal)
$a = 0b11111111; // binary number (equivalent to 255 decimal)
//$a = 1_234_567; // decimal number (as of PHP 7.4.0)

echo $a, "\n";
echo "PHP_INT_SIZE", PHP_INT_SIZE, "\n";
echo "PHP_INT_MAX", PHP_INT_MAX, "\n";
echo "PHP_INT_MIN", PHP_INT_MIN, "\n"; // since PHP 7.0.0

// Overflow
// If PHP encounters a number beyond the bounds of the integer type, it will be interpreted as a float instead.
$large_number = 2147483647;
var_dump($large_number);                     // int(2147483647)

$large_number = 2147483648;
var_dump($large_number);                     // float(2147483648)

$million = 1000000;
$large_number =  50000 * $million;
var_dump($large_number);                     // float(50000000000)

/* Hm... for PHP 5.6, above output is NOT correct!
int(2147483647)
int(2147483648)
int(50000000000)
*/

// Int to boolean
// FALSE will yield 0 (zero), and TRUE will yield 1 (one).

// NULL is always converted to zero (0).

// Convert string to int
$foo = 1 + "10.5";                // $foo is float (11.5)
$foo = 1 + "-1.3e3";              // $foo is float (-1299)
$foo = 1 + "bob-1.3e3";           // $foo is integer (1)
$foo = 1 + "bob3";                // $foo is integer (1)
$foo = 1 + "10 Small Pigs";       // $foo is integer (11)
$foo = 4 + "10.2 Little Piggies"; // $foo is float (14.2)
$foo = "10.0 pigs " + 1;          // $foo is float (11)
$foo = "10.0 pigs " + 1.0;        // $foo is float (11)

echo "\$foo==$foo; type is " . gettype ($foo) . "<br />\n";

// Float numbers
// =============
$a = 1.234;
$b = 1.2e3;
$c = 7E-10;
//$d = 1_234.567; // as of PHP 7.4.0
echo $a, "\n";
echo .1 + .2, "\n";
echo floor((0.1+0.7)*10), "\n";

// $a and $b are equal to 5 digits of precision.
$a = 1.23456789;
$b = 1.23456780;
$epsilon = 0.00001;
if(abs($a-$b) < $epsilon) {
    echo "true\n";
}

echo "NAN=", NAN, "\n";
echo is_nan(1), "\n";
echo is_nan(NAN), "\n";

