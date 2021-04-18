<?php
//function inverse($x) {
//    if (!$x) {
//        throw new Exception('Division by zero.');
//    }
//    return 1/$x;
//}
//
//try {
//    echo inverse(5) . "\n";
//    echo inverse(0) . "\n";
//} catch (Exception $e) {
//    // Exception class api: https://www.php.net/manual/en/class.exception.php
//    echo 'Caught exception: ',  $e->getMessage(), "\n";
//}
//
//// Continue execution
//echo "Hello World\n";

// Finally block
function inverse($x) {
    if (!$x) {
        throw new Exception('Division by zero.');
    }
    return 1/$x;
}

try {
    echo inverse(5) . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
} finally {
    echo "First finally.\n";
}

try {
    echo inverse(0) . "\n";
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
} finally {
    echo "Second finally.\n";
}

// Continue execution
echo "Hello World\n";
