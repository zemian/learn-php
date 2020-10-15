<?php

// Many features related to OO programming and Classes/Objects are here documented here:
// https://www.php.net/manual/en/language.oop5.php

// NOTE: Default visibility is public for properties and methods, but you need the "var" prefix!
class SimpleClass
{
    // property declaration
    var $var = 'a default value';

    // method declaration
    function displayVar() {
        echo $this->var;
    }
}

//echo "SimpleClass instance", new SimpleClass(), "\n"; // can't convert to string unless you define "__toString()".
var_dump("SimpleClass instance", new SimpleClass());

$foo = new SimpleClass();
$foo->var = "foo";
var_dump("Modified \$foo", $foo);
$foo->displayVar();
echo "\n";

// Class extension
class ExtendClass extends SimpleClass
{
    // Redefine the parent method
    function displayVar()
    {
        echo "Extending class\n";
        parent::displayVar();
    }
}

$extended = new ExtendClass();
$extended->displayVar();
echo "\n";

// Ge the name of class
echo ExtendClass::class, "\n";

// Constants
class MyClass
{
    const CONSTANT = 'constant value';

    function showConstant() {
        echo  self::CONSTANT . "\n";
    }
}

echo MyClass::CONSTANT . "\n";

$classname = "MyClass";
echo $classname::CONSTANT . "\n"; // As of PHP 5.3.0

$class = new MyClass();
$class->showConstant();

echo $class::CONSTANT."\n"; // As of PHP 5.3.0

// Constructor
class BaseClass {
    var $prop1;
    function __construct($prop1 = "foo") {
        print "In BaseClass constructor\n";
        $this->$prop1 = $prop1;
    }
}

class SubClass extends BaseClass {
    function __construct() {
        parent::__construct();
        print "In SubClass constructor\n";
    }
}
var_dump("SubClass", new SubClass());

// NOTE: A object instances of same type can access their "private" fields!