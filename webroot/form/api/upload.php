<?php
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_FILES;
    $data['timestamp'] = date('c');
    echo json_encode($data);
} else {
    echo json_encode(['status' => 'Ready for file upload.', 'timestamp' => date('c')]);
}
