<?php
// Default php timezone can be UTC or sometimes match to your local timezone
// See php.ini
echo 'date_default_timezone_get(): ', date_default_timezone_get(), "\n";
echo "date('c') ", date('c'), "\n";
echo "date('Y-m-d H:i:s') ", date('Y-m-d H:i:s'), "\n";

// Custom date format string with special characters
echo "Special string escape in date(): ", date('\M\y\ \t\i\m\e Y-m-d H:i:s'), "\n";

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
echo "date('c') ", date('c'), "\n";
echo "date('Y-m-d H:i:s') ", date('Y-m-d H:i:s'), "\n";
date_default_timezone_set('UTC'); // Reset back to UTC for any tests after this

// Creating DateTime object with specific timezone
$now = new DateTime("now");
echo 'DateTime("now")->getTimestamp() ', $now->getTimestamp(), "\n";
echo 'DateTime("now")->format() ', $now->format('c'), "\n";

$dt = new DateTime("now", new DateTimeZone("America/New_York"));
echo 'DateTime("now", new DateTimeZone("America/New_York")) ', $dt->getTimestamp(), "\n";
echo 'DateTime("now", new DateTimeZone("America/New_York")) ', $dt->format('c'), "\n";
$dt = new DateTime("now", new DateTimeZone("America/Los_Angeles"));
echo 'DateTime("now", new DateTimeZone("America/Los_Angeles")) ', $dt->format('c'), "\n";

// Dates creation base on timezone
echo "Date creation demos\n";
echo "Date creation#1 ", date('c', mktime(17, 0, 1, 1, 31, 1959)), "\n";
echo "Date creation#2 ", date('c', strtotime("1959-01-31 17:00:01")), "\n";
echo "Date creation#3 default timezone ", (new DateTime("1959-01-31 17:00:01"))->format('c'), "\n";
echo "Date creation#3 America/New_York timezone ", (new DateTime("1959-01-31 17:00:01", new DateTimeZone('America/New_York')))->format('c'), "\n";
echo "Date creation#3 America/Los_Angeles timezone ", (new DateTime("1959-01-31 17:00:01", new DateTimeZone('America/Los_Angeles')))->format('c'), "\n";

// Dates conversions
// TODO: Is this a proper way to convert Time in different timezone? Wouldn't be more accurate using the
//       DateTime.getOffset()?
$dt1 = new DateTime("1959-01-31 17:00:01", new DateTimeZone('America/Los_Angeles'));
//$dt2 = new DateTime($dt1->format('Y-m-d H:i:s'), new DateTimeZone('America/New_York')); // This does not work.
$dt2 = new DateTime("now", new DateTimeZone('America/New_York'));
$dt2->setTimestamp($dt1->getTimestamp());
echo "Date conversion dt1: ", $dt1->format('c'), "\n";
echo "Date conversion dt2: ", $dt2->format('c'), "\n";