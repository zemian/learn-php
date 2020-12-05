<?php 
// How to implement callback function - use "call_user_func"
// https://www.php.net/manual/en/language.types.callable.php

// An example callback function
function my_callback_function() {
    echo "hello world!\n";
}

// An example callback method
class MyClass {
    static function myCallbackMethod2() {
        echo "hello world2!\n";
    }
    function myCallbackMethod3() {
        echo "hello world3!\n";
    }
}

// Type 1: Simple callback
call_user_func('my_callback_function');

// Type 2: Static class method call
call_user_func(array('MyClass', 'myCallbackMethod2'));

// Type 3: Object method call
$obj = new MyClass();
call_user_func(array($obj, 'myCallbackMethod3'));

// Type 4: Static class method call (As of PHP 5.2.3)
call_user_func('MyClass::myCallbackMethod2');

// Type 5: Relative static class method call (As of PHP 5.3.0)
class A {
    public static function who() {
        echo "A\n";
    }
}

class B extends A {
    public static function who() {
        echo "B\n";
    }
}

call_user_func(array('B', 'parent::who')); // A

// Type 6: Objects implementing __invoke can be used as callables (since PHP 5.3)
class C {
    public function __invoke($name) {
        echo 'Hello ', $name, "\n";
    }
}

$c = new C();
call_user_func($c, 'PHP!');

// Passing array arguments
function foo ( $a, $b, $c ) {
    print("foo arguments: ");
    print_r([$a, $b, $c]);
}
call_user_func("foo", 5, 6, 7);
//call_user_func("foo", [5, 6, 7]); // Error! Can't do this with argument mismatched!
call_user_func_array("foo", [9, 8, 7]); // This is okay!

// Passing reference argument
//error_reporting(E_ALL);
function increment(&$var)
{
    $var++;
}

$a = 0;

// This will generate a warning! Can't pass reference this way
//call_user_func('increment', $a);
//echo $a."\n";

// You can use this instead
call_user_func_array('increment', array(&$a));
echo $a."\n";
