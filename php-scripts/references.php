<?php 

echo "Modifying reference var:\n";
$foo = "hello";
$a = &$foo;
$a = "bar";
print_r($foo);

echo "\n\n";
echo "Passing reference to function:\n";
function foo($a) {
    $a = "foo";    
}
function foo2(&$a) {
    $a = "foo";
}
$foo = "test";
foo($foo);
echo "after foo(), without ref: $foo\n";

foo2($foo);
echo "after foo2(), with ref: $foo\n";

echo "\n\n";
echo "Passing references arg to another functions\n";
function bar(&$a) {
    bar2($a);
}
function bar2(&$a) {
    // Note that if we don't declare "&$a", then we will not able to modify value!
    $a = "bar";
}
$s = "test";
bar($s);
echo "after bar(): $s\n";
