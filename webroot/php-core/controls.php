<?php

//// Simple if/else
//$i = random_int(1, 2);
//if ($i == 1)
//    echo "one";
//else
//    echo "two";

//// Simple if/else if/else
//$i = random_int(1, 5);
//if ($i == 1)
//    echo "one";
//else if ($i == 2)
//    echo "two";
//else
//    echo "other";

//// While loop
//$i = 0;
//while ($i < 3) {
//    echo $i, "\n";
//    $i++;
//}

//// Do while loop
//$i = 0;
//do {
//    echo $i, "\n";
//    $i++;
//} while ($i < 3);

//// For loop
//$a = range(1, 5);
//for ($i = 0; $i < count($a); $i++)
//    echo $i, "\n";

//// Foreach loop
//$a = range(1, 5);
//foreach($a as $i)
//    echo $i, "\n";

//// Switch - int
//$a = random_int(1, 3);
//switch ($a) {
//    case 1:
//        echo "one";
//        break;
//    case 2:
//        echo "two";
//        break;
//    default:
//        echo "other";
//        break;
//}

//// Switch - string
//$names = ['one', 'two', 'three'];
//$name = $names[random_int(0, count($names) - 1)];
//switch ($name) {
//    case 'one':
//    case 'two':
//        echo "one or two";
//        break;
//    default:
//        echo "other";
//        break;
//}

//// Early function return
//function test ($i) {
//    if ($i == 0)
//        return;
//    echo "Value of $i";
//}
//test(random_int(0, 3));