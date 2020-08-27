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

?>