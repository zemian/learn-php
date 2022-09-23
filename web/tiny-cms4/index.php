<?php
/*
 * This is the index controller to handle public site rendering for FoxPages.
 * Author: Zemian Deng Nov 2020
 */
require_once 'marknotes.php';
$app = new FoxPagesApp();
$title = $app->config['title'];
$root_menu_label = $app->config['root_menu_label'];
$note = $_GET['note'] ?? $app->config['default_page'];
$parent_dir = $_GET['parent'] ?? '';
$max_menu_levels = $app->config['max_menu_levels'];
$note_content = $app->get_note_content($note);

$template = $app->get_note_template($note);
$app->log('debug', "Index note=$note. Using template=$template");
include $template;
