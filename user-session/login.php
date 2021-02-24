<?php
// Page vars
$error = null;
$message = null;
$success_url = 'index.php';

// Global vars
session_start();

// Process logout if given in url param
if (isset($_GET['logout'])) {
    if (isset($_SESSION['user_session'])) {
        $_SESSION['user_session'] = null;
        session_destroy();
        $message = "Logout successful.";
    } else {
        $error = "Logout failed: User has not logged in yet.";
    }
} else {
    // If user already logged in, go back to index page
    if (isset($_SESSION['user_session'])) {
        header("Location: $success_url");
        exit;
    }
    
    // Process login
    if (isset($_POST['login'])) {
        $user_db = array(
            'tester1' => 'test123',
            'tester2' => 'test123',
            'tester3' => 'test123',
            'admin' => 'test123',
        );

        // Authenicate user
        $username = $_POST['username'];
        $password = $_POST['password'];
        $check_password = $user_db[$username] ?? null;
        if ($check_password === $password) {
            $_SESSION['user_session'] = array(
                    'username' => $username,
                    'login_time' => time()
            );
            header("Location: $success_url");
            exit;
        } else {
            $error = "Invalid login.";
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP App</title>
    <link rel="stylesheet" href="https://unpkg.com/bulma">
</head>
<body>

<section class="hero is-primary is-fullheight">
    <div class="hero-body">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-4">
                    <div class="box">
                        <form action="login.php" method="POST">
                            <?php 
                            if ($error) {
                                echo "<p class='notification is-danger'>$error</p>";   
                            }
                            if ($message) {
                                echo "<p class='notification is-info'>$message</p>";
                            }
                            ?>
                            <div class="field">
                                <div class="control">
                                    <label class="label">Username</label>
                                    <input class="input" type="text" name="username">
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <label class="label">Password</label>
                                    <input class="input" type="password" name="password">
                                </div>
                            </div>
                            <div class="field">
                                <div class="control">
                                    <input class="button is-primary" type="submit" value="Login" name="login">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>
