<?php require 'header.php' ?>
<div id="app" class="section">
    <div class="columns is-centered">
        <div class="column is-one-third">
            <div class="panel">
                <p class="panel-heading">
                    Contacts Management
                </p>
                <div class="panel-block">
                    <a href="list.php">List</a>
                </div>
                <div class="panel-block">
                    <a href="api.php?action=init_table">Create Table</a>
                </div>
                <div class="panel-block">
                    <a href="api.php?action=create_data?count=40">Create Data</a>
                </div>
                <div class="panel-block">
                    <a href="api.php?action=test_db">Test DB</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require 'footer.php' ?>