<?php
require_once '../app.php';

if (!$app->isUserLoggedIn()) {
    $app->redirect('/login-app/login.php');
}
?>

<?php $app->header('admin'); ?>

<h1>You are logged in! Welcome <?= $_SESSION['user']['username'] ?>!</h1>

<?php $app->footer(); ?>

