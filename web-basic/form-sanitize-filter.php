<?php
// The difference between VALIDATE vs SANITIZE is that latter will return a modified version of the input 
// Try string input with:
//   "><script>alert("hello");</script>

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST['name'] = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
}

?>

<h1>Form input sanitize input (avoid JS injection)</h1>

<?php if ($_POST['name'] ?? '') { ?>
<div>
    Submitted: <?php echo $_POST['name'] ?? ''; ?>
</div>
<?php } ?>

<form method="post">
    <div>
        Input: <input type="text" name="name" value="<?php echo $_POST['name'] ?? '' ?>" style="width: 100%; font-size: 2em;">
    </div>
    <div>
        <input type="submit" name="submit" value="Submit">
    </div>
</form>