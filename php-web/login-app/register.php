<?php
$username = '';
$password = '';
if (isset($_POST['action'])) {
  include_once "../db-config.php";

  $username = $_POST['username'];
  $password = $_POST['password'];

  $password_h = password_hash($password, PASSWORD_DEFAULT);

  $conn = create_conn();
  $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('ss', $username, $password_h);
  $result = $stmt->execute();
  if ($result) {
    $sucessMessage = "Username $username registered successfully. ID=$conn->insert_id";
  } else {
    $failureMessage = "Unable to registered: $conn->error";
  }
  $stmt->close();
  $conn->close();
}
?>

<h1>Register New User</h1>
<?php if (isset($sucessMessage)) { ?>
  <p><?= $sucessMessage ?></p>
<?php } else if (isset($failureMessage)) { ?>
  <p><?= $failureMessage ?></p>
<?php } ?>
<form method="POST">
  <div>
    <label>Name</label>
    <input type="text" name="username" value="<?= $username ?>">
  </div>
  <div>
    <label>Password</label>
    <input type="password" name="password" value="<?= $password ?>">
  </div>
  <div>
    <input type="submit" name="action" value="Submit">
  </div>
</form>
