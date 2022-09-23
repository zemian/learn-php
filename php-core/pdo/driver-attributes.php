<?php
$conn = new PDO('sqlite::memory:');
//$conn = new PDO('mysql:host=localhost;dbname=mysql', 'zemian', 'test123');
$attributes = array(
    "AUTOCOMMIT", "ERRMODE", "CASE", "CLIENT_VERSION", "CONNECTION_STATUS",
    "ORACLE_NULLS", "PERSISTENT", "PREFETCH", "SERVER_INFO", "SERVER_VERSION",
    "TIMEOUT"
);

foreach ($attributes as $val) {
    echo "PDO::ATTR_$val: ";
    try {
        echo $conn->getAttribute(constant("PDO::ATTR_$val")) . "\n";
    } catch (PDOException $e) {
        echo "NOT_SUPPORTED\n";
    }
}
