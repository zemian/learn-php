<?php
// Redirect to phpinfo.php page

header("Location: phpinfo.php"); /* Redirect browser */

/* Make sure that code below does not get executed when we redirect. */
exit;
