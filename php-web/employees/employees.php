<?php include_once "app.php"; ?>
<?php app_header(); ?>

<?php

// Setup Page data
$offset = 0;
$limit = 10;
$page = 1; // Current page number
if (isset($_GET['page']) && $_GET['page'] > 0) {
	$page = (int)$_GET['page'];
	$offset = ($page - 1) * $limit;
}

function print_table_row($row) {

echo <<<HERE
<tr>
	<td>{$row['emp_no']}</td>
	<td>{$row['first_name']}</td>
	<td>{$row['last_name']}</td>
	<td>{$row['gender']}</td>
	<td>{$row['hire_date']}</td>
</tr>
HERE;

}
?>

<table class="table is-fullwidth">
<thead>
	<tr>
		<th>Employee ID</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Gender</th>
		<th>Hire Date</th>
	</tr>
</thead>
<tbody>

<?php
$conn = app_create_conn();
$result = $conn->query("SELECT * FROM employees LIMIT $offset, $limit");
while($row = $result->fetch_assoc()) {
	print_table_row($row);
}
$result->close();
?>

</tbody>
</table>

<nav class="pagination" role="navigation" aria-label="pagination">
  <a class="pagination-previous" href="?page=<?= $page - 1; ?>">Previous</a>
  <a class="pagination-next" href="?page=<?= $page + 1; ?>">Next page</a>
</nav>

<?php app_footer(); ?>
