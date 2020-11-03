<?php
require_once 'app.php';
$db = $app->db;
$username = '';
$password = '';
$form_error = null;
if (isset($_POST['action'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    try {
        if ($app->login($username, $password)) {
            $app->redirect('/login-app/admin/index.php');
        }
    } catch (PDOException $e) {
        $form_error = "Failed: " . $e.getMessage();
    }
}
?>

<?php echo $app->header(); ?>

<section class="section">
    <div class="level">
        <div class="level-item has-text-centered">
            <div>
                <p class="title">User Sign In</p>
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
</section>

<?php echo $app->footer(); ?>