<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Form CRUD Example</title>
  <link rel="stylesheet" type="text/css" href="https://unpkg.com/bulma">
  <script type="text/javascript" src="https://unpkg.com/vue"></script>
</head>
<body>
<div id="app">
  <div id="createRecord" class="section">
    <form method="POST" action="create.php">
    <div class="panel">
      <p class="panel-heading">
        Create New Contact
        <a class="delete is-pulled-right" @click="closeCreateRecord"></a>
      </p>
      <div class="panel-block">
        <div class="control">
          <label class="label">Name</label>
          <input class="input" name="name">
        </div>
      </div>
    </div>
    </form>
  </div>
</div>
</body>
</html>

<?php
include_once "../db-config.php";
if (empty($db_config)) {
  die("No DB config object defined.");
}
$conn = new mysqli($db_config["servername"], $db_config["username"], $db_config["password"], $db_config["dbname"]);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Create DB record with form
echo "Connected successfully";

$conn->close();
?> 