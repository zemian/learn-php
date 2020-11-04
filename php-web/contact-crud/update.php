<?php

include_once 'config.php';
$conn = create_conn();
$contact_id = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $notiMessage = null;
    $is_error = false;

    // Validate form data first
    foreach (['name', 'email', 'message'] as $name) {
        if (empty($_POST[$name])) {
            $notiMessage = "Missing required fields";
            $is_error = true;
        }
    }

    if (!$is_error) {
        $contact_id = $_POST['id'];
        $sql = 'UPDATE contacts SET name = ?, email = ?, message = ? WHERE id = ?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sssi', $_POST['name'], $_POST['email'], $_POST['message'], $contact_id);
        $result = $stmt->execute();
        if ($result) {
            $notiMessage = "Record updated. ID=$contact_id";
        } else {
            $notiMessage = "Failed to update: $conn->error";
        }
        $stmt->close();
    }
} else {
    $contact_id = $_GET['id'];
}

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
    <title>Contact</title>
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/bulma">
</head>
<body>
<div id="app">
    <div class="section">
        <nav class="breadcrumb">
            <ul>
                <li><a href="index.php">List</a></li>
                <li class="is-active"><a href="#">Update</a></li>
            </ul>
        </nav>
        <h1 class="title">Update Contact</h1>
        <?php if(!empty($notiMessage)) { ?>
            <div class="notification <?php echo ($is_error ? 'is-danger' : 'is-success') ?>">
                <a class="delete" onclick="event.target.parentElement.style.display = 'none'"></a>
                <p><?php echo $notiMessage ?></p>
            </div>
        <?php } ?>
        <form method="POST" action="update.php">
            <input type="hidden" name="id" value="<?php echo $contact_id; ?>">
            <div class="box">
                <div class="box-body">
                    <div class="field">
                        <label class="label">Name</label>
                        <div class="control"><input class="input" name="name" value="<?php echo $contact['name']; ?>">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Email</label>
                        <div class="control"><input class="input" name="email" value="<?php echo $contact['email']; ?>">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Message</label>
                        <div class="control">
                            <textarea class="textarea" name="message"><?php echo $contact['message']; ?></textarea>
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <button class="button is-link">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

</body>
</html>
 