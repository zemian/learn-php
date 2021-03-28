<?php
// https://github.com/bramus/router
// composer require bramus/router

// Require composer autoloader
require __DIR__ . '/vendor/autoload.php';

// Create Router instance
$router = new \Bramus\Router\Router();

$router->get('/', function() {
    echo 'Hello';
});

// Run it!
$router->run();
