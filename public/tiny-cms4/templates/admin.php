<?php
/*
 * This is the admin template to render Admin interface. All business logic should be done in controller.
 * Author: Zemian Deng Nov 2020
 */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="templates/css/bulma.min.css">
    
    <?php if ($action === 'new' || $action === 'edit') { ?>
    <link rel="stylesheet" href="templates/js/codemirror/lib/codemirror.css">
    <script src="templates/js/codemirror/lib/codemirror.js"></script>
    <script src="templates/js/codemirror/addon/mode/overlay.js"></script>
    <script src="templates/js/codemirror/mode/javascript/javascript.js"></script>
    <script src="templates/js/codemirror/mode/css/css.js"></script>
    <script src="templates/js/codemirror/mode/xml/xml.js"></script>
    <script src="templates/js/codemirror/mode/htmlmixed/htmlmixed.js"></script>
    <script src="templates/js/codemirror/mode/markdown/markdown.js"></script>
    <script src="templates/js/codemirror/mode/gfm/gfm.js"></script>
    <?php } ?>
    
    <link rel="stylesheet" href="templates/css/marknotes.css">
    <script src="templates/js/marknotes-admin.js"></script>
    
    <title>Admin - <?php echo $title ?></title>
</head>
<body>

<div class="navbar is-primary">
    <div class="navbar-brand">
        <div class="navbar-item"><p class="title"><?php echo $app->name; ?></p></div>
    </div>
    <div class="navbar-start">
        <div class="navbar-item">
            <a class="button is-info" href='admin.php?action=new'>Create</a>
        </div>
    </div>
    <div class="navbar-end">
        <?php if ($action === 'note') { ?>
        <div class="navbar-item">
            <p><?php echo $note; ?></p>
        </div>
        <div class="navbar-item">
            <div class="field has-addons">
                <div class="control"><a class="button" href="admin.php?action=edit&note=<?= $note ?>">Edit</a></div>
                <div class="control"><a class="button" href="admin.php?action=delete&note=<?= $note ?>">Delete</a></div>
            </div>
        </div>
        <?php } ?>
        
        <?php if ($app->get_session() !== null) { ?>
        <div class="navbar-item">
            <div class="control"><a class="button" href="admin.php?action=logout">Logout</a></div>
        </div>
        <?php } ?>
    </div>
</div>

<?php if ($action === 'login' || $action === 'login_submit') { ?>
<section class="section">
    <?php if ($form_error !== null) { ?>
        <div class="notification is-danger"><?php echo $form_error; ?></div>
    <?php } ?>
<div class="level">
    <div class="level-item has-text-centered">
        <form method="POST" action="admin.php">
            <input type="hidden" name="action" value="login_submit">
            <div class="field">
                <div class="label">Admin Password</div>
                <div class="control"><input class="input" type="password" name="password"></div>
            </div>
            <div class="field">
                <div class="control">
                    <input class="button is-info" type="submit" name="submit" value="Login">
                </div>
            </div>
        </form>
    </div>
</div>
</section>
<?php } else { ?>

<section class="section has-min-content-height">
    <div class="columns">
        <div class="column is-3 menu">

            <p class="menu-label">General</p>
            <ul class="menu-list">
                <li><a href='admin.php'>Admin</a></li>
                <li><a href='index.php' target="_blank">Site</a></li>
            </ul>
            
            <?php $app->echo_menu_links(true); ?>
        </div>
        <div class="column is-9">
            <?php if ($action === 'note') { ?>
                <div class="content">
                    <?php
                    if ($note_content === '') {
                        echo "<i>The content is empty! Edit me now!</i>";
                    } else {
                        echo $note_content;
                    }
                    ?>
                </div>
            <?php } else if ($action === 'new' || $action === 'new_submit') { ?>
                <?php if ($form_error !== null) { ?>
                    <div class="notification is-danger"><?php echo $form_error; ?></div>
                <?php } ?>
                <form method="POST" action="admin.php">
                    <input type="hidden" name="action" value="new_submit">
                    <div class="field">
                        <div class="label">Name</div>
                        <p class="help">Enter an unique file name. Allowed extensions are: <?php echo $app->get_supported_extensions(); ?></p>
                        <div class="control"><input id="note_name" class="input" type="text" name="note" value="<?php echo $note; ?>"></div>
                    </div>
                    <div class="field">
                        <div class="label">Content</div>
                        <p class="help">Markdown <a href='https://www.markdownguide.org' target="_blank">Help</a></p>
                        <div class="control"><textarea id='note_content' class="textarea" rows="15" name="note_content"><?php echo $note_content; ?></textarea></div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <input class="button is-info" type="submit" name="submit" value="Create">
                            <a class="button" href="admin.php">Cancel</a>
                        </div>
                    </div>
                </form>
                <script>
                    var editor = loadCodeMirror('note_content', '<?php echo $note; ?>');
                    addElementEventListener('focusout', 'note_name', function (event) {
                        var name = event.target.value;
                        var mode = getCodeMirrorMode(name);
                        editor.setOption('mode', mode);
                    });
                </script>
            <?php } else if ($action === 'edit' || $action === 'edit_submit') { ?>
                <?php if ($form_error !== null) { ?>
                    <div class="notification is-danger"><?php echo $form_error; ?></div>
                <?php } ?>
                <form method="POST" action="admin.php">
                    <input type="hidden" name="action" value="edit_submit">
                    <div class="field">
                        <div class="label">Name</div>
                        <p class="help">Enter an unique file name. Allowed extensions are: <?php echo $app->get_supported_extensions(); ?></p>
                        <div class="control"><input class="input" type="text" name="note" value="<?= $note ?>"></div>
                    </div>
                    <div class="field">
                        <div class="label">Content</div>
                        <p class="help">Markdown <a href='https://www.markdownguide.org' target="_blank">Help</a></p>
                        <div class="control"><textarea id='note_content' class="textarea" rows="15" name="note_content"><?= $note_content ?></textarea></div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <input class="button is-info" type="submit" name="submit" value="Update">
                            <a class="button" href="admin.php?note=<?php echo $note; ?>">Cancel</a>
                        </div>
                    </div>
                </form>
                <script>
                    var editor = loadCodeMirror('note_content', '<?php echo $note; ?>');
                </script>
            <?php } else if ($action === 'delete') { ?>
                <div class="message is-danger">
                    <div class="message-header">Delete Confirmation</div>
                    <div class="message-body">
                        <p class="block">Are you sure you want to delete <b><?= $note ?></b>?</p>

                        <a class="button is-info" href="admin.php?action=delete-confirmed&note=<?= $note ?>">Delete</a>
                        <a class="button" href="admin.php?note=<?= $note ?>">Cancel</a>
                    </div>
                </div>
            <?php } else if ($action === 'delete-confirmed') { ?>
                <div class="message is-success">
                    <div class="message-header">Deleted!</div>
                    <div class="message-body">
                        <p class="block"><?php echo $delete_status; ?></p>                        
                    </div>
                </div>
            <?php } else { ?>
                <div class="message is-warning">
                    <div class="message-header">Oops!</div>
                    <div class="message-body">
                        <p class="block">We can not process this request!</p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<?php } /* closing else on not login form */ ?>

<div class="footer">
    <p>This site is powered by <a href="https://github.com/zemian/foxpages">FoxPages <?php echo $app->version; ?></a></p>
    <?php echo date('Y') . ' &copy; Zemian Deng' ?>
</div>

</body>
</html>
