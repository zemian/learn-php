<?php
/* 
 * A simple REST API that manage CRUD data record
 * 
 * Example usage:
 * http://localhost/learn-php/data-api/index.php?action=test_db
 * http://localhost/learn-php/data-api/index.php?action=init_data
 * http://localhost/learn-php/data-api/index.php?action=create_data&count=1000
 * http://localhost/learn-php/data-api/index.php
 * http://localhost/learn-php/data-api/index.php?offset=20
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

function print_sql_result($sql, $paramTypes = [], $params = []) {
    try {
        $result = run_sql($sql, $paramTypes, $params);
        print_json($result);
    } catch (PDOException $e) {
        print_error(['message' => $e->getMessage(), 
            'errorInfo' => $e->errorInfo,
            'code' => $e->getCode()
        ]);
    }
}

$db = null;
function connect_db() {
    // Caching global $db object.
    global $db;
    if ($db === null)
        $db = new PDO('mysql:host=localhost;dbname=testdb', 'zemian', 'test123');
    return $db;
}

function run_sql($sql, $paramTypes = [], $params = []) {
    $db = connect_db();
    $stmt = $db->prepare($sql);
    $count = count($paramTypes);
    if ($count > 0)
        for ($i = 0; $i < $count; $i++)
            $stmt->bindValue($i + 1, $params[$i], $paramTypes[$i]);
    $success = $stmt->execute();
    if (!$success) {
        $msg = "Failed to execute SQL: $sql; Params: " . var_export($params, true);
        $code = $db->errorCode();
        $e =  new PDOException($msg, $code);
        $e->errorInfo = $db->errorInfo();
        throw $e;
    }
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function test_db() {
    print_sql_result('SELECT VERSION()');
}

function init_table() {
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
    print_json(['status' => 'New table created']);
}

function create_data() {
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
    $offset = $_GET['offset'] ?? 0;
    $limit = $_GET['limit'] ?? 20;
    $sql = 'SELECT * FROM contacts ORDER BY create_ts LIMIT ?, ?';
    print_sql_result($sql, [PDO::PARAM_INT, PDO::PARAM_INT], [$offset, $limit]);
}