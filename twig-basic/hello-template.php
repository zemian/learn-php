<?php
require_once 'vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader, [
    'cache' => 'templates-cache',
]);

echo $twig->render('index.twig', ['name' => 'Fabien']), "\n";
