<?php
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
        include_once '../db-config.php';
        $conn = new mysqli($db_config['servername'], $db_config['username'], $db_config['password'], $db_config['dbname']);
        $sql = 'INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $_POST['name'], $_POST['email'], $_POST['message']);
        $result = $stmt->execute();
        if ($result) {
            $notiMessage = "Record inserted. ID=$conn->insert_id";
        } else {
            $notiMessage = "Failed to insert: $conn->error";
        }
        $stmt->close();
        $conn->close();
    }
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
                <li class="is-active"><a href="#">Create</a></li>
            </ul>
        </nav>
        <h1 class="title">Create New Contact</h1>
        <?php if(!empty($notiMessage)) { ?>
            <div class="notification <?php echo ($is_error ? 'is-danger' : 'is-success') ?>">
                <a class="delete" onclick="event.target.parentElement.style.display = 'none'"></a>
                <p><?php echo $notiMessage ?></p>
            </div>
        <?php } ?>
        <form method="POST" action="create.php">
            <div class="box">
                <div class="box-body">
                    <div class="field">
                        <label class="label">Name</label>
                        <div class="control"><input class="input" name="name" value="<?php echo $_POST['name']; ?>">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Email</label>
                        <div class="control"><input class="input" name="email" value="<?php echo $_POST['email']; ?>">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Message</label>
                        <div class="control">
                            <textarea class="textarea" name="message"><?php echo $_POST['message']; ?></textarea>
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
 