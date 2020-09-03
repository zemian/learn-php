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
        if (empty($db_config)) {
            die('No DB config object defined.');
        }
        $conn = new mysqli($db_config['servername'], $db_config['username'], $db_config['password'], $db_config['dbname']);
        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }

        // Create DB record with form
        //echo 'Connected successfully';
        //var_dump ($_POST);

        // Insert single record
        $sql = 'INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('sss', $_POST['name'], $_POST['email'], $_POST['message']);
        $dbresult = $stmt->execute();
        if ($dbresult) {
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
    <title>Form CRUD Example</title>
    <link rel="stylesheet" type="text/css" href="/learn-php/www/bulma.css">
</head>
<body>
<div id="app">
    <?php if(!empty($notiMessage)) { ?>
    <div class="notification <?php echo ($is_error ? 'is-danger' : 'is-success') ?>">
        <a class="delete" onclick="event.target.parentElement.style.display = 'none'"></a>
        <p><?php echo $notiMessage ?></p>
    </div>
    <?php } ?>
    <div class="section">
        <form method="POST" action="create.php">
            <div class="box">
                <div class="box-header">
                    <h1 class="title has-text-centered">Create New Contact</h1>
                </div>
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
                            <textarea class="textarea" name="message"
                                      value="<?php echo $_POST['message']; ?>"></textarea>
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
 