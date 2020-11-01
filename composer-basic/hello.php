<?php

require __DIR__ . '/vendor/autoload.php';

// Logger demo
$log = new Monolog\Logger('name');
$log->pushHandler(new Monolog\Handler\StreamHandler('temp/app.log', Monolog\Logger::WARNING));
$log->pushHandler(new Monolog\Handler\StreamHandler('php://stdout', Monolog\Logger::WARNING));
$log->addWarning('Foo');

// Markdown parser demo
$Parsedown = new Parsedown();
echo $Parsedown->text('Hello _Parsedown_!'); # prints: <p>Hello <em>Parsedown</em>!</p>
echo "\n";
