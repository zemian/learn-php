<?php
// Default php timezone can be UTC or sometimes match to your local timezone
// See php.ini
echo 'date_default_timezone_get(): ', date_default_timezone_get(), "\n";
echo date('c'), "\n";
echo date('Y-m-d H:i:s'), "\n";

/*
// See https://www.php.net/manual/en/timezones.america.php
Eastern ........... America/New_York
Central ........... America/Chicago
Mountain .......... America/Denver
Mountain no DST ... America/Phoenix
Pacific ........... America/Los_Angeles
Alaska ............ America/Anchorage
Hawaii ............ America/Adak
Hawaii no DST ..... Pacific/Honolulu
 */
echo "Change default date timezone to America/New_York or Eastern\n";
date_default_timezone_set('America/New_York');
echo date('c'), "\n";
echo date('Y-m-d H:i:s'), "\n";
date_default_timezone_set('UTC'); // Reset back to UTC for any tests after this

// Creating DateTime object with specific timezone
$now = new DateTime("now");
echo 'DateTime("now")->getTimestamp() ', $now->getTimestamp(), "\n";
echo 'DateTime("now")->format() ', $now->format('Y-m-d H:i:s'), "\n";

$dt = new DateTime("now", new DateTimeZone("America/New_York"));
echo 'DateTime("now", new DateTimeZone("America/New_York")) ', $dt->getTimestamp(), "\n";
echo 'DateTime("now", new DateTimeZone("America/New_York")) ', $dt->format('Y-m-d H:i:s'), "\n";
