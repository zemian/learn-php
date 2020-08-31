<?php
// Function overloading does not work
// PHP does not support function overloading, nor is it possible to undefine or redefine previously-declared functions.
//
// NOTE: This produce silent error in PHP 5.6, but PHP 7 will give you a nice "Fatal error: Cannot redeclare foo()"
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL & E_STRICT);

function foo() {
    echo "first time";
}
function foo() {
    echo "foo again";
}
foo();

?>

