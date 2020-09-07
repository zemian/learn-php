<?php
$confirmed = $_GET['confirmed'];
$contact_id = $_GET['id'];

if ($confirmed === "true") {
    include_once '../db-config.php';
    $conn = new mysqli($db_config['servername'], $db_config['username'], $db_config['password'], $db_config['dbname']);
    $sql = 'DELETE FROM contacts WHERE id = ?';
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $contact_id);
    $is_success = $stmt->execute();
    $stmt->close();
    $conn->close();
}
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
                <li class="is-active"><a href="#">Delete</a></li>
            </ul>
        </nav>
        <?php if ($confirmed === "true" && $is_success) { ?>
        <div class="notification is-success">
            Contact ID=<?php echo $contact_id; ?> has been deleted!
        </div>
        <?php } else { ?>
        <h1 class="title">Delete Contact?</h1>
        <div class="message">
            <div class="message-body">
                <p>Are you sure you want to delete Contact ID=<?php echo $contact_id; ?>?</p>
                <a class="button is-danger" href="delete.php?id=<?php echo $contact_id; ?>&confirmed=true">Delete</a>
                <a class="button" href="index.php">Cancel</a>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

</body>
</html>
 