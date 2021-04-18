<?php
require_once '../env.php';
$db = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
function create_table() {
    global $db;
    $sql = <<< HERE
        CREATE TABLE IF NOT EXISTS options (
            id INT PRIMARY KEY AUTO_INCREMENT,
            create_ts TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            update_ts DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
            name VARCHAR(500) NOT NULL UNIQUE,
            value TEXT NOT NULL,
            comment TEXT NULL
        )
HERE;
    $stmt = $db->prepare($sql);
    if ($stmt->execute()) {
        return array("status" => "Table is created.");
    } else {
        return array("status" => "Create failed.", "error" => $db->errorInfo());
    }
}

function create_sample() {
    global $db;
    $stmt = $db->prepare('INSERT INTO options (name, value) VALUE (?, ?)');
    $count = 0;
    foreach ($_SERVER as $k => $v) {
        $stmt->bindParam(1, $k);
        $stmt->bindParam(2, $v);
        if ($stmt->execute()) {
            $count++;
        }
    }
    return array("status" => "Sample inserted.", "count" => $count);
}

header('Content-Type: application/json');
switch($_GET['action'] ?? '') {
    case 'create_table':
        echo json_encode(create_table());
        break;
    case 'create_sample':
        echo json_encode(create_sample());
        break;
    default:
        echo json_encode(array(
            'queryParametersUsage' => '?action=create_table',
            'queryParametersUsage2' => '?action=create_sample',
            'timestamp' => date('c')
        ));
}
