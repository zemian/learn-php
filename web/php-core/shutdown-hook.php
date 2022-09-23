<?php
echo "Hi there!\n";

// These should be automatic anyway
function app_shutdown() {
    echo "Shutdown is happening!\n";
}
register_shutdown_function('app_shutdown');
