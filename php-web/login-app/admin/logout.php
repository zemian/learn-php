<?php
session_start();
if (isset($_SESSION['user'])) {
  session_destroy();
  echo "User has logged out!";
  echo "<a href='../index.php'>Home</a>";
  exit();
}