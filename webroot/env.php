<?php
/*
 * Provide default environment variables if env-local.php is not given.
 */
if (file_exists('env-local.php'))
	require_once 'env-local.php';

/* Application Absolute Path */
if (!defined('APP_PATH'))
	define('APP_PATH', __DIR__);

/* Database Connection Settings */
if (!defined('DB_DSN'))
	define('DB_DSN', 'mysql:host=localhost;dbname=learnphp');
if (!defined('DB_USER'))
	define('DB_USER', 'root');
if (!defined('DB_PASSWORD'))
	define('DB_PASSWORD', '');
