<?php
/*
 * Show various ways to insert data into DB.
 */

$dbh = new PDO('sqlite::memory:');

$dbh->exec("CREATE TABLE IF NOT EXISTS categories(id INTEGER PRIMARY KEY, name, parent_id, sort_order)");

// Insert using query() method
$sth = $dbh->query("INSERT INTO categories (id, name) VALUES (?, ?)");
$sth->execute([101, 'just a test']);
print_r(["test1: id=101", $dbh->query("SELECT * FROM categories WHERE id = 'test1'")->fetchAll()]);

// Perform insert using statement.execute() and params in one call.
// Automatically get auto generated ID
// NOTE: query() can not accept binding parameters, you always need separate call to bind it or execute with params.
// NOTE: It's more consistent to use prepare() rather than query() if there are binding params.
$stmt = $dbh->prepare('INSERT INTO categories(name) VALUES(?)');
$result = $stmt->execute(['Foo']);
$sth = $dbh->query("SELECT * FROM categories WHERE id = ?");
$sth->execute([$dbh->lastInsertId()]);
print_r(["test2: generated id", $sth->fetchAll()]);

// Perform insert using statement.bindValue() and execute() separately.
$stmt->bindValue(1, 'Bar', PDO::PARAM_STR);
$result = $stmt->execute();
if ($result === false) {
    $error = $stmt->errorInfo();
} else {
    $data[] = ['id' => $dbh->lastInsertId()];
}

// Perform insert using statement.bindParam() and execute() separately.
$param = 'Baz'; // Note that it pass as ref, so driver could write back!
$stmt->bindParam(1, $param, PDO::PARAM_STR);
$result = $stmt->execute();
if ($result === false) {
    $error = $stmt->errorInfo();
} else {
    $data[] = ['id' => $dbh->lastInsertId()];
}

// Parent
$stmt = $dbh->prepare('INSERT INTO categories(name) VALUES(?)');
$result = $stmt->execute(['Database']);
if ($result === false) {
    $error = $stmt->errorInfo();
} else {
    $parent_id = $dbh->lastInsertId();
    $data [] = ['parent_id' => $dbh->lastInsertId()];
}

// Children
$stmt = $dbh->prepare('INSERT INTO categories(name, parent_id, sort_order) VALUES(?, ?, ?)');
$pdo_list = ['MySQL', 'SQLite', 'MariaDB', 'PostgreSQL', 'OracleDB'];
$order = 1;
foreach ($pdo_list as $pdo_name) {
    $stmt->bindValue(1, $pdo_name, PDO::PARAM_STR);
    $stmt->bindValue(2, $parent_id, PDO::PARAM_INT);
    $stmt->bindValue(3, $order++, PDO::PARAM_INT);
    $result = $stmt->execute();
    if ($result === false) {
        $error = $stmt->errorInfo();
        break;
    } else {
        $data [] = ['id' => $dbh->lastInsertId()];
    }
}

// Another Parent - Children example
$stmt = $dbh->prepare('INSERT INTO categories(name) VALUES(?)');
$result = $stmt->execute(['Language']);
if ($result === false) {
    $error = $stmt->errorInfo();
} else {
    $parent_id = $dbh->lastInsertId();
    $data [] = ['parent_id' => $dbh->lastInsertId()];
}

// Children
$stmt = $dbh->prepare('INSERT INTO categories(name, parent_id, sort_order) VALUES(?, ?, ?)');
$pdo_list = ['PHP', 'JavaScript', 'SQL', 'Python', 'Java'];
$order = 1;
foreach ($pdo_list as $pdo_name) {
    $stmt->bindValue(1, $pdo_name, PDO::PARAM_STR);
    $stmt->bindValue(2, $parent_id, PDO::PARAM_INT);
    $stmt->bindValue(3, $order++, PDO::PARAM_INT);
    $result = $stmt->execute();
    if ($result === false) {
        $error = $stmt->errorInfo();
        break;
    } else {
        $data [] = ['id' => $dbh->lastInsertId()];
    }
}
