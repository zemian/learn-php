<?php 

// echo and print is not a function but a it is a language construct, so no parenthesis is required
// NOTE: The major differences to echo are that print only accepts a single argument and always returns 1.
// NOTE: print behave more like a function though.
echo "Hello World";

// Strings can either be passed individually as multiple arguments or
// concatenated together and passed as a single argument
echo 'This ', 'string ', 'was ', 'made ', 'with multiple parameters.', chr(10);
echo 'This ' . 'string ' . 'was ' . 'made ' . 'with concatenation.' . "\n";

print "Hello Again\n";
//print "Hello Again\n", "oops"; // error

// NOTE: When running php script, you need "\n" to print new line
print("Hello Worl\n");
print "print() also works without parentheses.\n";

// print_r, var_dump, var_export

// print_r - print human readable variables into STOOUT. Or return string. For debug only.
//           takes only one var inpjut!
// var_dump - dump variables including it's types into STDOUT. For debug only.
//            takes one more more var inputs.
// var_export - dump variables including it's types into STDOUT. Or return string. For PHP code evaluation
//            takes only one var input!

$map = ['fruit' => 'apple', 'number' => 123, 'price' => 99.99, 'boolean' => true];
print("test print_r\n");
print_r($map);
$map_string = print_r($map, true);
print("\n" . $map_string);

print("test var_dump\n");
var_dump("test", $map, ['a', 'b', 'c'], true, 99.99, 123);

print("test var_export\n");
var_export($map);
$map_string2 = var_export($map, true);
print("\n" . $map_string2);
print("\n");
