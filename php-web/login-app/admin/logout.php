<?php
require_once '../app.php';
if ($app->isUserLoggedIn()) {
    $app->logout();
    $app->redirect('/login-app/login.php');
}
