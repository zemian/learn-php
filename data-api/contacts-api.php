<?php
/* 
A simple REST API that manage CRUD data record

Example usage:
http://localhost/learn-php/data-api/index.php?action=test_db
http://localhost/learn-php/data-api/index.php?action=init_data
http://localhost/learn-php/data-api/index.php?action=create_data&count=1000
http://localhost/learn-php/data-api/index.php
http://localhost/learn-php/data-api/index.php?offset=20
http://localhost/learn-php/data-api/index.php?action=get_data&id=1
http://localhost/learn-php/data-api/index.php?action=delete_data&id=1
curl \
  -d '{"id":"1", "name":"tester","email":"tester@localhost.com","message":"Just a test for update"}' \
  -H 'Content-Type: application/json' \
  http://localhost/learn-php/data-api/index.php?action=update_data

 */

// Main Script - process request
process_request();

// Script Functions
function process_request() {
    $action = $_GET['action'] ?? 'list_data';
    switch ($action) {
        case 'test_db':
            test_db();
            break;
        case 'init_table':
            init_table();
            break;
        case 'create_data':
            create_data();
            break;
        case 'list_data':
            list_data();
            break;
        case 'delete_data':
            delete_data();
            break;
        case 'get_data':
            get_data();
            break;
        case 'update_data':
            update_data();
            break;
        default:
            print_error('Unknown action ' . $action);
    }    
}

function print_json($payload) {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header('Content-Type: application/json');
    echo json_encode($payload);
}

function print_error($error) {
    print_json(['error' => $error]);
}

$db = null;
function connect_db() {
    // Caching global $db object.
    global $db;
    if ($db === null)
        $db = new PDO('mysql:host=localhost;dbname=testdb', 'zemian', 'test123');
    return $db;
}

function run_sql($sql, $options = []) {
    $params = $options['params'] ?? [];
    $paramTypes = $options['paramTypes'] ?? [];
    $rowCount = $options['rowCount'] ?? false;
    $db = connect_db();
    $stmt = $db->prepare($sql);
    $count = count($params);
    if ($count > 0) {
        for ($i = 0; $i < $count; $i++) {
            $param = $params[$i];
            $type = $paramTypes[$i] ?? PDO::PARAM_STR;
            $stmt->bindValue($i + 1, $param, $type);
        }
    }
    $success = $stmt->execute();
    if (!$success) {
        $msg = "Failed to execute SQL: $sql; Params: " . var_export($params, true);
        $code = $db->errorCode();
        $e =  new PDOException($msg, $code);
        $e->errorInfo = $db->errorInfo();
        throw $e;
    }
    if ($rowCount)
        return $stmt->rowCount();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function test_db() {
    try {
        $sql = 'SELECT VERSION() AS mysql_version';
        $db = connect_db();
        $stmt = $db->query($sql);
        print_json($stmt->fetch(PDO::FETCH_ASSOC));
    } catch (PDOException $e) {
        print_error($e);
    }
}

function init_table() {
    try {
        // Drop table if exists!
        run_sql('DROP TABLE IF EXISTS contacts');
        run_sql('
        CREATE TABLE contacts (
            id INT  NOT NULL AUTO_INCREMENT PRIMARY KEY,
            create_ts TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(200) NOT NULL,
            message TEXT NOT NULL
        )'
        );
        print_json(['message' => 'New table created']);
    } catch (PDOException $e) {
        print_error($e);
    }
}

function create_data() {
    // Generate random tests data
    $count = $_GET['count'] ?? 10;
    $request_id = $_GET['request_id'] ?? time();
    $name = $_GET['name'] ?? 'tester';
    $message = $_GET['message'] ?? 'Just a test.';
    
    try {
        $sql = 'INSERT INTO contacts(name, email, message) VALUES (?, ?, ?)';
        $db = connect_db();
        $stmt = $db->prepare($sql);
        for ($i = 0; $i < $count; $i++) {
            $stmt->bindValue(1, $name . $i);
            $stmt->bindValue(2, $name . $i . '@localhost.com');
            $stmt->bindValue(3, $message . '\nrequest_id=' . $request_id);
            $success = $stmt->execute();
            if (!$success)
                throw new PDOException("Failed to execute SQL: $sql");
        }
        $result = ['request_id' => $request_id,
            'count' => $count,
            'name' => $name,
            'message' => $message
        ];
        print_json($result);
    } catch (PDOException $e) {
        print_error($e);
    }
}

function list_data() {
    try {
        // List and paginate data
        $offset = $_GET['offset'] ?? 0;
        $limit = $_GET['limit'] ?? 20;
        $sql = 'SELECT * FROM contacts ORDER BY create_ts LIMIT ?, ?';
        $result = run_sql($sql, ['params' => [$offset, $limit], 'paramTypes' => [PDO::PARAM_INT, PDO::PARAM_INT]]);
        print_json($result);
    } catch (PDOException $e) {
        print_error($e);
    }
}

function delete_data() {
    try {
        $id = $_GET['id'] ?? 0;
        $sql = 'DELETE FROM contacts WHERE id = ?';
        $result = run_sql($sql, ['params' => [$id], 'paramTypes' => [PDO::PARAM_INT], 'rowCount' => true]);
        if ($result > 0)
            print_json(['message' => "Record id $id has been deleted"]);
        else
            print_error("Record id $id not found.");
    } catch (PDOException $e) {
        print_error($e);
    }
}

function get_data() {
    try {
        $id = $_GET['id'] ?? 0;
        $sql = 'SELECT * FROM contacts WHERE id = ?';
        $result = run_sql($sql, ['params' => [$id], 'paramTypes' => [PDO::PARAM_INT]]);
        if (count($result) > 0)
            print_json($result[0]);
        else
            print_error("Record id $id not found.");
    } catch (PDOException $e) {
        print_error($e);
    }
}

function update_data() {
    try {
        $body = file_get_contents('php://input');
        $data = json_decode($body, true); // true = parse into array instead of object
        $id = $data['id'];
        $sql = 'UPDATE contacts SET name = ?, email = ?, message = ? WHERE id = ?';
        $result = run_sql($sql, [
            'params' => [$data['name'], $data['email'], $data['message'], $id],
            'paramTypes' => [PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_STR, PDO::PARAM_INT],
            'rowCount' => true]);
        if ($result > 0)
            print_json(['message' => "Record id $id has been updated"]);
        else
            print_error("Record id $id not found.");
    } catch (PDOException $e) {
        print_error($e);
    }
}