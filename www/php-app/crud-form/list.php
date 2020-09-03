<?php
include_once '../db-config.php';
$conn = new mysqli($db_config['servername'], $db_config['username'], $db_config['password'], $db_config['dbname']);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Query data
$sql = 'SELECT * FROM contacts ORDER BY create_date DESC';
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$contacts = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Form CRUD Example</title>
    <link rel="stylesheet" type="text/css" href="/learn-php/www/bulma.css">
</head>
<body>
<div id="app">
    <div class="section">
        <h1 class="title">List of Contacts</h1>
        <table class="table">
            <?php foreach ($contacts as $contact) { ?>
            <tr>
                <td><?php echo $contact['id'] ?></td>
                <td><?php echo $contact['create_date'] ?></td>
                <td><?php echo $contact['name'] ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>

</body>
</html>
 