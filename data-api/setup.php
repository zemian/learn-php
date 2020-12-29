<?php
/*
DROP TABLE IF EXISTS contacts;
CREATE TABLE contacts (
id INT  NOT NULL AUTO_INCREMENT PRIMARY KEY,
create_ts TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
name VARCHAR(100) NOT NULL,
email VARCHAR(200) NOT NULL,
message TEXT NOT NULL
);

INSERT INTO contacts(name, email, message) VALUES
('tester1', 'tester1@localhost.com', 'Just a test'),
('tester2', 'tester2@localhost.com', 'Just a test'),
('tester3', 'tester3@localhost.com', 'Just a test');

 */
$db = new PDO('mysql:host=localhost;dbname=testdb', 'zemian', 'test123');
$stmt = $db->prepare('INSERT INTO contacts(name, email, message) VALUES (?, ?, ?)');
$batch_id = rand(1000, 9999);
for ($i = 0; $i < 100; $i++) {
    $stmt->execute(['tester' . $i, 'tester' . $i . '@localhost.com', 'Just a test. BatchID=' . $batch_id]);
}
echo "Created sample data";
