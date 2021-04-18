<?php
$env = parse_ini_file("../env.ini", true);
header('Content-Type: application/json');
switch($_GET['resources'] ?? '') {
    case 'env':
        // WARNING: We are exposing sensitvie data here for DEMO purpose only!
        echo json_encode($env);
        break;
    default:
        echo json_encode(array(
            'message' => 'Welcome to API service. Use "?resources=name" query parameter to choose an endpoint',
            'timestamp' => date('c')
        ));
}
