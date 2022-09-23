<?php
$env = parse_ini_file("../env.ini", true);
$pdocfg = $env['pdo'];
$db = new PDO($pdocfg['dsn'], $pdocfg['username'], $pdocfg['password']);

function rest_options_list() {
    global $pdo;
    $offset = $_GET['offset'] ?? 0;
    $limit = min($_GET['limit'] ?? 25, 500);
    $stmt = $pdo->prepare('SELECT * FROM options LIMIT ?, ?');
    $stmt->bindParam(1, $offset, PDO::PARAM_INT);
    $stmt->bindParam(2, $limit, PDO::PARAM_INT);
    if ($stmt->execute()) {
        $rows = $stmt->fetchAll(PDO::FETCH_OBJ);
    } else {
        $rows = array();
    }
    return array("items" => $rows);
}

function rest_options_get($name) {
    global $pdo;
    if (!$name) {
        return array("error" => "You need 'name' parameter.");
    }
    $stmt = $pdo->prepare('SELECT * FROM options WHERE name = ?');
    $stmt->bindParam(1, $name);
    if ($stmt->execute()) {
        $row = $stmt->fetch(PDO::FETCH_OBJ);
        if ($row) {
            return $row;
        }
    }
    return array("error" => "There is no record match to 'name'.");
}

function rest_options_delete($opt) {
    global $pdo;
    if (!$opt->name) {
        return array("error" => "You need 'name' parameter.");
    }
    $stmt = $pdo->prepare('DELETE FROM options WHERE name = ?');
    $stmt->bindParam(1, $opt->name);
    if ($stmt->execute()) {
        return array("status" => "Deleted successfully.");
    }
    return array("error" => "There is no record match to 'name'.");
}

function rest_options_update($opt) {
    global $pdo;
    $stmt = $pdo->prepare('UPDATE options SET value = ? WHERE name = ?');
    $stmt->bindParam(1, $opt->value);
    $stmt->bindParam(2, $opt->name);
    if ($stmt->execute()) {
        return array("status" => "Updated successfully.");
    }
    return array("error" => "Unable to update record.");
}

function rest_options_create($opt) {
    global $pdo;
    $stmt = $pdo->prepare('INSERT INTO options (name, value, comment) VALUE (?, ?, ?)');
    $stmt->bindParam(1, $opt->name);
    $stmt->bindParam(2, $opt->value);
    $stmt->bindParam(3, $opt->comment);
    if ($stmt->execute()) {
        return array("status" => "Created successfully.");
    }
    return array("error" => "Unable to create record.");
}

header('Content-Type: application/json');
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $body = file_get_contents('php://input');
        $opt = json_decode($body);
        echo json_encode(rest_options_create($opt));
        break;
    case 'PUT':
        $body = file_get_contents('php://input');
        $opt = json_decode($body);
        echo json_encode(rest_options_update($opt));
        break;
    case 'DELETE':
        $body = file_get_contents('php://input');
        $opt = json_decode($body);
        echo json_encode(rest_options_delete($opt));
        break;
    default:
        if (isset($_GET['name'])) {
            echo json_encode(rest_options_get($_GET['name']));
        } else {
            echo json_encode(rest_options_list());
        }
}
