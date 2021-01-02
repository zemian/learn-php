<?php require 'header.php' ?>
<div id="app" class="section">
    <div class="hero">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Contacts Management
                </h1>
                <h2 class="subtitle">
                    You will need MySQL Database for storage.
                </h2>
                <div class="columns">
                    <div class="column">
                        <div class="panel">
                            <p class="panel-heading">
                                Web UI
                            </p>
                            <div class="panel-block">
                                <a href="list.php">List</a>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <div class="panel">
                            <p class="panel-heading">
                                REST API
                            </p>
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
        </div>
    </div>
</div>
<?php require 'footer.php' ?>