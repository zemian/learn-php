<?php
/*
https://www.php.net/manual/en/function.filter-input.php

https://www.w3schools.com/php/php_filter.asp
https://www.php.net/manual/en/function.filter-var.php
https://www.php.net/manual/en/filter.filters.php
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