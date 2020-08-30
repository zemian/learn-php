<?php
// We will implement a typical Data CRUD (Create, Retrieve, Update and Delete) operations
// in PHP with ajax RESTful solution here.

/*
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

// Setup Response headers
// ==================
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// Make DB connection
// ==================

$servername = "localhost";
$username = "zemian";
$password = "test123";
$dbname = "learnphpdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// RESTful operations
// ==================
function getAll() {
	$response = array("status_code_header" => 200, "body" => "getAll");
}
function create() {
	$response = array("status_code_header" => 200, "body" => "create");
	
}
function get($user_id) {
	$response = array("status_code_header" => 200, "body" => "get " . $user_id);
}
function update($user_id) {
	$response = array("status_code_header" => 200, "body" => "update " . $user_id);
}
function delete($user_id) {
	$response = array("status_code_header" => 200, "body" => "delete " . $user_id);
}

// Process REST reqeust URL
// ========================

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

// all of our endpoints start with /contact
// everything else results in a 404 Not Found
if ($uri[1] !== 'contact') {
    header("HTTP/1.1 404 Not Found");
    exit();
}

// the user id is, of course, optional and must be a number:
$user_id = null;
if (isset($uri[2])) {
    $user_id = (int) $uri[2];
}

$requestMethod = $_SERVER["REQUEST_METHOD"];

// Process REST request method
// ===========================
switch ($requestMethod) {
    case 'GET':
        if ($user_id) {
            $response = get($user_id);
        } else {
            $response = getAll();
        };
        break;
    case 'POST':
        $response = create();
        break;
    case 'PUT':
        $response = update($user_id);
        break;
    case 'DELETE':
        $response = delete($user_id);
        break;
    default:
        $response = array("status_code_header" => 400, "body" => "Invalid request method: " . $requestMethod);
        break;
}

// Write response
// ==============

header($response['status_code_header']);
if ($response['body']) {
    echo $response['body'];
}

// Cleanup DB conn
// ===============
$conn->close();

?> 