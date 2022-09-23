<?php
require_once 'admin-app.php';
$record_id = $_GET['id'] ?? 0;
$form_error = null;
$password = '';

$db = $app->db;
if (isset($_POST['action'])) {
    $record_id = $_POST['id'];
    $password = $_POST['password'];

    if ($form_error === null && !$app->validate_regex($password, '/\w+/')) {
        $form_error = 'Invalid password input';
    }

    if ($form_error === null) {
        // Change user password
        try {
            $sql = "UPDATE users SET password = ? WHERE id = ?";
            $stmt = $db->prepare($sql);
            $password_h = password_hash($password, PASSWORD_DEFAULT);
            if ($stmt->execute([$password_h, $record_id])) {
                $app->redirect('/login-app/admin/user-list.php');
            } else {
                $form_error = "Unable to update user ID $record_id: $db->errorInfo()[0]";
            }
        } catch (PDOException $e) {
            $form_error = "Unable to update user ID $record_id: " . $e->getMessage();
        }
    }
}
?>

<?php echo $app->header(); ?>

<div class="container">
    <div class="level">
        <div class="level-item has-text-centered">
            <div>
                <p class="title">Change Password</p><h1>
            </div>
        </div>
    </div>
    <div class="form">
        <?php if ($form_error !== null) { ?>
            <div>
                <div class="notification is-danger"><?php echo $form_error; ?></div>
            </div>
        <?php } ?>
        <form method="POST">
            <input type="hidden" name="id" value="<?= $record_id ?>">
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

<?php echo $app->footer(); ?>