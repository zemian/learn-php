<?php
$contact_id = $_GET['id'];

include_once '../db-config.php';
$conn = new mysqli($db_config['hostname'], $db_config['username'], $db_config['password'], $db_config['dbname']);
$sql = 'SELECT * FROM contacts WHERE id = ?';
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $contact_id);
$stmt->execute();
$result = $stmt->get_result();
$contact = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Contact Example</title>
    <link rel="stylesheet" type="text/css" href="/bulma.css">
</head>
<body>
<div id="app">
    <div class="section">
        <nav class="breadcrumb">
            <ul>
                <li><a href="index.php">List</a></li>
                <li class="is-active"><a href="#">View</a></li>
            </ul>
        </nav>
        <h1 class="title">Contact Details</h1>
        <table class="table">
            <tr>
                <td>ID</td>
                <td><?php echo $contact['id'] ?></td>
            </tr>
            <tr>
                <td>Create Date</td>
                <td><?php echo $contact['create_date'] ?></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><?php echo $contact['name'] ?></td>
            </tr>
            <tr>
                <td>Message</td>
                <td><?php echo $contact['message'] ?></td>
            </tr>
        </table>
    </div>
</div>

</body>
</html>
 