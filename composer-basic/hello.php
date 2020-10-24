<?php

require __DIR__ . '/vendor/autoload.php';

$log = new Monolog\Logger('name');
$log->pushHandler(new Monolog\Handler\StreamHandler('temp/app.log', Monolog\Logger::WARNING));
$log->pushHandler(new Monolog\Handler\StreamHandler('php://stdout', Monolog\Logger::WARNING));
$log->addWarning('Foo');
