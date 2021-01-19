<?php
require_once 'admin-app.php';
$record_id = $_GET['id'] ?? 0;
$form_error = null;

$db = $app->db;
if (isset($_POST['action'])) {
    $record_id = $_POST['id'];
    $username = $_POST['username'];

    if ($form_error === null && !$app->validate_regex($username, '/\w+/')) {
        $form_error = 'Invalid username input';
    }

    if ($form_error === null) {
        // Update user
        try {
            $sql = "UPDATE users SET username = ? WHERE id = ?";
            $stmt = $db->prepare($sql);
            if ($stmt->execute([$username, $record_id])) {
                $app->redirect('/login-app/admin/user-list.php');
            } else {
                $form_error = "Unable to update user ID $record_id: $db->errorInfo()[0]";
            }
        } catch (PDOException $e) {
            $form_error = "Unable to update user ID $record_id: " . $e->getMessage();
        }
    }
} else {
    // Get user for edit
    try {
        $sql = "SELECT username FROM users WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$record_id]);
        $user = $stmt->fetch();
        $username = $user['username'];
    } catch (PDOException $e) {
        $form_error = "Unable to get user ID $record_id: " . $e->getMessage();
    }
}
?>

<?php echo $app->header(); ?>

<div class="container">
    <div class="level">
        <div class="level-item has-text-centered">
            <div>
                <p class="title">Edit User</p><h1>
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
                <div class="label">Name</div>
                <div class="control"><input class="input" type="text" name="username" value="<?= $username ?>"></div>
            </div>
            <div class="field">
                <div class="control"><input class="button" type="submit" name="action" value="Submit"></div>
            </div>
        </form>
    </div>
</div>

<?php echo $app->footer(); ?>