<?php
// https://www.php.net/manual/en/language.operators.comparison.php
// https://www.php.net/manual/en/types.comparisons.php
// https://www.php.net/manual/en/language.types.type-juggling.php

// The '==' will perform auto conversion

$s = "1, 2";
if (1 == $s) {
    echo '1 == $s IS TRUE', "\n";
} else {
    echo '1 == $s IS FALSE', "\n";
}

if ("1" == $s) {
    echo '"1" == $s IS TRUE', "\n";
} else {
    echo '"1" == $s IS FALSE', "\n";
}

if (1 === $s) {
    echo '1 === $s IS TRUE', "\n";
} else {
    echo '1 === $s IS FALSE', "\n";
}

if ("1" === $s) {
    echo '"1" === $s IS TRUE', "\n";
} else {
    echo '"1" === $s IS FALSE', "\n";
}