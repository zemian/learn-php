<?php
require_once 'admin-app.php';
// Page vars
$rows = [];

// Fetching data
$db = $app->db;
$stmt = $db->query('SELECT id, username FROM users ORDER BY created_ts LIMIT 10');
while ($row = $stmt->fetch()) {
    array_push($rows, $row);
}
?>

<?php $app->header('admin'); ?>

<div class="container">
    <table class="table is-fullwidth">
        <tr>
            <td>Id</td>
            <td>Username</td>
        </tr>
        <?php foreach ($rows as $row) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['username']; ?></td>
            </tr>
        <?php } ?>
    </table>
</div>

<?php $app->footer(); ?>

