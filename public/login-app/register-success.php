<?php
require_once 'app.php';
?>

<?php $app->header(); ?>
<div class="container">
    <h1 class="title">User Created!</h1>
    <p>
        Thank you for registering with us! Your new user has been created successfully.
        You may now login <a href="/login-app/login.php">here</a>.
    </p>
</div>

<?php $app->footer(); ?>
