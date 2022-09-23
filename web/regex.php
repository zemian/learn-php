<?php
// https://www.php.net/manual/en/reference.pcre.pattern.syntax.php
// https://www.php.net/manual/en/regexp.reference.character-classes.php

// Process form
$form_error = '';
$form_message = '';
$regex = $_POST['regex'] ?? '/^(\w+) (\w+)(.)$/';
$input = $_POST['input'] ?? 'Hello World!';
$matches = [];

if (isset($_POST['action'])) {
    if (!preg_match($regex, $input, $matches)) {
//        $form_error = preg_last_error_msg(); // PHP 8 only
//        $form_error = "preg_last_error: " . preg_last_error();
        $form_error = "NOT MATCHED!";
    } else {
        $form_message = "MATCHED!\n\n";
        $form_message .= print_r($matches, true);
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
    <title>Regular Expression</title>
</head>
<body>

<div class="section">
    <?php if ($form_error) { ?>
        <div class="notification is-danger"><pre><?php echo $form_error; ?><pre></div>
    <?php } ?>
    <?php if ($form_message) { ?>
        <div class="notification is-success"><pre><?php echo $form_message; ?></pre></div>
    <?php } ?>
    <form method="POST">
        <div class="field">
            <div class="label">Regular Expression</div>
            <div class="control"><input class="input" type="text" name="regex" value="<?php echo $regex; ?>"></div>
        </div>
        <div class="field">
            <div class="label">Input String</div>
            <div class="control"><textarea class="textarea" name="input"><?php echo $input; ?></textarea></div>
        </div>
        <div class="field">
            <div class="control"><input class="button" type="submit" name="action" value="Submit"></div>
        </div>
    </form>
</div>

</body>
</html>