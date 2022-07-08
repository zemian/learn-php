<?php
/**
 * A simple API that will fetch static data file from a directory.
 */

$data_dir = "../data";
$file = $_GET['file'] ?? '';
// Let a error_file override if found
if (isset($_GET['error_file']) && $_GET['error_file']) {
    $file = $_GET['error_file'];
}
$data_file = realpath("$data_dir/$file");

//var_dump([$data_file, "$data_dir/$file"]);
if (!is_file($data_file)) {
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode(["error" => "Invalid file parameter"]);
} else {
    // Allow user to set status code on response
    $status_code = $_GET['status_code'] ?? '';
    if (!$status_code && isset($_GET['error_file']) && $_GET['error_file']) {
        $status_code = 500;
    }
    if ($status_code) {
        $status_msg = $_GET['status_msg'] ?? '';
        header("HTTP/1.1 $status_code $status_msg");
    }

    // Add headers
    if (!isset($_GET['Content-Type'])) {
        header('Content-Type: application/json');
    }
    if (!isset($_GET['Access-Control-Allow-Origin'])) {
        header('Access-Control-Allow-Origin: *');
    }

    // Just add all input query params as header!
    foreach($_GET as $key => $value) {
        header("$key: $value");
    }

    // Load data file
    $data_content = file_get_contents($data_file);
    echo $data_content;
}
