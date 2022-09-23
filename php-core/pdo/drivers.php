<?php
/*
Driver: dblib
Driver: mysql
Driver: odbc
Driver: pgsql
Driver: sqlite
 */
foreach(PDO::getAvailableDrivers() as $driver)
    echo "Driver: $driver\n";
