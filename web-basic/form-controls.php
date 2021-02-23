<?php
// Example of listing different form controls and how we typically process it.

// Data vars
$weekdays = array(
    'sun' => 'Sunday',
    'mon' => 'Monday',
    'tue' => 'Tuesday',
    'wed' => 'Wednesday',
    'thu' => 'Thursday',
    'fri' => 'Friday',
    'sat' => 'Saturday',
);

// Process form
$form_error = '';
$form_message = '';
$form_data = '';
$name = $_POST['name'] ?? 'test';
$message = $_POST['message'] ?? 'test';
$password = $_POST['password'] ?? 'test';
$yes_no = $_POST['yes_no'] ?? 'yes';
$checkbox_days = $_POST['checkbox_days'] ?? ['mon', 'wed'];
$select_day = $_POST['select_day'] ?? 'mon';
$select_days = $_POST['select_days'] ?? ['sun', 'sat'];

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

    $n = strlen($password);
    // The regex '[ -~]' is to match all range of printable characters from ' ' to '~'.
    if (!$form_error && !($n > 0 && $n <= 50) && !preg_match('/^[ -~]+$/', $password)) {
        $form_error = 'Invalid password. Must be non-empty, under 50 chars and printable chars only.';
    }

    // yes_no
    if (!$form_error && !preg_match('/^\b(yes|no)$/', $yes_no)) {
        $form_error = 'Invalid yes_no. Must be "yes" or "no" only.';
    }
    
    // checkbox_days
    $valid_words = implode('|', array_keys($weekdays));
    foreach ($checkbox_days as $item) {
        if (!$form_error && !preg_match('/^\b(' . $valid_words . ')$/', $item)) {
            $form_error = 'Invalid checkbox_days. Must be one of ' . $valid_words . ' only.';
            break;
        }
    }
    
    // select_day
    if (!$form_error && !preg_match('/^\b(' . $valid_words . ')$/', $select_day)) {
        $form_error = 'Invalid select_day. Must be one of ' . $valid_words . ' only.';
    }
    
    if (!$form_error) {
        $form_message = "Data has been processed!";
        $form_data = print_r($_POST, true);
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
    <?php if ($form_data) { ?>
        <div class="notification"><pre><?php echo $form_data; ?></pre></div>
    <?php } ?>
    <form method="POST">
        <div class="field">
            <div class="label">Name</div>
            <div class="control"><input class="input" type="text" name="name" value="<?php echo $name; ?>"></div>
        </div>
        <div class="field">
            <div class="label">Message</div>
            <div class="control"><textarea class="textarea" name="message"><?php echo $message; ?></textarea></div>
        </div>
        <div class="field">
            <div class="label">Password</div>
            <div class="control"><input class="input" type="password" name="password" value="<?php echo $password; ?>"></div>
        </div>
        <div class="field">
            <div class="label">Boolean</div>
            <div class="control">
                <input class="radio" type="radio" name="yes_no" value="yes" <?php echo ($yes_no === 'yes') ? 'checked' : ''; ?>> Yes
                <input class="radio" type="radio" name="yes_no" value="no" <?php echo ($yes_no === 'no') ? 'checked' : ''; ?>> No
            </div>
        </div>
        <div class="field">
            <div class="label">Options</div>
            <div class="control">
                <?php foreach($weekdays as $key => $val) { ?>
                    <!-- NOTE: You must use '[]' suffix on checkbox name to submit array values! -->
                    <input class="checkbox" type="checkbox" name="checkbox_days[]" value="<?php echo $key; ?>" <?php echo (in_array($key, $checkbox_days)) ? 'checked' : ''; ?>> <?php echo $val; ?>
                <?php } ?>
            </div>
        </div>
        <div class="field">
            <div class="label">Selection</div>
            <div class="control">
                <div class="select">
                    <select name="select_day">
                        <option value="">Please Select One...</option>
                        <?php foreach($weekdays as $key => $val) { ?>
                        <option value="<?php echo $key; ?>" <?php echo ($select_day === $key) ? 'selected' : ''; ?>><?php echo $val; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="field">
            <div class="label">Multi Selections</div>
            <div class="control">
                <div class="select is-multiple">
                    <select name="select_days[]" multiple size="7">
                        <?php foreach($weekdays as $key => $val) { ?>
                            <option value="<?php echo $key; ?>" <?php echo (in_array($key, $select_days)) ? 'selected' : ''; ?>><?php echo $val; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="field">
            <div class="control"><input class="button" type="submit" name="action" value="Submit"></div>
        </div>
    </form>
</div>

</body>
</html>
