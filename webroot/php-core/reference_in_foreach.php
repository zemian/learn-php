<?php

/*
This is a PHP gotcha that you need to be careful!

A reference variable inside a foreach does not have local scope!
so modifying it outside of foreach can have huge effect and hidden bug!
*/

$env_config = [
    'envs' => [
        ['name' => 'dev', 'test' => 'foo'],
        ['name' => 'qa', 'test' => 'bar'],
    ]
];

$env = $env_config['envs'][0]; // expects 'dev' here.

foreach ($env_config['envs'] as &$env) {
    $env['test'] = $env['test'] . '_' . $env['name'];
}

// It's important to unset $env after foreach use!!!!
//
// Now you would think you still have old $env data, but you
// will be suprise to see it prints 'qa' instead here!
// To solve this, you must unset the $env and recreate it:
//unset($env);
//$env = $env_config['envs'][0]; // expects 'dev' here.
// See https://www.php.net/manual/en/control-structures.foreach.php

$name = $env['name'];
var_dump($name);
