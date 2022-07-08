<?php
/**
 * This script provide a simple REST API service to return a list of locale objects.
 * It also support simple pagination with offset and limit.
 *
 * NOTE: You need to enable "PHP Intl" extension in order to able to get these Locales
 * data.
 *
 * This script has been tested with PH 7.4.
 *
 * Example usage:
 *   php -S localhost:3000 -t my-ojet
 *
 *   http://localhost:3000/extra/api/locales.php
 *   http://localhost:3000/extra/api/locales.php?offset=35&limit=35
 *   http://localhost:3000/extra/api/locales.php?code=en_US
 *
 * Source: https://gist.github.com/zemian/8a04fa2d11542654e5262f46f341c1ef
 * Author: Zemian Deng <zemiandneg@gmail.com>
 */

function get_locales() {
    $locale_codes = ResourceBundle::getLocales('');
    $locales = [];
    foreach ($locale_codes as $code) {
        $locales[] = array(
            "code" => $code,
            "name" => Locale::getDisplayName($code),
            "language" => Locale::getDisplayLanguage($code),
            "region" => Locale::getDisplayRegion($code),
            "variants" => Locale::getAllVariants($code)
        );
    }

    if (isset($_GET['name'])) {
        $locales = array_filter($locales, function ($e) {
            return strstr($e['name'], $_GET['name']);
        });
    } else if (isset($_GET['code'])) {
        $locales = array_filter($locales, function ($e) {
           return strstr($e['code'], $_GET['code']);
        });
    } else if (isset($_GET['language'])) {
        $locales = array_filter($locales, function ($e) {
            return strstr($e['language'], $_GET['language']);
        });
    } else if (isset($_GET['region'])) {
        $locales = array_filter($locales, function ($e) {
         return strstr($e['region'], $_GET['region']);
        });
    } else if (isset($_GET['totalResult'])) {
        $locales = array_slice($locales, 0, $_GET['totalResult']);
    }

    $total_count = count($locales);
    $offset = intval($_GET['offset'] ?? 0);
    $limit = intval($_GET['limit'] ?? 20);
    $items = array_slice($locales, $offset, $limit);
    $has_more = $offset + count($items) < $total_count;
    $data = array(
        "hasMore" => $has_more,
        "offset" => $offset,
        "limit" => $limit,
        "items" => $items,
        "totalResult" => $total_count,
    );

    return $data;
}

$allow_methods = "OPTIONS, GET";
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Max-Age: 7200'); // Allow client to cache it for max of 2 hours
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: ' . $allow_methods);

// Main script request processing starts there
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
	header("HTTP/1.1 204 NO CONTENT");
	header('Allow: ' . $allow_methods);
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	$data = get_locales();
	echo json_encode($data);
} else {
	header("HTTP/1.1 405 Method Not Allowed");
	header('Allow: ' . $allow_methods);
}
