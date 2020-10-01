<?php include_once "app.php"; ?>
<?php app_header(); ?>

<?php
$conn = app_create_conn();
$result = $conn->query('SELECT count(*) AS count FROM employees');
$employee_count = $result->fetch_row()[0];
$result->close();
?>

<div class="hero has-text-centered">
  <div class="hero-body">
    <div class="container">
        <h1 class="title">Employees App</h1>
        <p class="subtitle">We have        
            <span class="tag"><?= $employee_count ?></span>
            <a href="employees.php">employees</a>
        </p>
    </div>
  </div>
</div>

<?php app_footer(); ?>