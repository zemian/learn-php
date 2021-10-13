<?php
$input = array (
    'dbname' => 'wordpressdb',
    'tables' => ['wp_posts', 'wp_comments', 'wp_users', 'wp_usermeta', 'wp_options', 'wp_terms']
);
$dbinfo = array();
$db = new PDO('mysql:host=localhost;dbname=mysql', 'zemian', 'test123');
//$stmt = $db->query("select version()");
$dbname = $input['dbname'];
foreach ($input['tables'] as $table) {
    $stmt = $db->query("select * from information_schema.columns where table_schema = '$dbname' and table_name = '$table'");
    $dbinfo[$table] = array();
    while ($rows = $stmt->fetch()) {
        $dbinfo[$table][] = $rows;
    }
    //print_r($dbinfo);
}

function get_label($colname, $type) {
//    return $colname;
    return $colname . "<span class='help'>" . $type . "</span>";
}
function get_control($colname, $type) {
    switch ($type) {
        case "int":
        case "bigint":
        case "tinyint":
            return "<input class='input' type='number' name='$colname'>";
        case "timestamp":
        case "datetime":
            return "<input class='input' type='datetime-local' name='$colname'>";
        case "date":
            return "<input class='input' type='date' name='$colname'>";
        case "time":
            return "<input class='input' type='time' name='$colname'>";
        case "text":
        case "varchar":
            return "<input class='input' type='text' name='$colname'>";
        case "longtext":
            return "<texarea class='textarea' name='$colname'></texarea>";
        default:
	        return "<input class='input' name='$colname'>";
    }
}
?>

<link rel="stylesheet" href="https://unpkg.com/bulma">
<?php foreach (array_keys($dbinfo) as $table) { ?>
<div class="section">
    <h1 class="title"><?php echo $table ?></h1>
    <form class="form"><?php foreach ($dbinfo[$table] as $row) { ?>
        <div class="field">
            <div class="label"><?php echo get_label($row['COLUMN_NAME'], $row['DATA_TYPE']); ?></div>
            <div class="control"><?php echo get_control($row['COLUMN_NAME'], $row['DATA_TYPE']); ?></div>
        </div><?php } ?>
    </form>
</div>
<?php } ?>