<?php
require_once 'app.php';
$db = $app->db;
$user_count = $db->query("SELECT count(*) FROM users")->fetch()[0];
$user_count_label = $user_count . ($user_count > 1 ? ' users' : ' user');
?>

<?php echo $app->header(); ?>
<section class="hero is-fullheight-with-navbar">
    <div class="hero-body">
        <div class="container">
            <h1 class="title">
                Welcome!
            </h1>
            <h2 class="subtitle">
                There are <?php echo $user_count_label; ?> and counting ...
            </h2>
        </div>
    </div>
</section>
<?php echo $app->footer(); ?>
