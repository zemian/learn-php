<?php
namespace foo {
    function greeting () {
        return "Hi";
    }
}

namespace bar {
    function test () {
        echo strtoupper(\foo\greeting()) . "\n";
    }
}

namespace {
    \bar\test();   
}
