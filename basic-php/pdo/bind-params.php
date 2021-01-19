<?php
$db = new PDO('mysql:host=localhost;dbname=information_schema', 'zemian', 'test123');
$stmt = $db->prepare('SELECT * FROM tables WHERE table_name = ?');
$stmt->execute(['columns_priv']);
while ($row = $stmt->fetch()) {
    var_dump($row);
}