<?php
/*
PHP Parse name='field[]' into Array object.
*/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';
}
?>
<form method="POST">
    <input name="field[]" value="foo"><p/>
    <input name="field[]" value="bar"><p/>
    <input type="submit">
</form>
