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
curl 'http://localhost:3000/php-app/crud-restful/contact-rest.php?/contacts'
NOTE: It's important to use quote!

// return a specific record
GET /contact/{id}
curl 'http://localhost:3000/php-app/crud-restful/contact-rest.php?/contacts/1'

// create a new record
POST /contact
curl -H 'Content-Type: application/json'\
 -X POST\
 -d '{"name":"test","email":"test@localhost.com","message":"just a test"}'\
 'http://localhost:3000/php-app/crud-restful/contact-rest.php?/contacts'

// update an existing record
PUT /contact/{id}

curl -H 'Content-Type: application/json'\
 -X PUT\
 -d '{"name":"test-update","email":"test@localhost.com","message":"just a test"}'\
 'http://localhost:3000/php-app/crud-restful/contact-rest.php?/contacts/1'

// delete an existing record
DELETE /contact/{id}
curl -X DELETE 'http://localhost:3000/php-app/crud-restful/contact-rest.php?/contacts/1'

// Our implementation is based on a solution posted here:
// Ref: https://developer.okta.com/blog/2019/03/08/simple-rest-api-php

*/

// Make DB connection
// ==================

include_once "../db-config.php";
$conn = new mysqli($db_config["hostname"], $db_config["username"], $db_config["password"], $db_config["dbname"]);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// RESTful operations
// ==================
function getAll() {
	global $conn;
	$sql = "SELECT * FROM contacts ORDER BY create_date DESC";
	$result = $conn->query($sql);
	$list = $result->fetch_all(MYSQLI_ASSOC);
	//var_dump($body);

	$body = json_encode($list);
	$response = ["status_code_header" => 200, "body" => $body];
	return $response;
}
function create() {
	global $conn;
	date_default_timezone_set('UTC');
	$json_input = file_get_contents('php://input');
	//var_dump($json_input);
	$post_data = (array) json_decode($json_input);
	$post_data['create_date'] = date('Y-m-d H:i:s');
	$sql = 'INSERT INTO contacts (create_date, name, email, message) VALUES (?, ?, ?, ?)';
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('ssss', $post_data['create_date'], $post_data['name'], $post_data['email'], $post_data['message']);
	$result = $stmt->execute();
	if ($result) {
		$post_data['id'] = $conn->insert_id;
		$body = json_encode($post_data);
		$response = ["status_code_header" => 200, "body" => $body];
	} else {
		$body = json_encode(['error' => 'DB insert failed']);
		$response = ["status_code_header" => 500, "body" => $body];
	}
	$stmt->close();
	
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
	$stmt->close();

	$body = json_encode($body, JSON_FORCE_OBJECT);
	$response = ["status_code_header" => 200, "body" => $body];
	return $response;
}
function update($contact_id) {
	global $conn;
	$json_input = file_get_contents('php://input');
	//file_put_contents("/tmp/php.txt", $json_input);
	$post_data = (array) json_decode($json_input);
	$post_data['id'] = $contact_id;
	$sql = 'UPDATE contacts SET name = ?, email = ?, message = ? WHERE id = ?';
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('sssi', $post_data['name'], $post_data['email'], $post_data['message'], $post_data['id']);
	$result = $stmt->execute();
	if ($result) {
//		var_dump($stmt->affected_rows);
		if ($stmt->affected_rows > 0) {
			$body = json_encode($post_data);
			$response = ["status_code_header" => 200, "body" => $body];
		}
	}
	
	if (empty($response)) {
		$body = json_encode(['error' => 'DB update failed: ' . $stmt->error]);
		$response = ["status_code_header" => 500, "body" => $body];
	}
	$stmt->close();

	return $response;
}
function delete($contact_id) {
	global $conn;
	$sql = "DELETE FROM contacts WHERE id = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('i', $contact_id);
	$result = $stmt->execute();
	if ($result) {
		$body = ["deleted" => $stmt->affected_rows];
		$body = json_encode($body, JSON_FORCE_OBJECT);
		$response = ["status_code_header" => 200, "body" => $body];
	} else {
		$body = json_encode(['error' => 'DB insert failed']);
		$response = ["status_code_header" => 500, "body" => $body];
	}
	$stmt->close();

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
$response = [];
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
        $response = ["status_code_header" => 400, "body" => "Invalid request method: " . $request_method];
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