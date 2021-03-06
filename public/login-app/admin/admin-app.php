<?php
require_once "../app-class.php";

class AdminApp extends App {
    function init() {
        parent::init();
        $this->ensureUserLoggedIn();
    }
    
    function ensureUserLoggedIn() {
        if (!$this->isUserLoggedIn()) {
            $this->redirect('/login-app/login.php');
        }
    }

    function header() {
        parent::header();
        
        echo <<<EOT
<section class="section" style="min-height: 80vh;">
<div class="columns">
    <div class="column is-3"> <!-- admin menu -->
EOT;
        
        $this->admin_menu();
        
        echo <<<EOT
    </div> <!-- admin menu -->
    <div class="column is-9"> <!-- content -->
EOT;
    }
    
    function footer() {
        echo <<<EOT
    </div> <!-- content -->
</div> <!-- columns layout -->
</section>
EOT;
        parent::footer();
    }

    function navbar() {
        echo <<<EOT
<div class="navbar is-dark">
    <div class="navbar-brand">
        <a class="navbar-item" href="/login-app/index.php">$this->name</a>
    </div>
    <div class="navbar-menu">
        <div class="navbar-end">
            <div class="navbar-item">Welcome, {$this->user['username']}</div>
            <div class="navbar-item"><a class="button" href="/login-app/admin/logout.php">Logout</a></div>
        </div>
    </div>
</div>
EOT;
    }
    
    function admin_menu() {
        echo <<<EOT
<aside class="menu">
    <p class="menu-label">Admin</p>
    <ul class="menu-list">
        <li class="menu-item"><a href="/login-app/admin/index.php">System</a></li>
    </ul>
    <p class="menu-label">User</p>
    <ul class="menu-list">
        <li class="menu-item"><a href="/login-app/admin/user-list.php">List</a></li>
        <li class="menu-item"><a href="/login-app/admin/user-create.php">Create</a></li>
    </ul>
</aside>
EOT;
    }
}

// Override global variable
$app = new AdminApp();

// Auto check to ensure admin is protected
$app->init();
