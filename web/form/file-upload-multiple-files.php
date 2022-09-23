<?php
/*
 * https://www.php.net/manual/en/features.file-upload.php
 * Ensure to use array in "name" on file input.
 */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump($_FILES);
}

?>
<form action="file-upload-multiple-files.php" method="post" enctype="multipart/form-data">
    <p>Pictures:
        <input type="file" name="pictures[]" />
        <input type="file" name="pictures[]" />
        <input type="file" name="pictures[]" />
        <input type="submit" value="Send" />
    </p>
</form>
