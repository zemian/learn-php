<?php

// Get data structure
$timezones = DateTimeZone::listAbbreviations();

// Return JSON data
header('Content-Type: application/json');
echo json_encode($timezones, JSON_PRETTY_PRINT);