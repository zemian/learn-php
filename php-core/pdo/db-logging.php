<?php
// Use sqlite db to store logging data instead of logfile.
$dbh = new PDO('sqlite:test.log.db');
$result = $dbh->exec("CREATE TABLE IF NOT EXISTS logs(datetime, source, level, message)");

$sth = $dbh->prepare("INSERT INTO logs VALUES(?, ?, ?, ?)");
for ($i = 0; $i < 100; $i++) {
    echo date('c') . " Writing to log\n";
    $sth->execute([date('c'), 'db-logging.php', 'debug', "Just a test #{$i}"]);
    sleep((rand(1, 3)));
}
echo "Done\n";
