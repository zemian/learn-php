<?php
/*
 * A script to insert all the locales object found in built-in PHP into the
 * crud.db DB.
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$pdo = new PDO('sqlite:crud.db');

$is_reset = isset($_GET['reset']);
if ($is_reset) {
    $pdo->exec("DROP TABLE locales");
}

$stmt = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='locales'");
$data = $stmt->fetch(PDO::FETCH_ASSOC);
if ($data === false) {
    $result = $pdo->exec(<<<HERE
        CREATE TABLE locales (
            code TEXT primary key,
            name TEXT,
            language TEXT,
            region TEXT
        );
        HERE
    );

    $stmt = $pdo->prepare('INSERT INTO locales(code, name, language, region) VALUES(?, ?, ?, ?)');
    $locale_codes = ResourceBundle::getLocales('');
    foreach ($locale_codes as $code) {
        $locales = array(
            "code" => $code,
            "name" => Locale::getDisplayName($code),
            "language" => Locale::getDisplayLanguage($code),
            "region" => Locale::getDisplayRegion($code)
        );
        $result = $stmt->execute(array_values($locales));
    }

    $data = ['message' => "Table 'locales' created!", 
        'timestamp' => date('c'), 
        'reset' => $is_reset
    ];
} else {
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM locales");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $data = ['message' => "Table 'locales' already exists!", 
        'timestamp' => date('c'), 
        'count' => $result['count']
    ];
}

echo json_encode($data);