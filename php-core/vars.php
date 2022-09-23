<?php

//// Variable in PHP starts with "$" and it dynamic typed
//$foo = "bar";
//echo $foo, "\n";
//$foo = 123;
//echo $foo, "\n";
//$foo = 3.14;
//echo $foo, "\n";
//$foo = false;
//echo $foo, "<-- false\n";
//$foo = true;
//echo $foo, "<-- false\n";

//// Variable scope - all global except inside function
//$foo = 'foo';
//function test () {
////    echo $foo; // Error - Undefined
//    global $foo; // Reference the global
//    echo $foo, "\n";
//}
//function test2 () {
//    $foo = "bar"; // Overrides global
//    echo $foo, "\n";
//}
//test();
//test2();

//// Another way to reference global is to use Superglobals - $GLOBALS"
//$foo = 'foo';
//function test () {
//    $foo = "bar";
//    echo $GLOBALS['foo'], "\n";
//}
//test();

//// Superglobals variables - https://www.php.net/manual/en/language.variables.superglobals.php
//// They are visible in any scope - even in function
////print_r($_SERVER);
//function test() {
//    print_r($_SERVER);
//}
//test();

//// Why Superglobal $_ENV is empty?
//// https://stackoverflow.com/questions/3780866/why-is-my-env-empty
//print_r($_ENV);

//// Variable of variables!
//$foo = 'foo';
//$$foo = 'bar';
//echo $foo, "\n";
//$bar = "test";
//echo "Variable name: ${$foo}\n";

// https://www.php.net/manual/en/ref.var.php
//echo "\n\nChecking for variable types:\n";
//var_dump("is_bool", is_bool("1"));
//var_dump("is_bool", is_bool(boolval("1")));
//var_dump("is_array", is_array([]));
//var_dump("is_array", is_array(['foo' => 99]));
//var_dump("is_array", is_array(explode(' ', 'a b c')));
//var_dump("is_array", is_array(new stdClass()));
//var_dump("is_object", is_object(new stdClass()));
//var_dump("is_object", is_object([]));
//var_dump("is_callable", is_callable('is_callable'));
//var_dump("is_callable", is_callable('var_dump'));
//var_dump("is_callable", is_callable(null));
//var_dump("is_callable", is_callable('foo'));

echo "\n\nGet types:\n";
$data = array(1, 1., NULL, new stdClass, 'foo');
foreach ($data as $value) {
    echo gettype($value), "\n";
}