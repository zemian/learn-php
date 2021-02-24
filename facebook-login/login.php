<?php
session_start();
$error = null;
$message = null;
$success_url = 'index.php';

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
                'login_time' => time(),
                'username' => $username,
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

    <script src="https://unpkg.com/vue"></script>
</head>

<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
<script>
    window.fbAsyncInit = function () {
        FB.init({
            appId: '333980400998341',
            version: 'v10.0',
            cookie: true,
        });

        FB.login(function (response) {
            if (response.authResponse) {
                // console.log("Facebook authResponse", response.authResponse);
                console.log('Welcome! You are logged in using Facebook user.');
                // FB.api('/me', function(response) {
                //     console.log("/me response", response);
                //     console.log('Good to see you, ' + response.name + '.');
                // });
                window.location.href = "login-with-facebook.php";
            } else {
                console.error('User cancelled login or did not fully authorize.');
            }
        });
    };
</script>

<section id="app" class="hero is-primary is-fullheight">
    <div class="hero-body">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-6">
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
                            <div class="columns is-centered">
                                <div class="column">
                                    <input class="button is-primary" type="submit" value="Login" name="login">
                                </div>
                                <div class="column">
                                    <div class="fb-login-button" data-width=""
                                         data-size="large" data-button-type="continue_with" data-layout="default"
                                         data-auto-logout-link="false" data-use-continue-as="false"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    new Vue({}).$mount('#app');
</script>

</body>
</html>
