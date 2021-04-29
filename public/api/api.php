<?php

/*
 * An API to handle notes application.
 * Supported endpoints:
 *   GET /dir - List of directory of files and sub folders
 *   GET /content - Retrieve content of a file
 */


class App {
	function __construct() {
		$this->response = new stdClass();
		$this->routes = array();
		$this->dataDir = __DIR__ . '/../..'; // Set at km-notes
	}

	function run() {
		$this->addRoutes();
		$this->handleRouteRequest();
		$this->renderOutput();
	}

	// Functions
	function addRoutes() {
		// Note that order of the routes is important. Add default to last!
		$this->routes[]= ['pattern' => '/dir', 'handler' => 'getDir'];
		$this->routes[]= ['pattern' => '/content', 'handler' => 'getContent'];
		$this->routes[]= ['pattern' => '/', 'handler' => 'getDefault'];
	}

	function handleRouteRequest() {
		$path_info = $_SERVER['PATH_INFO'] ?? '/';
		$matched_route = null;
		foreach ($this->routes as $route) {
			if (preg_match('~' . $route['pattern'] . '~', $path_info, $matches)) {
				$route['matches'] = $matches;
				$matched_route = $route;
				break;
			}
		}
		if (!$matched_route) {
			throw new Exception('No route found for path_info: ' . $path_info, );
		}

		call_user_func(array($this, $matched_route['handler']));
	}

	function renderOutput() {
		$body = $this->response->body;
		header('content-type: application/json');
		echo json_encode($body);
	}

	// Route Handlers
	function getDefault() {
		$this->response->body = $_SERVER;
	}
	function getDir() {
		$path = $_GET['path'] ?? '/';
		$this->response->body = $this->getDirListing($path);
	}
	function getContent() {
		$path = $_GET['path'] ?? '/';
		$this->response->body = $this->getFileContent($path);
	}

	// Handler Support Methods
	function getDirListing(string $dir_path): array {
		$full_path = $this->dataDir . '/' . $dir_path;
		if (!file_exists($full_path)) {
			return array(
				'dir_path' => $dir_path,
				'error' => 'Dir not found.'
			);
		}

		$items = scandir($full_path);
		$items = array_slice($items, 2);
		$dirs = [];
		$files = [];
		foreach ($items as $item) {
			if (substr($item, 0, 1) === '.')
				continue;
			if (is_dir($full_path . '/' . $item))
				$dirs[] = $item;
			else
				$files[] = $item;
		}
		return array(
			'dir_path' => $dir_path,
			'dirs' => $dirs,
			'files' => $files,
		);
	}
	function getFileContent($file_path) {
		$full_path = $this->dataDir . '/' . $file_path;
		if (!is_file($full_path)) {
			return array(
				'file_path' => $file_path,
				'error' => 'File not found.'
			);
		}
		$pathinfo = pathinfo($full_path);
		unset($pathinfo['dirname']); // Remove for security reason
		return array(
			'file_path' => $file_path,
			'pathinfo' => $pathinfo,
			'content' => file_get_contents($full_path)
		);
	}

}
(new App())->run();