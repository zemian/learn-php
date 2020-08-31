<?php

function foo($arg_1, $arg_2, /* ..., */ $arg_n)
{
	$retval = "test";
    echo "Example function.\n";
    return $retval;
}
foo();

function recursion($a)
{
    if ($a < 20) {
        echo "$a\n";
        recursion($a + 1);
    }
}
recursion(3);

// Nested function
// ===============
function nested_foo() 
{
  echo "This is foo().\n";
  function nested_bar() 
  {
    echo "I don't exist until foo() is called.\n";
  }
}

/* We can't call bar() yet
   since it doesn't exist. */

nested_foo();

/* Now we can call bar(),
   foo()'s processing has
   made it accessible. */
nested_bar();

?>

