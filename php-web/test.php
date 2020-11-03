<?php
$username = '';
$ret = filter_var($username, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => '/\w+/']]);
var_dump($ret);
?>