<?php
// Example of contact form processing.

// Process form
$form_error = '';
$form_message = '';
$name = $_POST['name'] ?? '';
$message = $_POST['message'] ?? '';
if (isset($_POST['action'])) {
    // Validate data
    $n = strlen($name);
    if (!$form_error && !($n > 0 && $n <= 50) && !preg_match('/^\w+$/', $name)) {
        $form_error = 'Invalid name. Must be non-empty, under 50 chars and word only.';
    }
    
    $n = strlen($message);
    if (!$form_error && !($n > 0 && $n <= 1000)) {
        $form_error = 'Invalid message. Must be non-empty and under 1000 chars.';
    }
    
    if (!$form_error) {
        $form_message = "Thank you <b>$name</b> for leaving us a <b>$n</b> chars message. We will get back to you soon!";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://unpkg.com/bulma">
    <title>Form Submit</title>
</head>
<body>

<div class="section">
    <?php if ($form_error) { ?>
        <div class="notification is-danger"><?php echo $form_error; ?></div>
    <?php } ?>
    <?php if ($form_message) { ?>
        <div class="notification is-success"><?php echo $form_message; ?></div>
    <?php } ?>
    <form method="POST">
        <div class="field">
            <div class="label">Name</div>
            <div class="control"><input class="input" type="text" name="name" value="<?php echo $name; ?>"></div>
        </div>
        <div class="field">
            <div class="label">Comment</div>
            <div class="control"><textarea class="textarea" name="message"><?php echo $message; ?></textarea></div>
        </div>
        <div class="field">
            <div class="control"><input class="button" type="submit" name="action" value="Submit"></div>
        </div>
    </form>
</div>

</body>
</html>
