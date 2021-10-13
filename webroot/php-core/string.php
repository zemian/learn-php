<?php

//// Single quote - string literal
//// Double quote - string evaluation (variable expansion) NOTE: only variable, it will not evaluate expression or function call!
////echo 'this is a simple string';
//$foo = 'bar';
//echo "This is $foo";

//// New line constant - OS dependent
//// PHP_EOL = "\n";
//echo "Hi\n";
//echo "Hi".PHP_EOL;


//// String literal can span multiple lines
//echo 'You can also have embedded newlines in
//strings this way as it is
//okay to do';

//// Single quote escape and avoid variable expand
//echo 'Arnold once said: "I\'ll be back"';
//echo 'You deleted C:\\*.*?';
//echo 'You deleted C:\*.*?';
//echo 'This will not expand: \n a newline';
//echo 'Variables do not $expand $either';

//// Double quote strings
//$foo = "bar";
//$a = [1, 2, 3];
//echo "This will expand into new line\n";
//echo "Hello \$foo\n";
//echo "Hello $foo\n";
//echo "Hello ${foo}\n"; // not proper but works - see more below
//echo "Hello {$foo}\n"; // a more proper way
//echo "Hello $a[0]\n";
//echo "Hello ${a[0]}\n";
////echo "Expression ${$a[0] + $a[1]}\n"; // error - you cannot evaluate expression within the ${}
//echo "Expression " . ($a[0] + $a[1]) . "\n"; // do this instead

//// More on Double string expression
//$x = 1; $y = 2;
//function get_name() { return "x"; }
//echo "Expression {$x}\n";
////echo "Expression {$x + $y}\n"; // error
//echo "Expression {${get_name()}}\n"; // NOTE: The get_name() must return a variable name!
//echo "Expression {{get_name()}}\n"; // Will not evaluated
//echo "Expression {get_name()}\n"; // Will not evaluated
////echo "Expression {$get_name()}\n"; // error


//echo "Expression {$x + $y}\n"; // error

// Single vs Double quote speed.
// The double quote string needs to expand variable, so technically slower, but for all practical purpose
// developers do not need to worry about it.

//// HEREDOC string
//$name = "test";
//$str = <<<EOD
//Example $name of string
//spanning multiple lines
//using heredoc syntax.
//EOD;
//echo $str;

////  BAD - EOD; should not have space in front.
//echo <<<EOD
//test
//    EOD;

////  This is okay:
//echo <<<EOD
//test
//EOD;

////  But this is okay too?
//echo <<<EOD
//    test
//    two
//    EOD;

//// NOWDOC string
//// The HEREDOC is like double quote string, while NOWDOC is like single quote string.
//// Notice you single quote the 'EOD'
//echo <<<'EOD'
//Hello world\n
//EOD;

//// Accessing characters in string
//echo PHP_EOL;
//$s = "Hello";
//echo '$s[1]=', $s[1], "\n";
//echo 'strlen($s)=', strlen($s), "\n";
//for ($i = 0; $i < strlen($s); $i++) {
//    echo "\$s[$i]=", $s[$i], "\n";
//}

// Split and Joining string
// NOTE: Do not use str_split() - it is used to split string in equal chunks!
//print_r(explode("/", "foo/bar/baz"));
//print_r(implode(":", range(1, 5)));

// Substring
$s = "The quick brown fox jumps over the lazy dog.";
echo "strlen=" . strlen($s) . "\n";
echo "str_pad=" . str_pad("foo", 10, ' ', STR_PAD_LEFT) . "\n";
echo "substr=" . substr($s, 2, 10) . "\n";
echo "str_replace=" . str_replace('fox', 'rabbit', $s) . "\n";
echo "strpos=" . strpos($s, 'fox') . "\n";
echo "str_shuffle=" . str_shuffle($s) . "\n";
echo "str_repeat=" . str_repeat('foo', 3) . "\n";
echo "strtolower=" . strtolower($s) . "\n";
echo "strtoupper=" . strtoupper($s) . "\n";
echo "strcmp=" . strcmp($s, $s) . "\n";
echo "trim=" . trim('  foo  ') . "<--ends\n";
