<?php

/*
 * The "ob_" stands for output buffer.
 *
 * Sometimes we want to write a function that returns a large HTML output.
 * And the ob_start() can help make the html code little easier to edit.
 */

/**
 * Create and return large amount of HTML string. Note this is different than echo the HTML out
 * immediately.
 *
 * @return HTML string.
 */
function my_html_list() {
    $my_var = 'three';

    ob_start();
    ?>

    <ul>
        <li>one</li>
        <li>two</li>
        <li><?php echo $my_var; ?></li>
    </ul>

    <?php
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}

// Now let's use the html here
echo my_html_list();
