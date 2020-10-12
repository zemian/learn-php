<?php

/*

You need to setup DB table for this page to work.

CREATE TABLE users (
  id SERIAL PRIMARY KEY,
  username VARCHAR(200) UNIQUE,
  password VARCHAR(1000)
);

-- Sample of test data, password=test123
INSERT INTO users VALUES (NULL, 'test', '$2y$10$8CSdr7TRICObtLYtHVfxTuYJUO4UzdenJUkoDtGsgqutOhIYFReVq');
INSERT INTO users VALUES (NULL, 'test2', '$2y$10$I/ulrhMdgqbDHNT.9NNol.tbMickL2vwmUHkSrEI6o2IwiTp5.fkq');
INSERT INTO users VALUES (NULL, 'test3', '$2y$10$8HgKTIzzWbbVsnj7565uwuWa0rn4NFUTsgAGHxgLPxTLmjlfqV7z2');
*/


$username = '';
$password = '';
if (isset($_POST['action'])) {
  include_once "../db-config.php";

  $username = $_POST['username'];
  $password = $_POST['password'];

  $password_h = password_hash($password, PASSWORD_DEFAULT);

  $conn = create_conn();
  $sql = "SELECT id, password FROM users WHERE username = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param('s', $username);
  if ($stmt->execute()) {
    $user = $stmt->get_result()->fetch_assoc();
    $password_h = $user['password'];
    if (password_verify($password, $password_h)) {
      session_start();
      $_SESSION['user'] = array('id' => $user['id'], 'username' => $username);
      header("Location: /login-app/admin/index.php");
      exit();
    } else {
      $failureMessage = "Password does not match.";
    }
  } else {
    $failureMessage = "Unable to login: $conn->error";
  }
  $stmt->close();
  $conn->close();
}
?>

<h1>Login</h1>
<?php if (isset($failureMessage)) { ?>
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