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
	}

	function run() {
		$this->addRoutes();
		$this->handleRouteRequest();
		$this->renderOutput();
	}

	// Functions
	function addRoutes() {
		// Note that order of the routes is important. Add default to last!
		$this->routes[]= ['pattern' => '/hello', 'handler' => 'getHello'];
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
	function getHello() {
		$this->response->body = ['message' => 'Hello'];
	}

}
(new App())->run();