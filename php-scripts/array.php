<?php 
// PHP array can also be list or map!

// Functions to manipulate array https://www.php.net/manual/en/ref.array.php

// PHP > 5.4, you can use [] instead of array();

$my_array = ["foo" => 123, "bar" => 49];

// Using it as list
// ================
$array = array('red', 'blue', 'green', 'yellow');
var_dump($array);
for ($i = 0; $i < count($array); $i++)
    var_dump($array[$i]);

foreach ($array as $color) {
    echo "Do you like $color?\n";
}
// Loop with index
foreach ($array as $i => $value) {
    echo "Do you like $i : $color?\n";
}

// Append items
$array[] = "tomato";
var_dump('Append using $array[]=...', $array);

array_push($array, "purple");
var_dump("Append using array_push", $array);

// Delete item
array_pop($array);
var_dump("Remove after array_pop", $array);

unset($array[count($array) - 1]);
var_dump("after delete", $array);

// Using it as map
// ===============
$array = array(
    "maptest" => "works",
    "foo" => "bar",
    "bar" => "foo",
);
foreach ($array as $key => $value) {
    echo "$key = $value\n";
}
echo '$array["foo"]=', $array["foo"], "\n";

// as of PHP 5.4
$array = [
    "maptest" => "PHP 5.4 style",
    "foo" => "bar",
    "bar" => "foo",
];
var_dump($array);

// Careful with key types, some gets overwritten
$array = array(
    1    => "a",
    "1"  => "b",
    1.5  => "c",
    true => "d",
);
var_dump($array);

// 2D multi arrays
$array = array(
    "foo" => "bar",
    42    => 24,
    "multi" => array(
        "dimensional" => array(
            "array" => "foo"
        )
    )
);

var_dump($array["foo"]);
var_dump($array[42]);
var_dump($array["multi"]["dimensional"]["array"]);

// Delete array
$arr = array(5 => 1, 12 => 2);

$arr[] = 56;    // This is the same as $arr[13] = 56;
// at this point of the script

$arr["x"] = 42; // This adds a new element to
// the array with key "x"

unset($arr[5]); // This removes the element from the array
var_dump($arr);
unset($arr);    // This deletes the whole array
var_dump($arr); // NULL


// Looping map and use of "print_r"
// Create a simple array.
$array = array(1, 2, 3, 4, 5);
print_r($array);

// Now delete every item, but leave the array itself intact:
foreach ($array as $i => $value) {
    unset($array[$i]);
}
print_r($array);

// Append an item (note that the new key is 5, instead of 0).
$array[] = 6;
print_r($array);

// Re-index:
$array = array_values($array);
$array[] = 7;
print_r($array);

print_r(array_keys($array));

