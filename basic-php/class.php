<?php
/*
 * https://www.php.net/manual/en/language.oop5.php
 * About PHP Class
 * - You can not override functions in PHP.
 * - You can use var/public, protected or private modifier.
 */

//// Simple class.
//class Foo {
//    var $name = "World"; // Notice it uses "var" prefix! Omit it then it will error
//    function greet() {
//        echo "Hello $this->name\n";
//    }
//}
//$o = new Foo();
//$o->greet();
//echo "Hello again to $o->name\n";

//// echo Object toString()
//class Foo {
//    public $name = "foo";
//    function __toString() {
//        return "I am a $this->name";
//    }
//}
//echo new Foo(), "\n";
//print_r(new Foo());

//// Extend and Inheritance
//class Base {
//    var $name = 'base';
//    function greet() {
//        return "Hi $this->name";
//    }
//}
//class Foo extends Base{
//    var $name = "foo";
//}
//$o = new Foo();
//echo $o->greet(), "\n";

//// Constructor
//class Foo {
//    var $name;
//    function __construct($name) {
//        // You can call parent constructor like this:
//        // parent::__construct();
//        $this->name = $name;
//    }
//}
//print_r(new Foo('test'));

//// Constants within Class
//class Foo {
//    const PI = 3.14;
//    function demoPI() {
//        echo "PI = " . Foo::PI;
//    }
//}
//echo "Access constant: " . Foo::PI, "\n";
//echo (new Foo())->demoPI(), "\n";

// This is like associative array, but not same type!
echo "\n\nThere is generic stdClass that act as map:\n";
$a = new stdClass();
$a->foo = "Foo";
$a->bar = 99;
print_r($a);
