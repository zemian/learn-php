<?php
//// Simple php array
//$a = [1, 2, 3];
//echo $a[0];

//// array() or [] - they are the same. The [] was added in PHP 5.4.
//$a = [1, 2, 3];
//$b = array(1,2,3);
//echo $a === $b;

//// [] or {} can be used to access array
//$a = [1, 2, 3];
//echo $a[1], $a{1};

//// array looping
//$a = [1, 2, 3];
//
//$i = 0;
//while ($i < count($a)) {
//    echo "$i: $a[$i]\n";
//    $i++;
//}
//
//for ($i = 0; $i < count($a); $i++)
//    echo "$i: $a[$i]\n";
//
//foreach($a as $x)
//    echo "$x\n";

// PHP array is also a map!

//// list() is a lang construct that "deconstruct" or "spread" an array into variable.
//$a = [1, 2, 3];
//list($x, $y, $y) = $a;
//echo $x, $y, $y;


//// PHP array can also be a map!
//$a = ['a1' => 'apple', 'a2' => 'orange', 'a3' => 'banana'];
//echo $a['a2'], "\n";
//foreach ($a as $k => $v)
//    echo "$k: $v\n";

//// Append to array
//$a = [1, 2, 3];
//$a[] = 4; # For single element, it's better to use this!
//array_push($a, 5);
//print_r($a);

//// Delete Array by index
//$a = [1, 2, 3];
//unset($a[1]);
//print_r($a);
//echo count($a), ", count\n";
//foreach ($a as $x)
//    echo "item: $x\n";
//echo "keys: ";
//print_r(array_keys($a));

//// Pop array (last item in the array)
//$a = [1, 2, 3];
//array_pop($a);
//print_r($a);

//// Array slice
//$a = range(1, 10);
////print_r($a);
//print_r(array_slice($a, 2, 5));

//// Array map callback
// NOTE: First parameter is function!
//$a = [1, 2, 3];
//$a2 = array_map(fn ($e) => $e * 2, $a);
//print_r($a2);

//// Array filter callback
//// NOTE: First parameter is array!
//// See http://phpsadness.com/sad/6
//$a = range(1, 10);
//$a2 = array_filter($a, fn ($e) => $e % 2 == 0);
//print_r($a2);

echo "\n\n";
echo "Is array an object? :\n";
// Note an array is not an object!
$a = array();
var_dump(is_object($a));