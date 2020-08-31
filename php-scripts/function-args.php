<?php

// PHP 5.6 has wildcard args
function foo(...$args) {
    echo "\$args\n";
    var_dump($args);
}
foo(1, 2, 3);

// Older style has the func_get_args(), or func_get_arg(index)
function foo2() {
    $args = func_get_args();
    echo "\$args\n";
    var_dump($args);
}
foo2("a", "b", "c");

// Default argument
function foo3($req, $opt = false) {
    echo '$req, $opt\n';
    var_dump($req, $opt);
}
foo3("test");
foo3("test", true);

?>

