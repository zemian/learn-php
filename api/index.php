<?php
$output = array(
    'timestamp' => date('c'),
    'resource' => $_SERVER['PATH_INFO'],
    'cwd' => getcwd(),
    'cwd_pathinfo' => pathinfo(getcwd()),
    'server' => $_SERVER,
    'request' => $_REQUEST,
    'cookie' => $_COOKIE,
    'env' => getenv(),
    'locales' => json_encode(ResourceBundle::getLocales('')),
);
header('content-type: application/json');
echo json_encode($output);