<?php
//// Simple class.
//class Foo {
//    var $name = "World"; // Notice it uses "var" prefix! Omit it then it will error
//    function greet() {
//        echo "Hello $this->name\n";
//    }
//}
//$v = new Foo();
//$v->greet();
//echo "Hello again to $v->name\n";

// toString()
class Foo {
    public $name = "foo";
    function __toString() {
        return "I am a $this->name";
    }
}
echo new Foo(), "\n";
print_r(new Foo());