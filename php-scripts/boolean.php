<?php

// To specify a boolean literal, use the keywords TRUE or FALSE. Both are case-insensitive.
echo TRUE, "\n";  // 1
echo FALSE, "\n"; // <empty>

echo "\$foo=", $foo, "\n"; // Only IDE error, but php will treated as False.

$foo = True; // assign the value TRUE to $foo
echo "\$foo=", $foo, "\n";

// Boolean conversion
/*
When converting to boolean, the following values are considered FALSE:

the boolean FALSE itself
the integers 0 and -0 (zero)
the floats 0.0 and -0.0 (zero)
the empty string, and the string "0"
an array with zero elements
the special type NULL (including unset variables)
SimpleXML objects created from empty tags
Every other value is considered TRUE (including any resource and NAN).
 */

// Warning -1 is considered TRUE, like any other non-zero (whether negative or positive) number!

var_dump((bool) "");        // bool(false)
var_dump((bool) 1);         // bool(true)
var_dump((bool) -2);        // bool(true)
var_dump((bool) "foo");     // bool(true)
var_dump((bool) 2.3e5);     // bool(true)
var_dump((bool) array(12)); // bool(true)
var_dump((bool) array());   // bool(false)
var_dump((bool) "false");   // bool(true)

// Comparison
// ==========

// https://www.php.net/manual/en/language.operators.comparison.php

// $a == $b 	Equal 	TRUE if $a is equal to $b after type juggling.
// $a === $b 	Identical 	TRUE if $a is equal to $
// $a <=> $b 	Spaceship 	An integer less than, equal to, or greater than zero when $a is less than, equal to, or greater than $b, respectively. Available as of PHP 7. 

// If you compare a number with a string or the comparison involves numerical strings, then each string is converted to a number and the comparison performed numerically. 
var_dump(0 == "a"); // 0 == 0 -> true
var_dump("1" == "01"); // 1 == 1 -> true
var_dump("10" == "1e1"); // 10 == 10 -> true
var_dump(100 == "1e2"); // 100 == 100 -> true

// Bool and null are compared as bool always
var_dump(1 == TRUE);  // TRUE - same as (bool)1 == TRUE
var_dump(0 == FALSE); // TRUE - same as (bool)0 == FALSE
var_dump(100 < TRUE); // FALSE - same as (bool)100 < TRUE
var_dump(-10 < FALSE);// FALSE - same as (bool)-10 < FALSE
var_dump(min(-100, -10, NULL, 10, 100)); // NULL - (bool)NULL < (bool)-100 is FALSE < TRUE

// You can't convert string to False boolean like this: both are true!
var_dump((bool)"false", boolval("false"));

// This is the proper way
$b_val = "false";
var_dump($b_val === "false");
