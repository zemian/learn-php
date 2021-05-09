<?php
/*
Process form input with 'name' as the name.
*/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
}
?>
<form method="POST">
    <input name="name" value="foo"><p/>
    <input name="full_name" value="bar"><p/>
    <input type="submit">
</form>
