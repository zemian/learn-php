<?php 
// PHP Namespaces provide a way in which to group related classes, interfaces, functions and constants. Here is an example of namespace syntax in PHP: 
// https://www.php.net/manual/en/language.namespaces.rationale.php
//
// NOTE: PHP Namespace uses backslash as separator "\"
//
// NOTE: PHP Namespace must be declare at the very top of the file!

namespace my\name; // see "Defining Namespaces" section

class MyClass {}
function myfunction() {
    echo "I am inside myfunction()\n";
}
const MYCONST = 1;

$a = new MyClass;
$b = new \my\name\MyClass; // see "Global Space" section
$c = strlen('hi');         // see "Using namespaces: fallback to global
                           // function/constant" section
$d = namespace\MYCONST;    // see "namespace operator and __NAMESPACE__
                           // constant" section
var_dump($a, $b, $c, $d);

myfunction();
\my\name\myfunction();

echo "__NAMESPACE__=" . __NAMESPACE__ . "\n";

$e = __NAMESPACE__ . '\MYCONST';
echo constant($e); // see "Namespaces and dynamic language features" section
echo "\n";