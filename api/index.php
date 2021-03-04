<?php
header('Content-Type: application/json');
switch($_GET['action'] ?? '') {
    case 'server':
        echo json_encode($_SERVER);
        break;
    case 'request':
        echo json_encode($_REQUEST);
        break;
    case 'cookie':
        echo json_encode($_COOKIE);
        break;
    case 'env':
        // Note that $_ENV might be empty and requires php config enabled. Use "getenv()" instead.
        echo json_encode(getenv());
        break;
    case 'locales':
        echo json_encode(ResourceBundle::getLocales(''));
        break;
    default:
        echo json_encode(array(
            'queryParametersUsage' => '?action=server|request|cookie|env|locales',
            'timestamp' => date('c')
        ));
}
