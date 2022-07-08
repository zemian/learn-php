<?php
$execute_result = '';
$sql = "SELECT name FROM sqlite_master WHERE type='table'";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pdo = new PDO('sqlite:crud.db');
    $sql = $_POST['sql'];
    try {        
        if ($_POST['action'] === 'Execute') {
            $execute_result = $pdo->exec($sql);
        } else {            
            $stmt = $pdo->query($sql);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $execute_result = json_encode($data, JSON_PRETTY_PRINT);
        }
    } catch (Exception | Error $e) {
        $execute_result = $e;
    }
}
?>
<!DOCTYPE html>
<!--
Provide a Form to create DB Table in crud.db SQLite database.
These tables then can be used by crud.php to perform CRUD operations.

Example tables:
    create table options(name text primary key, value text);
    insert into options(name, value) values('hello', 'Hello World');
    insert into options(name, value) values('foo', 'Foo');
    insert into options(name, value) values('num', '789');

-->
<html>
<head>
    <meta charset="UTF-8">
    <title>Create Table for crud.db</title>
    <link rel="stylesheet" href="https://unpkg.com/bulma@0.9.4/css/bulma.min.css">
    <script src="https://unpkg.com/vue@3.2.37/dist/vue.global.prod.js"></script>
</head>
<body>

<div id="app">
    <div class="section">
        <form class="container" method="POST" action="">
            <h1 class="title">Query/Execute SQL on crud.db Database</h1>
            <div class="field">
                <div class="control">
                    <textarea class="textarea" rows="10" name="sql"><?php echo $sql; ?></textarea>
                </div>
            </div>

            <input class="button is-primary" type="submit" name="action" value="Query">
            <input class="button is-danger" type="submit" name="action" value="Execute">
        </form>

        <?php if ($execute_result): ?>
        <div class="container">
            <h1 class="title">Result</h1>
            <pre><?php echo $execute_result; ?></pre>
        </div>
        <?php endif; ?>
    </div>
</div>

<script>
</script>
</body>
</html>
