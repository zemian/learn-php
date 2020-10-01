<?php

// Create new instance of DB conn object. If the returned value is stored in
// "$conn" variable, then it will auto close by calling "app_footer()".
function app_create_conn() {
	$db_config = [
			"servername" => "localhost",
			"username" => "zemian",
			"password" => "test123",
			"dbname" => "employees"
	];
	$conn = new mysqli($db_config["servername"], 
		$db_config["username"], 
		$db_config["password"], 
		$db_config["dbname"]);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	return $conn;
}

function app_init() {
	// Init app here before any header is printed
}

function app_header() {
	app_init();

echo <<<HERE
<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<title>Employees App</title>
		<link rel="stylesheet" type="text/css" href="https://unpkg.com/bulma@0.9.1/css/bulma.css">
		<script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
</head>
<body>

<nav class="navbar" role="navigation" aria-label="main navigation">
	<div class="navbar-brand">
		<a class="navbar-item" href="index.php">
			<img src="https://labs.mysql.com/common/logos/mysql-logo.svg?v2" alt="Employees App" width="50" height="28">
		</a>
	</div>
</nav>

<section class="section">
HERE;

}

function app_destory() {
	// Let's try to close db if it's set from the application. 
	// It will only work if we use "$conn" variable consistently
	global $conn;
	if (isset($conn)) {
		$conn->close();
	}
}

function app_footer() {

echo <<<HERE
</section>
</body>
</html>
HERE;

	app_destory();
}
