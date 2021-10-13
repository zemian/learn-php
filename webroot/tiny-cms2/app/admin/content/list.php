<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>mycms-admin - MyCMS</title>
    <link rel="stylesheet" href="https://unpkg.com/bulma">
</head>
<body>
<div class="section mycms-admin-page">
    <div class="container mycms-admin-page-container">
        <h1 class="title">CMS Administration - Content</h1>
        <div class="columns">
            <div class="column is-4 mycms-admin-page-left-nav">
                <ul class="panel">
                    <li class="panel-block"><a href="/admin/index.php">Admin</a></li>
                    <li class="panel-block"><a href="/admin/content/list.php">List Content</a></li>
                    <li class="panel-block"><a href="/admin/content/create.php">Create Content</a></li>
                </ul>
            </div>
            <div class="column is-8 mycms-admin-page-right-content">
                <table class="table is-fullwidth content-list">
                    <tr>
                        <td><!--selection--></td>
                        <td>ID</td>
                        <td>Title</td>
                        <td>Type</td>
                        <td>Slug</td>
                        <td>Created</td>
                    </tr>
                </table>
            </div> <!-- columns -->
        </div> <!-- mycms-admin-page-right-content -->
    </div> <!-- mycms-admin-page-container -->
</div><!-- mycms-admin-page -->
</body>
</html>