<?php
class App {
    function __construct() {
        $this->db = new PDO('sqlite:' . __DIR__ . '/app.db');
    }
    
    function checkUserPassword($username, $password) {
        $stmt = $this->db->prepare('SELECT password FROM users WHERE username = ?');
        $stmt->execute([$username]);
        $h = $stmt->fetchColumn();
        return password_verify($password, $h);
    }
}

$app = new App();
$user_session = null;
session_start();
if (isset($_SESSION['user_session'])) {
    $user_session = $_SESSION['user_session'];
}
?>

<?php if ($user_session) { ?>
    USER LOGGED IN
<?php } else { ?>
    PLEASE LOGIN
<?php } ?>
