<?php
require_once 'app.php';
$db = $app->db;
$username = '';
$password = '';
$form_error = null;
$new_user_id = null;
if (isset($_POST['action'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($form_error === null && !$app->validate_regex($username, '/\w+/')) {
        $form_error = 'Invalid username input';
    }
    if ($form_error === null && !$app->validate_regex($password, '/\w+/')) {
        $form_error = 'Invalid password input';
    }

    if ($form_error === null) {
        try {
            // Check to see if user already exists
            $sql = "SELECT id FROM users WHERE username = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$username]);
            if ($stmt->fetch()) {
                $form_error = "User already exists!";
            } else {
                // Ready to insert new user
                $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
                $stmt = $db->prepare($sql);
                $password_h = password_hash($password, PASSWORD_DEFAULT);
                if ($stmt->execute([$username, $password_h])) {
//                $new_user_id = $db->lastInsertId();
                    $app->redirect('/login-app/register-success.php');
                } else {
                    $form_error = "Unable to create user: $db->errorInfo()[0]";
                }
            }
        } catch (PDOException $e) {
            $form_error = "Unable to create user: $e";
        }
    }
}
?>

<?php echo $app->header(); ?>

<div class="container">
    <div class="level">
        <div class="level-item has-text-centered">
            <div>
                <p class="title">Create New User</p><h1>
            </div>
        </div>
    </div>
    <div class="columns">
        <div class="column"></div>
        <div class="column">
            <div class="form">
                <?php if ($form_error !== null) { ?>
                    <div>
                        <div class="notification is-danger"><?php echo $form_error; ?></div>
                    </div>
                <?php } ?>
                <form method="POST">
                    <div class="field">
                        <div class="label">Name</div>
                        <div class="control"><input class="input" type="text" name="username" value="<?= $username ?>"></div>
                    </div>
                    <div class="field">
                        <div class="label">Password</div>
                        <div class="control"><input class="input" type="password" name="password" value="<?= $password ?>"></div>
                    </div>
                    <div class="field">
                        <div class="control"><input class="button" type="submit" name="action" value="Submit"></div>
                    </div>
                </form>
            </div>
        </div>
        <div class="column"></div>
    </div>
</div>

<?php echo $app->footer(); ?>