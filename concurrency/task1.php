<?php
// TODO: None of these methods are workgin in local Apache yet ?
// Flush not working in Apache?
// https://stackoverflow.com/questions/4706525/php-flush-not-working

//@ini_set('output_buffering',0);

//@ini_set('zlib.output_compression',0);
//@ini_set('implicit_flush',1);
//@ob_end_clean();
//set_time_limit(0);

//ob_implicit_flush(1);

//header( 'Content-Encoding: none; ' );//disable apache compressed
//session_start();
//ob_end_flush();
//ob_start();
//set_time_limit(0);
//error_reporting(0);


// Simulate a long live task
$delay = 5; // seconds
?>

<p>This script will take <?php echo $delay ?> seconds to complete!"</p>
<?php 
flush();
sleep($delay);
?>
<p>Done!</p>
