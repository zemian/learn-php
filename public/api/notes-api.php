<?php
$config = array(
	'notes_dir' => __DIR__ . '/notes',
);
$resource = $_SERVER['PATH_INFO'] ?? '';
$output = array(
	'timestamp' => date('c'),
	'resource' => $resource,
);
switch($resource) {
	case '/describe':
		$output = array_merge($output, rest_get_describe($output));
		break;
	case '/notes':
		$output = array_merge($output, rest_notes());
		break;
	default:
		$output = array_merge($output, rest_get_today_notes());
}

function rest_get_describe(&$output) {
	return array(
		'endpoints' => array(
			'/' => ['GET' => 'Get today notes'],
			'/notes' => ['GET' => 'Get list of note names'],
			'/notes?name=NAME' => ['GET' => 'Get notes by name'],
		)
	);
}

function rest_notes() {
	$notes_name = $_GET['name'] ?? '';
	if ($notes_name)
		return rest_get_notes($notes_name);
	else
		return rest_get_notes_list();
}

function rest_get_notes_list() {
	global $config;
	$items = scandir($config['notes_dir']);
	return array('items' => array_slice($items, 2));
}

function rest_get_notes($notes_name) {
	return get_notes_content($notes_name);
}

function rest_get_today_notes() {
	$result = get_notes_content(date('Y-m', time()) . '.md');
	$result ['today_notes'] = true;
	return $result;
}

function get_notes_content($notes_name) {
	global $config;
	$file = $config['notes_dir'] . '/' . $notes_name;
	$file_pathinfo = pathinfo($file);
	unset($file_pathinfo['dirname']); // remove for security reason
	return array(
		'file_pathinfo' => $file_pathinfo,
		'content' => file_get_contents($file)
	);
}

header('content-type: application/json');
echo json_encode($output);
