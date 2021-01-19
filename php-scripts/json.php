<?php 

//$data = array(
//	"mon" => 1,
//	"tue" => 2,
//	"wed" => 3,
//);
//
//// https://www.php.net/manual/en/langref.php
//echo json_encode($data), "\n"; 
//
//$json = '{"mon":1,"tue":2,"wed":3, "thu":4}';
//$map = json_decode($json);
//var_dump($map);
//
//// emtpy array
//echo 'empty list with array()=', json_encode(array()), "\n"; 
//
//// empty object
//echo 'empty object with array()=', json_encode(array(), JSON_FORCE_OBJECT), "\n"; 

echo "\n\n";
echo "Serialize json from array vs object :\n";
// Note an array is not an object!
$a = array('message' => 'Hello');
echo "array as json: ", json_encode($a);
echo "\n";
$b = new stdClass();
$b->message = 'Hello2';
echo "object as json: ", json_encode($b);
echo "\n";
$c = array($a, $b);
echo "array of objects to json: ", json_encode($c);
echo "\n";
$d = array_filter($c, function ($e) { return !is_object($e); });
echo "after filter array of objects to json: ", json_encode($d);
echo "\n";
