<?php
//$list = DateTimeZone::listAbbreviations();
//foreach ($list as $k => $v) {
////    echo "$k\n";
//    print_r($v);
//    echo "\n";
//}

$utc_now = new DateTime("now", new DateTimeZone("UTC"));
$tz_names = DateTimeZone::listIdentifiers();
//foreach ($tz_names as $tz_name) {
////    echo "$tz_name\n";
//    $tz = new DateTimeZone($tz_name);
//    // Offset value is in seconds
//    echo $tz->getName() . ' ' . $tz->getOffset($utcNow) . "\n"; // sort by name as default
//}

$tz_list = array_map(fn($tz_name) => new DateTimeZone($tz_name), $tz_names);
// NOTE: arrow function can capture variable outside of function automatically, but
//       it can not be in multilines! It only supports one line expression.
usort($tz_list, function($a, $b) use($utc_now) {
    $aoffset = $a->getOffset($utc_now);
    $boffset = $b->getOffset($utc_now);
    if ($aoffset === $boffset)
        return 0;
    return $aoffset < $boffset ? -1 : 1;
});

foreach ($tz_list as $tz) {
    // Sample: America/New_York -14400
    echo $tz->getName() . ' ' . $tz->getOffset($utc_now) . "\n";
}