<?php


function db_conn() {
    $db_file = 'user/user.sqlite';
    $pdo = new PDO('sqlite:' . __DIR__ . $db_file);
    if (!is_file($db_file)) {
        $pdo->exec(<<<HERE
            CREATE TABLE users (
                id INT PRIMARY KEY,
                username VARCHAR(100) NOT NULL
            );
            HERE
        );
    }
    return $pdo;
}

function db_save($user) {
    $pdo = db_conn();
    $stmt = $pdo->prepare('INSERT INTO users(username) VALUE(?)');
    $stmt->execute([$user['username']]);
    return $pdo->lastInsertId();
}

header('content-type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //curl -X POST -d '{"username": "foo"}' http://localhost:3000/user/user-api.php
    $json_input = file_get_contents('php://input');
    $data = json_decode($json_input, true);
    $data['id'] = db_save($data);
    echo json_encode($data);
} else {
    $data = array([
        'id' => 1001,
        'username' => 'zemian'
    ]);
    echo json_encode($data);
}