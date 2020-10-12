<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: ../login.php");
  exit();
}
?>
<h1>You are logged in! Welcome <?= $_SESSION['user']['username'] ?>!</h1>
<a href='logout.php'>Logout</a>
