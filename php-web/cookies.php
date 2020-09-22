<?php
/*
 * Cookies is piece of data (hashmap with name/value pairs) that browser used to track site information that can be 
 * retained across multiple requests. Cookies can be set directly in browser using JS, or from server side using PHP.
 * The Cookies can be send from server to browser or submit from browser to server through HTTP headers. When 
 * sending Cookies from server, you can add options such expiration date, but when sending Cookies from browser
 * to server (it's automatic on existing Cookies), it only sends the name/value pairs.
 * 
 * In PHP, you can't just tell browser to delete a Cookie, but rather you would set your Cookie to expire instead.
 */

// NOTE: Cookies must be set before header() in PHP!
$action = isset($_GET['action']) ? $_GET['action'] : '';
$action_msg = 'Unknown action';
switch ($action) {
    case "delete":
        $name = isset($_GET['name']) ? $_GET['name'] : 'TestCookie';
        setcookie($name, "", time() - 3600);
        $action_msg = "Cookie $name has been set to expired.";
        break;
    case "delete-all":
        $count = count($_COOKIE);
        foreach (array_keys($_COOKIE) as $name)
            setcookie($name, "", time() - 3600);
        $action_msg = "All $count Cookies have been set to expired.";
        break;
    case "delete-sample":
        for ($i = 0; $i < 10; $i++)
            if (isset($_COOKIE["TestCookie$i"]))
                setcookie("TestCookie$i", "", time() - 3600);
        $action_msg = "Sample 'TestCookieX' Cookies have been set to expired.";
        break;
    case "add":
        $name = isset($_GET['name']) ? $_GET['name'] : 'TestCookie';
        $value = isset($_GET['value']) ? $_GET['value'] : 'Foo';
        $options = array();
        if (isset($_GET['expires']))
            $options['expires'] = time() + $_GET['expires'];
        if (isset($_GET['path']))
            $options['path'] = time() + $_GET['path'];
        if (isset($_GET['domain']))
            $options['domain'] = time() + $_GET['domain'];
        if (isset($_GET[' secure']))
            $options[' secure'] = time() + $_GET[' secure'];
        if (isset($_GET['httponly']))
            $options['httponly'] = time() + $_GET['httponly'];
        if (isset($_GET['samesite']))
            $options['samesite'] = time() + $_GET['samesite'];
        setcookie($name, $value, $options);
        $action_msg = "Cookie $name has been added.";
        break;
    case "add-sample":
        setcookie("TestCookie1", "foo");
        setcookie("TestCookie2", "foo2", time()+3600);  /* expire in 1 hour */
        setcookie("TestCookie3", "foo3", "/my/path", "example.com");
        $action_msg = "Sample Cookies 'TestCookieX' has been added.";
        break;
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<?php if (!empty($action)) {
    echo "<h1>Action Processed: $action</h1>";
    echo "<p>$action_msg</p>";
} ?>

<h1>List of Cookies From Request</h1>
<!-- NOTE: You can read and get the expiration dates and other options from the browser cookie! -->
<?php var_dump($_COOKIE); ?>

</body>
</html>