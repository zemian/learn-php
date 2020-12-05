<?php 
namespace foo {
    function greeting () {
        return "Hi";
    }
}

namespace {
    // Root namespace
    echo strtoupper(\foo\greeting()) . "\n";
}
