<?php
// For loop
for ($i = 0; $i < 3; $i++) {
    echo "test $i", "\n";
}

// While loop
$count = 0;
$done = false;
while (!$done) {
    $count++;
    if ($count > 3)
        $done = true;
}
echo "count, done", $count, $done, "\n";
?>