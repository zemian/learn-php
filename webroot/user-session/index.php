<?php 
// Check for user session and redirect to login if not found.
session_start();
if (!isset($_SESSION['user_session'])) {
    header("Location: login.php");
    exit;
}
$user_session = $_SESSION['user_session'];
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
        <p>When you are done, please <a href="login.php?logout">logout</a>.</p>
    </div>
</section>

</body>
</html>
