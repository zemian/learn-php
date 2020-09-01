<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>PHP Hello</title>
</head>
<body>
	<h1>$_SERVER</h1>
	<pre><code>
	<?php 
		// https://www.php.net/manual/en/reserved.variables.php
	    // Also see "phpinfo.php" for list of all values!
		echo "$_SERVER";
		#echo $_SERVER['HTTP_USER_AGENT'];
		var_dump($_SERVER);

	?>
	</code></pre>

	<h1>$_GET</h1>
	<pre><code><?php var_dump($_GET); ?></code></pre>

	<h1>$_POST</h1>
	<pre><code><?php var_dump($_POST); ?></code></pre>
	
	<h1>$_COOKIE</h1>
	<pre><code><?php var_dump($_COOKIE); ?></code></pre>
	
	<h1>$_FILES</h1>
	<pre><code><?php var_dump($_FILES); ?></code></pre>
	
	<h1>$_ENV</h1>
	<pre><code><?php var_dump($_ENV); ?></code></pre>
	
	<h1>$_REQUEST</h1>
	<pre><code><?php var_dump($_REQUEST); ?></code></pre>
	
	<h1>$_SESSION</h1>
	<pre><code><?php var_dump($_SESSION); ?></code></pre>
</body>
</html>
