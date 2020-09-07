<?php 
// htmlspecialchars() makes sure any characters that are special in html are properly encoded so people can't inject HTML tags or Javascript into your page. 
?>

<html>
<body>

Welcome <?php echo htmlspecialchars($_POST["name"]); ?><br>
Your email address is: <?php echo $_POST["email"]; ?>

</body>
</html> 
