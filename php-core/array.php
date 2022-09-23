<?php
// Simple php array
$a = [1, 2, 3];
echo "Array dump\n";
var_dump($a);

echo "Access by index\n";
echo $a[0];
echo $a[1];
echo $a[2];

echo "Delete element\n";
unset($a[1]);
var_dump($a);
// NOTE: The array index does not change!
//echo "2nd element: $a[1]\n"; // This will give WARNING

echo "Insert new element\n";
array_push($a, 99);
var_dump($a);