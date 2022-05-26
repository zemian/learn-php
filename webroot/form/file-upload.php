<?php
/*
 * https://www.php.net/manual/en/features.file-upload.php
 *
 * PHP uses form POST with "multipart/form-data" encoding to upload
 * a file from client browser, and write it to a temporary location
 * in the server, then developers can use $_FILES to process it.
 *
 * Use "move_uploaded_file" function to move temp upload file into
 * location you want.
 *
 * NOTE on max file size:
 * The MAX_FILE_SIZE item cannot specify a file size greater than the file size that has been set in the
 * upload_max_filesize in the php.ini file. The default is 2 megabytes.
 * See more on https://www.php.net/manual/en/features.file-upload.common-pitfalls.php
 */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // NOTE: Check for ($_FILES['error'] !== 0) to ensure file is actually
    // transferred correctly first. Example if file is too big, it will not
    // be written in server and error will be set.
    // See more on error code: https://www.php.net/manual/en/features.file-upload.errors.php
    var_dump($_FILES);
}

?>
<!-- The data encoding type, enctype, MUST be specified as below -->
<form enctype="multipart/form-data" action="file-upload.php" method="POST">
    <!-- MAX_FILE_SIZE must precede the file input field -->
    <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
    <!-- Name of input element determines name in $_FILES array -->
    Send this file: <input name="userfile" type="file" />
    <input type="submit" value="Send File" />
</form>
