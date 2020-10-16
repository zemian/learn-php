<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>PHP Hello</title>
</head>
<body>

<h1>PHP Data Object (PDO)</h1>
<h2>Available Drivers</h2>
<ul>
<?php
$drivers = PDO::getAvailableDrivers();
foreach ($drivers as $name)
    echo "<li>$name</li>";
?>
</ul>

<h2>POD_MYSQL TEST</h2>
<?php
// See https://www.php.net/manual/en/class.pdo.php
try {
    $db = new PDO("mysql:host=localhost;dbname=learnphpdb", 'zemian', 'test123');
    echo "<p>MySQL DB connected successfully</p>";
    $version = $db->query('SELECT version()')->fetch()[0];
    echo "<p>Mysql version: $version</p>";
} catch (PDOException $e) {
    echo "MySQL DB connection failed: " . $e->getMessage();
}
?>
</body>
</html>
