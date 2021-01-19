<?php
// PHP Superglobal Vars

// https://www.php.net/manual/en/reserved.variables.php
// Also see "phpinfo.php" for list of all values!

// This is needed to access $_SESSION var.
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>PHP Superglobal Vars</title>
</head>
<body>    
    <h1>$_SERVER</h1>
    <pre><?php print_r($_SERVER); ?></pre>

    <h1>$_ENV</h1>
    <pre><?php print_r($_ENV); ?></pre>


    <h1>$_SESSION</h1>
    <pre><?php print_r($_SESSION); ?></pre>

    <h1>$_COOKIE</h1>
    <pre><?php print_r($_COOKIE); ?></pre>

    <h1>$_POST</h1>
    <pre><?php print_r($_POST); ?></pre>

    <h1>$_GET</h1>
    <pre><?php print_r($_GET); ?></pre>

    <h1>$_REQUEST</h1>
    <pre><?php print_r($_REQUEST); ?></pre>

</body>
</html>
