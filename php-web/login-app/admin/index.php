<?php
require_once '../app.php';

if (!$app->isUserLoggedIn()) {
    $app->redirect('/login-app/login.php');
}

$php_version = phpversion();
$mysql_version = $app->db->query("SELECT VERSION()")->fetch()[0];
$server = $_SERVER['SERVER_SOFTWARE'];
$os = PHP_OS;
?>

<?php $app->header('admin'); ?>

<div class="hero">
    <div class="hero-body">
        <div class="container">
            <div class="level">
                <div class="level-item has-text-centered">
                    <div>
                        <p class="heading">PHP</p>
                        <p class="title"><?php echo $php_version; ?></p>
                    </div>
                </div>
            </div>
            <div class="level">
                <div class="level-item has-text-centered">
                    <div>
                        <p class="heading">MySQL</p>
                        <p class="title"><?php echo $mysql_version; ?></p>
                    </div>
                </div>
            </div>
            <div class="level">
                <div class="level-item has-text-centered">
                    <div>
                        <p class="heading">Server</p>
                        <p class="title"><?php echo $server; ?></p>
                    </div>
                </div>
            </div>
            <div class="level">
                <div class="level-item has-text-centered">
                    <div>
                        <p class="heading">OS</p>
                        <p class="title"><?php echo $os; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $app->footer(); ?>

