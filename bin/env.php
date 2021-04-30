<?php
/*
 * Provide default environment variables if env-local.php is not given.
 */
if (file_exists('env-local.php'))
	require_once 'env-local.php';

if (!defined('DATA_DIR'))
	define('DATA_DIR', __DIR__);
