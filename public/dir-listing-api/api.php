<?php
/*
 * A API pervice to provide dir list and file content management
 */
$config = array(
	'root_dir' => __DIR__,
);
$resource = $_SERVER['PATH_INFO'] ?? '';
$output = array(
	'timestamp' => date('c'),
	'resource' => $resource,
);
switch($resource) {
	case '/files':
		$output = array_merge($output, rest_files());
		break;
	default:
		$output = array_merge($output, rest_get_describe());
}

function exit_with_error($code, $msg, $output = null) {
	header("HTTP/1.0 $code $msg", true, $code);
	if ($output)
		echo json_encode($output);
	exit;
}

function rest_get_describe() {
	return array(
		'description' => 'A directories listing and file content service.',
		'endpoints' => array(
			'/' => 
				['GET' => 'Get self describe API usage.'],
			'/files' => 
				['GET' => 'Get list of files from root dir.'],
			'/files?dir=/SUBDIR/SUB_SUBDIR' => 
				['GET' => 'Get list of files from a sub SUBDIR.'],
			'/files?dir=/SUBDIR/SUB_SUBDIR&name=FILENAME' => 
				['GET' => 'Get a file content by name. The dir parameter is optional.'],
		)
	);
}

function rest_files() {
	// Process GET requests
	if (isset($_GET['name'])) {
		$dirname = $_GET['dir'] ?? '/';
		$filename = $_GET['name'] ?? '';
		return rest_get_files($dirname, $filename);
	} else {
		$dirname = $_GET['dir'] ?? '/';
		return rest_get_files_list($dirname);
	}
}

function validate_file($file, $basedir) {
	$realpath = realpath($file);
	if (substr($realpath, 0, strlen($basedir)) !== $basedir) {
		return exit_with_error(403, 'Forbidden');
	}

	if (!file_exists($file)) {
		return exit_with_error(404, 'Not Found');
	}
}

function pad_slash_dir($dirname) {
	if (substr($dirname, strlen($dirname) - 1) === '/')
		$dirname = substr($dirname, 0, strlen($dirname) - 1);
	if (substr($dirname, 0, 1) !== '/')
		$dirname = '/' . $dirname;
	return $dirname;
}

function rest_get_files_list($dirname) {
	global $config;
	$basedir = $config['root_dir'];
	$dirname = pad_slash_dir($dirname);
	$file = $basedir . $dirname;
	validate_file($file, $basedir);

	$items = scandir($file);
	$items = array_slice($items, 2);
	$sub_dirs = [];
	$files = [];
	foreach ($items as $item) {
		if (substr($item, 0, 1) === '.')
			continue;
		if (is_dir($file . '/' . $item))
			$sub_dirs[] = $item;
		else
			$files[] = $item;
	}
	return array(
		'dir' => $dirname,
		'sub_dirs' => $sub_dirs,
		'files' => $files,
	);
}

function rest_get_files($dirname, $filename) {
	global $config;
	$basedir = $config['root_dir'];
	$dirname = pad_slash_dir($dirname);
	$file = $basedir . $dirname . '/' . $filename;
	validate_file($file, $basedir);

	return array(
		'dir' => $dirname,
		'filename' => $filename,
		'pathinfo' => pathinfo($dirname . $filename),
		'content' => file_get_contents($file)
	);
}


header('content-type: application/json');
echo json_encode($output);
