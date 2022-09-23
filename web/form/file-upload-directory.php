<?php
/*
 * https://www.php.net/manual/en/features.file-upload.multiple.php
 *
 * Use browser attribute on file input with "webkitdirectory multiple"
 *
 * NOTE: The webkitdirectory attribute is non-standard and is not on a standards track.
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump($_FILES);
}

?>
<form action="file-upload-directory.php" method="post" enctype="multipart/form-data">
    Send this directory:<br />
    <input name="userfile[]" type="file" webkitdirectory multiple />
    <input type="submit" value="Send files" />
</form>
