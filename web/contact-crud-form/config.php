<?php

function create_conn() {
    $db_config = [
        "hostname" => "localhost",
        "username" => "zemian",
        "password" => "test123",
        "dbname" => "testdb"
    ];
    $conn = new mysqli($db_config["hostname"],
        $db_config["username"],
        $db_config["password"],
        $db_config["dbname"]);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

//    if ($conn->query('SELECT count(*) FROM contacts') === FALSE) {
//        die("Table 'contact' does not exist in DB: " . $conn->connect_error);
//    }

    return $conn;
}
