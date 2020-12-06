<?php 
//
//echo "Modifying reference var:\n";
//$foo = "hello";
//$a = &$foo;
//$a = "bar";
//print_r($foo);
//
//echo "\n\n";
//echo "Passing reference to function:\n";
//function foo($a) {
//    $a = "foo";    
//}
//function foo2(&$a) {
//    $a = "foo";
//}
//$foo = "test";
//foo($foo);
//echo "after foo(), without ref: $foo\n";
//
//foo2($foo);
//echo "after foo2(), with ref: $foo\n";
//
//echo "\n\n";
//echo "Passing references arg to another functions\n";
//function bar(&$a) {
//    bar2($a);
//}
//function bar2(&$a) {
//    // Note that if we don't declare "&$a", then we will not able to modify value!
//    $a = "bar";
//}
//$s = "test";
//bar($s);
//echo "after bar(): $s\n";
//
//echo "\n\n";
//echo "Modifying object argument:\n";
//class Foo {
//    public string $name = '';
//}
//// Note that you don't need reference on "$a"
//function change_foo($a) {
//    $a->name = "foo edited";
//}
//$f = new Foo();
//$f->name = "foo";
//print_r($f);
//change_foo($f);
//echo "After change\n";
//print_r($f);

// More on object and reference: https://www.php.net/manual/en/language.oop5.references.php
// There is a difference between pointer and reference.
// A pointer is memory address identifier to a object when using "new" operator assignment.
// A reference is a alias (copy) of the address identifier.

echo "\n\nArray reference:\n";
function foo_array ($a) {
    array_push($a, 55);
}
$ary = [9, 8, 7];
foo_array($ary);
print_r($ary); // No change!

function foo_array2 (&$a) {
    array_push($a, 55);
}
$ary = [9, 8, 7];
foo_array2($ary);
print_r($ary); // Changed!

