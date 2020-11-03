<?php
$app = new class {
    const SESSION_USER_KEY = 'user';
    
    var $name = 'Login App';
    var $db;
    var $user;
    
    function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=learnphpdb', 'zemian', 'test123');
        
        // Ensure DB raise error when fail with constraints
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // This application requires session
        session_start();
        $this->user = $_SESSION[self::SESSION_USER_KEY] ?? null;
    }
    
    function login($username, $password) {
        $db = $this->db;
        $sql = "SELECT id, password FROM users WHERE username = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        $password_h = $user['password'];
        if (password_verify($password, $password_h)) {
            $this->user = array('id' => $user['id'], 'username' => $username);

            $_SESSION[self::SESSION_USER_KEY] = $this->user;
            return true;
        } else {
            throw new PDOException("User password does not match.");
        }
    }

    function logout() {
        $_SESSION[self::SESSION_USER_KEY] = null;
        $this->user = null;
        session_destroy();
        
        // Let's start a new session immediately
        session_start();
    }
    
    function isUserLoggedIn() {
        return isset($this->user);
    }
    
    function redirect($path) {
        header("Location: $path");
        exit;
    }
    
    function validate_regex($input, $regex) {
        return filter_var($input, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => $regex]]);
    }

    function header($screen = 'default') {
        echo <<<EOT
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://unpkg.com/bulma">
    <title>$this->name</title>
</head>
<body>
EOT;
        if ($this->isUserLoggedIn()) {
            echo <<<EOT
<div class="navbar is-dark">
    <div class="navbar-brand">
        <a class="navbar-item" href="/login-app/index.php">$this->name</a>
    </div>
    <div class="navbar-menu">
        <div class="navbar-end">
            <div class="navbar-item">Welcome, {$this->user['username']}</div>
            <div class="navbar-item"><a class="button" href="/login-app/admin/logout.php">Logout</a></div>
        </div>
    </div>
</div>
EOT;
        } else {
            echo <<<EOT
<div class="navbar is-primary">
    <div class="navbar-brand">
        <a class="navbar-item" href="/login-app/index.php">$this->name</a>
    </div>
    <div class="navbar-menu">
        <div class="navbar-end">
            <div class="navbar-item"><a class="button" href="/login-app/login.php">Login</a></div>
            <div class="navbar-item"><a class="button is-info" href="/login-app/register.php">Register</a></div>
        </div>
    </div>
    <div>
    </div>
</div>
EOT;
        }
    }

    function footer() {
        echo <<<EOT
</body>
</html>
EOT;
    }
};