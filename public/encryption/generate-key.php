<?php
// Generate some random pairs of encryption key and IV value
// Pick a set and keep them secret.
for ($i = 0; $i < 10; $i++) {

    echo "encryption_algo = 'AES-256-CBC'\n";
    
    $bytes = openssl_random_pseudo_bytes(16);
    $key = bin2hex($bytes);
    echo "encryption_key = '$key'\n";

    $bytes = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
    $iv = base64_encode($bytes);
    echo "encryption_iv = '$iv'\n";
    echo "\n";
}