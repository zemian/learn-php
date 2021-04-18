<?php
// Check for user session and redirect to login if not found.
session_start();
if (!isset($_SESSION['user_session'])) {
    header("Location: login.php");
    exit;
}
$user_session = $_SESSION['user_session'];
$logout_url = "login.php?logout";
if ($user_session['login_with_facebook']) {
    $logout_url = $user_session['fb_logout_url'];
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

<section class="section">
    <div class="container">
        <h1 class="title">Welcome <?php echo $user_session['username']; ?></h1>
        <h2 class="subtitle">Your session is active since <?php echo date(DATE_ISO8601, $user_session['login_time']); ?></h2>
        <?php
        if ($user_session['login_with_facebook']) {
            echo "<p>Note: You are have signed in using Facebook!</p>";
        }
        ?>
        <p>When you are done, please <a href="<?php echo $logout_url; ?>">logout</a>.</p>
    </div>
</section>

</body>
</html>
