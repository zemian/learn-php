<?php

function foobar($arg_1, $arg_2, /* ..., */ $arg_n)
{
	$retval = "test";
    echo "Example function.\n";
    return $retval;
}
foobar();

function recursion($a)
{
    if ($a < 20) {
        echo "$a\n";
        recursion($a + 1);
    }
}
recursion(3);

// Nested function
function foo() 
{
  echo "This is foo().\n";
  function bar() 
  {
    echo "I don't exist until foo() is called.\n";
  }
}

/* We can't call bar() yet
   since it doesn't exist. */

foo();

/* Now we can call bar(),
   foo()'s processing has
   made it accessible. */
bar();


// // TODO: Why this produce silent error??

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// // Function overloading does not work
// // PHP does not support function overloading, nor is it possible to undefine or redefine previously-declared functions.
// function foo() {
// 	echo "foo again"
// }
// foo();

?>

