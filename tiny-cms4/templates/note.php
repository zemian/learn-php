<?php
/*
 * This is the note template to render a single page content. All business logic should be done in controller.
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
    <link rel="stylesheet" href="templates/css/marknotes.css">
    <title><?php echo $title ?></title>
</head>
<body>

<section class="section has-min-content-height">
    <div class="columns">
        <div class="column is-3 menu">
            <?php $app->echo_menu_links(); ?>
        </div>
        <div class="column is-9">
            <div class="content">
                <?php echo $note_content; ?>
            </div>
        </div>
    </div>
</section>

</body>
</html>
