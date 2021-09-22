<?php
require_once '../env.php';
$error = null;
$db = new PDO(DB_DSN, DB_USER, DB_PASSWORD);
$result = $db->exec(<<<HERE
DROP TABLE IF EXISTS category;
CREATE TABLE category (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    code VARCHAR(48) NOT NULL,
    parent_id INT,
    created_dt TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);
HERE
);
if ($result === false) {
    $error = $db->errorInfo();
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
    <pre>RESULT: <?php print_r($result); ?></pre>
<?php } ?>
</body>
</html>
