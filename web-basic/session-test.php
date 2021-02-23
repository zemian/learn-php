<?php
session_start();
if (!isset($_SESSION)) {
  echo "session not set";
} else {
  echo 'session is set';
  $_SESSION['foo'] = date(DATE_ISO8601);
  var_dump($_SESSION);
}
// session_destroy();
