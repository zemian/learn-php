<?php
/*
The special NULL value represents a variable with no value. NULL is the only possible value of type null.

A variable is considered to be null if:

it has been assigned the constant NULL.

it has not been set to any value yet.

it has been unset().
 */
$var = NULL;
echo is_null($var);
