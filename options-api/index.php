<?php
$env = parse_ini_file("../env.ini", true);
$pdocfg = $env['pdo'];
$db = new PDO($pdocfg['dsn'], $pdocfg['username'], $pdocfg['password']);

function api_create_table() {
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

function api_sample() {
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

function api_list() {
    global $db;
    $offset = $_GET['offset'] ?? 0;
    $limit = min($_GET['limit'] ?? 25, 500);
    $stmt = $db->prepare('SELECT * FROM options LIMIT ?, ?');
    $stmt->bindParam(1, $offset, PDO::PARAM_INT);
    $stmt->bindParam(2, $limit, PDO::PARAM_INT);
    if ($stmt->execute()) {
        $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
    } else {
        $rows = array();
    }
    return array("items" => $rows);
}

function api_get($name) {
    global $db;
    if (!$name) {
        return array("error" => "You need 'name' parameter.");
    }
    $stmt = $db->prepare('SELECT * FROM options WHERE name = ?');
    $stmt->bindParam(1, $name);
    if ($stmt->execute()) {
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        if ($row) {
            return $row;
        }
    }
    return array("error" => "There is no record match to 'name'.");
}

function api_delete($name) {
    global $db;
    if (!$name) {
        return array("error" => "You need 'name' parameter.");
    }
    $stmt = $db->prepare('DELETE FROM options WHERE name = ?');
    $stmt->bindParam(1, $name);
    if ($stmt->execute()) {
        return array("status" => "Deleted successfully.");
    }
    return array("error" => "There is no record match to 'name'.");
}

function api_update($opt) {
    global $db;
    $stmt = $db->prepare('UPDATE options SET value = ? WHERE name = ?');
    $stmt->bindParam(1, $opt->value);
    $stmt->bindParam(2, $opt->name);
    if ($stmt->execute()) {
        return array("status" => "Updated successfully.");
    }
    return array("error" => "Unable to update record.");
}

function api_create($opt) {
    global $db;
    $stmt = $db->prepare('INSERT INTO options (name, value) VALUE (?, ?)');
    $stmt->bindParam(1, $opt->name);
    $stmt->bindParam(2, $opt->value);
    if ($stmt->execute()) {
        return array("status" => "Created successfully.");
    }
    return array("error" => "Unable to create record.");
}

//header('Content-Type: application/json');
var_dump($_SERVER['REQUEST_METHOD']);
//if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
//    echo json_encode(api_delete($_GET['name'] ?? null));
//} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
//    $body = file_get_contents('php://input');
//    $opt = json_decode($body);
//    echo json_encode(api_update($opt));
//} else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//    $body = file_get_contents('php://input');
//    $opt = json_decode($body);
//    echo json_encode(api_create($opt));
//} else {
//    switch($_GET['resources'] ?? '') {
//        case 'create_table':
//            echo json_encode(api_create_table());
//            break;
//        case 'sample':
//            echo json_encode(api_sample());
//            break;
//        default:
//            if (isset($_GET['name'])) {
//                echo json_encode(api_get($_GET['name']));
//            } else {
//                echo json_encode(api_list());
//            }
//    }
//}
