<?php include_once 'common/mycms.php' ?>
<?php $mycms->header(); ?>

<h1 class="title">Welcome To <?= $mycms->settings['appName'] ?></h1>
<p><?= $mycms->settings['appDescription'] ?></p>

<?php $mycms->footer(); ?>