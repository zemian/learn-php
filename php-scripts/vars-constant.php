<?php 

$var_must_have_dollar = "test";
echo '$var_must_have_dollar', $var_must_have_dollar, "\n";

// Valid constant names
define("FOO",     "something");
define("FOO2",    "something else");
define("FOO_BAR", "something more");
var_dump(FOO, FOO2, FOO_VAR);
echo "FOO, FOO2, FOO_VAR", FOO, FOO2, FOO_VAR, "\n";


define('MIN_VALUE', '0.0');   // RIGHT - Works OUTSIDE of a class definition.
define('MAX_VALUE', '1.0');   // RIGHT - Works OUTSIDE of a class definition.

const MIN_VALUE2 = 0.0;         //RIGHT - Works both INSIDE and OUTSIDE of a class definition.
const MAX_VALUE2 = 1.0;         //RIGHT - Works both INSIDE and OUTSIDE of a class definition.

var_dump(MIN_VALUE, MAX_VALUE);
var_dump(MIN_VALUE2, MAX_VALUE2);

echo "MIN_VALUE, MAX_VALUE ", MIN_VALUE, MAX_VALUE, "\n";
echo "MIN_VALUE2, MAX_VALUE2 ", MIN_VALUE2, MAX_VALUE2, "\n";
?>