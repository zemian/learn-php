<?php
require_once '../env.php';
$error = null;
$data = [];
$pdo = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
$result = $pdo->exec(<<<HERE
DROP TABLE IF EXISTS category;
CREATE TABLE category (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    parent_id INT,
    sort_order SMALLINT DEFAULT 0,
    created_dt TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    modified_dt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    deleted BOOLEAN NOT NULL DEFAULT false
);
HERE
);
if ($result === false) {
    $error = $pdo->errorInfo();
} else {
    $data[]= ['result' => $result];
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
    <pre>SUCCESS: <?php print_r($result); ?></pre>
<?php } ?>
</body>
</html>
