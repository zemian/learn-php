<?php
require_once 'admin-app.php';
// Page vars
$rows = [];

// Fetching data
$db = $app->db;
$stmt = $db->query('SELECT id, username, created_ts FROM users ORDER BY created_ts DESC LIMIT 10');
while ($row = $stmt->fetch()) {
    array_push($rows, $row);
}
?>

<?php $app->header('admin'); ?>

<div class="container">
    <table class="table is-fullwidth">
        <tr>
            <td>Username</td>
            <td>Created Date</td>
            <td>Actions</td>
        </tr>
        <?php foreach ($rows as $row) { ?>
            <tr>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['created_ts']; ?></td>
                <td>
                    <a href="user-edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a href="user-delete.php?id=<?php echo $row['id']; ?>">Delete</a>
                    <a href="user-password.php?id=<?php echo $row['id']; ?>">Password</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

<?php $app->footer(); ?>

