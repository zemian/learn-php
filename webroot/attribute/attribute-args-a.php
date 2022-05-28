<?php
//https://www.php.net/manual/en/language.attributes.syntax.php

namespace MyExample;

use Attribute;

#[Attribute]
class MyAttribute
{
    const VALUE = 'value';

    private $value;

    public function __construct($value = null)
    {
        $this->value = $value;
    }
}

