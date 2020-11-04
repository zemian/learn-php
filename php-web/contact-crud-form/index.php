<?php
include_once 'config.php';

$conn = create_conn();
$sql = 'SELECT * FROM contacts ORDER BY create_ts DESC';
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
    <title>Contact</title>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/bulma">
</head>
<body>
<div id="app">
    <div class="section">
        <nav class="breadcrumb">
            <ul>
                <li class="is-active"><a href="#">List</a></li>
            </ul>
        </nav>
        <a class="button is-primary" href="create.php">New Contact</a>
        <table class="table">
            <?php foreach ($contacts as $contact) { ?>
            <tr>
                <td><?php echo $contact['name'] ?></td>
                <td><?php echo $contact['email'] ?></td>
                <td><?php echo $contact['create_ts'] ?></td>
                <td>
                    <a href="view.php?id=<?php echo $contact['id'] ?>">View</a>
                    <a href="update.php?id=<?php echo $contact['id'] ?>">Update</a>
                    <a href="delete.php?id=<?php echo $contact['id'] ?>">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>

</body>
</html>
 