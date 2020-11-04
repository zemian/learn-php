<?php
require_once 'admin-app.php';
// Page vars
$form_error = null;
$record_id = $_GET['id'] ?? 0;
$is_confirmed = $_GET['confirmed'] ?? false;
$deleted = false;

// Processing
if ($record_id <= 0) {
    $form_error = "Missing id parameter.";
} else if ($is_confirmed){
    // Delete user
    try {
        $stmt = $app->db->prepare('DELETE FROM users WHERE id = ?');
        if ($stmt->execute([$record_id])) {
            $deleted = true;
        } else {
            $form_error = "Unable to delete record ID $record_id";
        }
    } catch (PDOException $e) {
        $form_error = "Unable to delete record ID $record_id: " . $e->getMessage();
    }
}
?>

<?php $app->header(); ?>

<?php if ($form_error !== null) { ?>
<div>
    <div class="notification is-danger">
        <?php echo $form_error; ?>
    </div>
</div>
<?php } else if (!$is_confirmed) { ?>
<div>
    <div class="notification is-danger">
        <p>Are you sure you want to delete record ID=<?php echo $record_id; ?>?</p>
        <a class="button is-info" href="user-delete.php?confirmed=true&id=<?php echo $record_id; ?>">Delete</a>
        <a class="button" href="user-list.php">Cancel</a>
    </div>
</div>
<?php } else if ($deleted) { ?>
    <div class="notification is-info">
        <p>Record ID=<?php echo $record_id; ?> has been deleted!</p>
        <a class="button" href="user-list.php">View List</a>
    </div>
<?php } ?>

<?php $app->footer(); ?>
