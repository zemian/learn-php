<?php 
//// echo vs print
//// echo and print is not a function but a it is a language construct, so no parenthesis is required
//// NOTE: The major differences to echo are that print only accepts a single argument and always returns 1.
//// NOTE: print behave more like a function though.
//echo "Hello";
//print "World";

// Echo multi parameters vs str concat
//// Strings can either be passed individually as multiple arguments or
//// concatenated together and passed as a single argument
//echo 'This ', 'string ', 'was ', 'made ', 'with multiple parameters.', chr(10);
//echo 'This ' . 'string ' . 'was ' . 'made ' . 'with concatenation.' . "\n";

////  Print only takes 1 argument.
//print "Hello Again\n";
////print "Hello Again\n", "oops"; // error

//// Echo New line
//echo "Use double quote for new line\n";
//echo 'This will not work\n';

//// var_dump() vs var_export() vs print_r()
//// print_r - print human readable variables into STOOUT. Or return string. For Human reader debug only.
////           takes only one var input!
//// var_export - dump variables including into STDOUT. Or return string. For PHP code evaluation
////            takes only one var input!
//// var_dump - dump variables including it's types into STDOUT. For Human reader debug only.
////            takes one more more var inputs.
//$a = range(1, 5);
////print_r($a);
////var_export($a);
////var_dump($a);
////$str = print_r($a, true);
////echo "My var: " . $str;
//$str = var_export($a, true);
//echo "My var: " . $str;