<?php
require_once 'app.php';
$db = $app->db;
$user_count = $db->query("SELECT count(*) FROM users")->fetch()[0];
$user_count_label = $user_count . ($user_count > 1 ? ' users' : ' user');
?>

<?php echo $app->header(); ?>
<section class="hero is-primary is-bold is-fullheight">
    <div class="hero-body">
        <div class="container">
            <h1 class="title">
                <?php echo $app->name; ?>
            </h1>
            <h2 class="subtitle">
                There are <?php echo $user_count_label; ?> and counting ...
            </h2>
            
            <a class="button is-info" href="/login-app/login.php">Login</a>
            <a class="button" href="/login-app/register.php">Register</a>
        </div>
    </div>
</section>
<?php echo $app->footer(); ?>
