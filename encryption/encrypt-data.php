<?php
// Refs:
// https://www.php.net/manual/en/function.openssl-encrypt.php

$env = parse_ini_file(__DIR__ . '/../env.ini');
$plaintext = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid itaque iusto perferendis? Cum earum facilis in, nam omnis recusandae sit. Ab debitis, distinctio dolores dolorum exercitationem modi nobis quam suscipit.';

$encryption_algo = $env['encryption_algo'];
$encryption_key = $env['encryption_key'];
$encryption_iv = base64_decode($env['encryption_iv']);
$encrypted = openssl_encrypt($plaintext, $encryption_algo , $encryption_key, OPENSSL_RAW_DATA, $encryption_iv);

// Just for debugging purpose. We normally want to save the binary result.
//echo "Encrypted raw: " . $encrypted . "\n";
echo "Encrypted hex: " . base64_encode($encrypted) . "\n";

$decrypted = openssl_decrypt($encrypted, $encryption_algo, $encryption_key, OPENSSL_RAW_DATA, $encryption_iv);
echo $decrypted . "\n";

// NOTE: You should also use hash_hmac() to digest the "$encrypted" and then use hash_equals() to ensure they pass
// before using the decrypted data.
 