<?php
require_once '../app.php';

if (!$app->isUserLoggedIn()) {
    $app->redirect('/login-app/login.php');
}
?>

<?php $app->header('admin'); ?>

<section class="section">
    <h1>You are in admin space!</h1>
</section>

<?php $app->footer(); ?>

