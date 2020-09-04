<?php
include_once '../db-config.php';
$conn = new mysqli($db_config['servername'], $db_config['username'], $db_config['password'], $db_config['dbname']);
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
    <title>Contact Example</title>
    <link rel="stylesheet" type="text/css" href="/bulma.css">
</head>
<body>
<div id="app">
    <div class="section">
        <a class="button is-primary" href="create.php">Create New Contact</a>
        <h1 class="title">List of Contacts</h1>
        <table class="table">
            <?php foreach ($contacts as $contact) { ?>
            <tr>
                <td>
                    <a href="update.php?id=<?php echo $contact['id'] ?>">Update</a>
                    <a href="delete.php?id=<?php echo $contact['id'] ?>">Delete</a>
                </td>
                <td><a href="view.php?id=<?php echo $contact['id'] ?>"><?php echo $contact['id'] ?></a></td>
                <td><?php echo $contact['create_date'] ?></td>
                <td><?php echo $contact['name'] ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>

</body>
</html>
 