<?php 
//The scope of a variable is the context within which it is defined. For the most part all PHP variables only have a single scope. This single scope spans included and required files as well.


// Function Scope Isolation
// ========================
//
// Function has it's own scope and will not able to see global vars!
// 
// However, within user-defined functions a local function scope is introduced. Any variable used inside a function is by default limited to the local function scope. 


$a = 1; /* global scope */ 

function test()
{ 
    echo $a; /* reference to local scope variable */ 
} 

test();
// This script will not produce any output because the echo statement refers to a local version of the $a variable, and it has not been assigned a value within this scope.


// Seing Global Variables
// ======================
$a = 1;
$b = 2;

function Sum()
{
    global $a, $b;

    $b = $a + $b;
} 

Sum();
echo $b;

// About the $GLOBALS
// ==================

// A second way to access variables from the global scope is to use the special PHP-defined $GLOBALS array. The previous example can be rewritten as: 

$a = 1;
$b = 2;

function Sum2()
{
    $GLOBALS['b'] = $GLOBALS['a'] + $GLOBALS['b'];
} 

Sum2();
echo $b;


// Static Function Vars
// ====================
// A static variable exists only in a local function scope, but it does not lose its value when program execution leaves this scope.

function test2()
{
    static $a = 0;
    echo $a;
    $a++;
}
test2();
test2(); 
?>