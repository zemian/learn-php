<?php
$confirmed = isset($_GET['confirmed']) ? $_GET['confirmed'] : "false";
$contact_id = isset($_GET['id']) ? $_GET['id'] : -1;

if ($confirmed === "true") {
    include_once 'config.php';
    $conn = create_conn();
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
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/bulma@0.9.1/css/bulma.css">
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
 