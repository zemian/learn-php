<?php
/*
 * This is the admin controller to handle Admin management for FoxPages.
 * Author: Zemian Deng Nov 2020
 */
require_once 'marknotes.php';
$app = new FoxPagesApp();

$action = $_GET['action'] ?? "note";
$title = $app->config['title'];
$root_menu_label = $app->config['root_menu_label'];
$note = $_GET['note'] ?? $app->config['default_page'];
$parent_dir = $_GET['parent'] ?? '';
$delete_status = null;
$note_content = null;
$form_error = null;
$notes = [];
$max_menu_levels = $app->config['max_menu_levels'];

if ($app->is_admin_password_protected() && $app->get_session() === null) {
    $action = "login";
}

if (isset($_POST['action'])) {
    // We support both Create or Update here
    $app->log('debug', 'Processing POST action', $_POST);
    $action = $_POST['action'];
    
    if ($action === "login_submit") {
        $password = $_POST['password'];
        $form_error = $app->login($password);
        $app->log('debug', "login error=$form_error");
        
        if ($form_error === null) {
            $app->log('info', "Admin has logged in successfully.");
            $app->redirect("admin.php");
        } else {
            $app->log('warning', "An invalid admin password has been attempted.");
        }
    } else if ($action === "new_submit" || $action === "edit_submit") {
        $note = $_POST['note'];
        $note_content = $_POST['note_content'];

        // Sanitize input name
        $note = trim($note); // Remove any white spaces
        $note = ltrim($note, '/'); // Remove left leading slash
        $note = strtolower($note); // Always lowercase file note name

        // Do not validate file exists if it's an Update
        if ($form_error === null) {
            $check_file_exists = $action === 'new_submit';
            $form_error = $app->validate_note_name($note, $check_file_exists);
        }

        // If content type is json, validate it
        $type = pathinfo($note, PATHINFO_EXTENSION);
        if ($form_error === null && $type === 'json') {
            $form_error = (json_decode($note_content) === null) ? 'Invalid JSON format.' : null;
        }
        
        if ($form_error === null) {
            $form_error = $app->validate_note_content($note_content);
        }
        
        // Save file if there is no error. If it's Update, it will simply override existing file!
        if ($form_error === null) {
            $app->file_service->write($note, $note_content);
            $action_label = ($action === 'new_submit') ? "created" : "updated";
            $app->log('info', "Content has been $action_label: $note");
            $app->redirect("admin.php?note=$note");
        }
    } else {
        $msg = "Unknown action=$action";
        $app->log('warning', $msg);
        die($msg);
    }
} else if ($action === 'new') {
    $note = '';
    $note_content = '';
} else if ($action === 'edit') {
    if ($app->file_service->exists($note)) {
        $note_content = $app->file_service->read($note);
    } else {
        $note_content = "Note not found: $note";
        $app->log('warning', "Edit file not found: $note");
    }
} else if ($action === 'delete-confirmed') {
    // Process GET - DELETE file
    $note = $_GET['note'];
    if ($app->file_service->delete($note)) {
        $delete_status = "Note $note deleted";
        $app->log('info', "Content has been deleted: $note");
    } else {
        $app->log('warning', "Delete file not found: $note");
        $delete_status = "Note not found: $note";
    }
} else if ($action === 'logout') {
    $app->logout();
    $app->log('info', "Admin has logged out successfully.");
    $app->redirect('admin.php');
}

if ($action !== 'login') {
    if (!($action === 'new' || $action === 'edit' || $action === 'delete' || $action === 'delete-confirmed') && $form_error === null) {
        $note_content = $app->get_note_content($note, true);
    }
}

$template = $app->get_template_path('admin.php');
$app->log('debug', "Admin action=$action. Using template=$template");
include $template;
