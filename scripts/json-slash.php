<?php
$data = array(
    "value" => "/test/slashy"
);

// NOTE: Without JSON_UNESCAPED_SLASHES, json output will auto escape '/' values, which
// is needed when you use it inside a <script> tag.
$json = json_encode($data, JSON_UNESCAPED_SLASHES);
echo $json, "\n";
