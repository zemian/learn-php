<?php
require_once '../env.php';
$error = null;
$data = [];
$pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD);

// Perform insert using statement.execute() and params in one call.
$stmt = $pdo->prepare('INSERT INTO category(name) VALUE(?)');
$result = $stmt->execute(['Foo']);
if ($result === false) {
    $error = $stmt->errorInfo();
} else {
    $data[] = ['id' => $pdo->lastInsertId()];
}

// Perform insert using statement.bindValue() and execute() separately.
$stmt->bindValue(1, 'Bar', PDO::PARAM_STR);
$result = $stmt->execute();
if ($result === false) {
    $error = $stmt->errorInfo();
} else {
    $data[] = ['id' => $pdo->lastInsertId()];
}

// Perform insert using statement.bindParam() and execute() separately.
$param = 'Baz'; // Note that it pass as ref, so driver could write back!
$stmt->bindParam(1, $param, PDO::PARAM_STR);
$result = $stmt->execute();
if ($result === false) {
    $error = $stmt->errorInfo();
} else {
    $data[] = ['id' => $pdo->lastInsertId()];
}

// Parent
$stmt = $pdo->prepare('INSERT INTO category(name) VALUE(?)');
$result = $stmt->execute(['Database']);
if ($result === false) {
    $error = $stmt->errorInfo();
} else {
    $parent_id = $pdo->lastInsertId();
    $data [] = ['parent_id' => $pdo->lastInsertId()];
}

// Children
$stmt = $pdo->prepare('INSERT INTO category(name, parent_id, sort_order) VALUE(?, ?, ?)');
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
        $data [] = ['id' => $pdo->lastInsertId()];
    }
}

// Another Parent - Children example
$stmt = $pdo->prepare('INSERT INTO category(name) VALUE(?)');
$result = $stmt->execute(['Language']);
if ($result === false) {
    $error = $stmt->errorInfo();
} else {
    $parent_id = $pdo->lastInsertId();
    $data [] = ['parent_id' => $pdo->lastInsertId()];
}

// Children
$stmt = $pdo->prepare('INSERT INTO category(name, parent_id, sort_order) VALUE(?, ?, ?)');
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
        $data [] = ['id' => $pdo->lastInsertId()];
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>php</title>
</head>
<body>
<?php if ($error) { ?>
    <pre>ERROR: <?php print_r($error); ?></pre>
<?php } else { ?>
    <pre>SUCCESS: <?php print_r($data); ?></pre>
<?php } ?>
</body>
</html>
