<?php
/*
// We will implement a typical Data CRUD (Create, Retrieve, Update and Delete) operations
// in PHP with ajax RESTful solution here.

You need to setup DB and a table first

CREATE USER 'zemian'@'localhost' IDENTIFIED WITH mysql_native_password BY 'test123';
CREATE DATABASE learnphpdb CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
GRANT ALL PRIVILEGES ON learnphpdb.* TO 'zemian'@'localhost';
FLUSH PRIVILEGES;

CREATE TABLE contacts (
  id SERIAL,
  create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP NOT NULL,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(200) NOT NULL,
  message VARCHAR(2000) NOT NULL
);

INSERT INTO contacts VALUES (NULL, NULL, 'test', 'test@test.com', 'just a test');
INSERT INTO contacts VALUES (NULL, NULL, 'test2', 'test@test.com', 'just a test');

// How RESTful works:

// return all records
GET /contact

// return a specific record
GET /contact/{id}

// create a new record
POST /contact

// update an existing record
PUT /contact/{id}

// delete an existing record
DELETE /contact/{id}

// Our implementation is based on a solution posted here:
// Ref: https://developer.okta.com/blog/2019/03/08/simple-rest-api-php

*/

// Make DB connection
// ==================

include_once "../db-config.php";
$conn = new mysqli($db_config["servername"], $db_config["username"], $db_config["password"], $db_config["dbname"]);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// RESTful operations
// ==================
function getAll() {
	global $conn;
	$sql = "SELECT * FROM contacts";
	$result = $conn->query($sql);
	$list = $result->fetch_all(MYSQLI_ASSOC);
	//var_dump($body);

	$body = json_encode($list);
	$response = array("status_code_header" => 200, "body" => $body);
	return $response;
}
function create() {
	// TODO
	$body = array();
	$response = array("status_code_header" => 200, "body" => $body);
	return $response;
	
}
function get($contact_id) {
	global $conn;
	$sql = "SELECT * FROM contacts WHERE id = ?";
	// var_dump($sql, $contact_id);
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('i', $contact_id);
	$stmt->execute();
	$result = $stmt->get_result();
	$body = $result->fetch_assoc();
	// var_dump($body);
	$stmt->close();

	$body = json_encode($body, JSON_FORCE_OBJECT);
	$response = array("status_code_header" => 200, "body" => $body);
	return $response;
}
function update($contact_id) {
	// TODO
	$body = array();
	$response = array("status_code_header" => 200, "body" => $body);
	return $response;
}
function delete($contact_id) {
	global $conn;
	$sql = "DELETE FROM contacts WHERE id = ?";
	// var_dump($sql, $contact_id);
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('i', $contact_id);
	$result = $stmt->execute();
	$body = array("result" => $result);
	// var_dump($body);
	$stmt->close();

	$body = json_encode($body, JSON_FORCE_OBJECT);
	$response = array("status_code_header" => 200, "body" => $body);
	return $response;
}

// Process REST request URL
// ========================

$uri = explode('/', $_SERVER['QUERY_STRING']);
//var_dump($uri);

// all of our endpoints start with /contact
// everything else results in a 404 Not Found
if ($uri[1] !== 'contacts') {
    header("HTTP/1.1 404 Not Found");
    die();
}

// the user id is, of course, optional and must be a number:
$contact_id = null;
if (isset($uri[2])) {
    $contact_id = (int) $uri[2];
	//var_dump($contact_id);
	if ($contact_id < 1) {
		echo '{"error": "ID not found."}';
		die();
	}
}

// Process REST request method
// ===========================
$response = array();
$request_method = $_SERVER["REQUEST_METHOD"];
//var_dump($request_method, $contact_id);
switch ($request_method) {
    case 'GET':
        if ($contact_id) {
            $response = get($contact_id);
        } else {
            $response = getAll();
        };
        break;
    case 'POST':
        $response = create();
        break;
    case 'PUT':
        $response = update($contact_id);
        break;
    case 'DELETE':
        $response = delete($contact_id);
        break;
    default:
        $response = array("status_code_header" => 400, "body" => "Invalid request method: " . $request_method);
        break;
}
// var_dump($response);


// Write response
// ==============
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
// header("Access-Control-Max-Age: 3600");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

header('Content-Type: application/json');
header($response['status_code_header']);
if ($response['body']) {
	// JSON_FORCE_OBJECT is needed to return empty array
    echo $response['body'];
}

// Cleanup DB conn
// ===============
$conn->close();

?> 