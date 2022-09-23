<?php
$dbh = new PDO('sqlite::memory:');
$result = $dbh->exec("CREATE TABLE IF NOT EXISTS options(name, value)");

$sth = $dbh->prepare("INSERT INTO options(name, value) VALUES(?, ?)");
foreach (resourcebundle_locales("") as $locale) {
    $sth->execute([$locale, Locale::getDisplayName($locale)]);
}

$sth = $dbh->query("SELECT * FROM options ORDER by name");
foreach ($sth->fetchAll() as $item) {
    print_r($item);
}
