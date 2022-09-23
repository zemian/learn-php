<?php
/*
https://www.php.net/manual/en/function.filter-input.php

How is PHP email validated?

It uses regex based on by Michael Rushton, but not identical.

See https://github.com/php/php-src/blob/8200d667fbf66b388194a8e612e836a976f8496d/ext/filter/logical_filters.c
    "void php_filter_validate_email(PHP_INPUT_FILTER_PARAM_DECL)"
*/
?>
<table>
    <tr>
        <td>Filter Name</td>
        <td>Filter ID</td>
    </tr>
    <?php
    $list = filter_list();
    sort($list);
    foreach ($list as $id => $filter) {
        echo '<tr><td>' . $filter . '</td><td>' . filter_id($filter) . '</td></tr>';
    }
    ?>
</table>

<h1>examples</h1>
<?php
$email = "john.doe@example.com";

// Remove all illegal characters from email
$email = filter_var($email, FILTER_SANITIZE_EMAIL);

// Validate e-mail
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo("$email is a valid email address");
} else {
    echo("$email is not a valid email address");
}
?>