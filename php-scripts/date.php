<?php
// Date function
date_default_timezone_set("UTC");
echo date("l") . "\n";
echo date(DATE_RFC2822) . "\n";
echo date("Y-m-d H:i:s") . "\n";
echo date("Ymd") . "\n";

// Time function
echo time() . "\n"; // return Epoch time

$nextWeek = time() + (7 * 24 * 60 * 60);
// 7 days; 24 hours; 60 mins; 60 secs
echo 'Now:       '. date('Y-m-d') ."\n";
echo 'Next Week: '. date('Y-m-d', $nextWeek) ."\n";
// or using strtotime():
echo 'Next Week: '. date('Y-m-d', strtotime('+1 week')) ."\n"

// NOTE: Timestamp of the start of the request is available in $_SERVER['REQUEST_TIME'] since PHP 5.1.

