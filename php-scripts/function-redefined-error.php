<?php
// Function overloading does not work
// PHP does not support function overloading, nor is it possible to undefine or redefine previously-declared functions.
//
// NOTE: Ensure you do not have php.ini set with "error_reporting = NULL", else you will not
// see Fatal error on Console!

function foo() {
    echo "first time";
}

if (function_exists("foo")) {
	echo "function foo exists!";
}

// Ooops
function foo() {
    echo "foo again";
}
foo();



