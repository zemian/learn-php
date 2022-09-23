<?php

// SQLite "INTEGER PRIMARY KEY" is alias for ROWID, and it will automatically populate with incremental value!
echo "== Auto ID with INTEGER PRIMARY KEY\n";
$dbh = new PDO("sqlite::memory:");
$dbh->exec("CREATE TABLE test(id INTEGER PRIMARY KEY, name)");
$dbh->exec("INSERT INTO test(name) VALUES('foo')");
print_r($dbh->query("SELECT * FROM test")->fetchAll(PDO::FETCH_OBJ));
// Insert 2nd row
$dbh->exec("INSERT INTO test(name) VALUES('bar')");
print_r($dbh->query("SELECT * FROM test")->fetchAll(PDO::FETCH_OBJ));

// Note that ROWID is not a type, and it will not do what you expected!
echo "== Auto ID with ROWID\n";
$dbh = new PDO("sqlite::memory:");
$dbh->exec("CREATE TABLE test(id ROWID, name)");
$dbh->exec("INSERT INTO test(name) VALUES('foo')");
print_r($dbh->query("SELECT * FROM test")->fetchAll(PDO::FETCH_OBJ));
// Insert 2nd row
$dbh->exec("INSERT INTO test(name) VALUES('bar')");
print_r($dbh->query("SELECT * FROM test")->fetchAll(PDO::FETCH_OBJ));

//echo "== Explicit ID\n";
//$dbh->exec("INSERT INTO test(id, name) VALUES(101, 'bar')");
//print_r($dbh->query("SELECT * FROM test")->fetch(PDO::FETCH_OBJ));

// NOTE: SQLite performs better without explicit "AUTOINCREMENT" keyword!
// See https://www.sqlite.org/autoinc.html