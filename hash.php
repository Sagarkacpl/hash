<?php

function convert_string($action, $string, $salt)
{
    $output = '';
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'vaUM777#$vaUM7$@57#$vaUM777#$vaUM7245#7#$';
    $secret_iv = 'localhost/hash/';
    $key = hash('sha512', $secret_key);
    $initialization_vector = substr(hash('sha512', $secret_iv), 0, 16);

    // Concatenate salt with the input string
    $string_with_salt = $string . $salt;

    if ($string_with_salt != '') {
        if ($action == 'encrypt') {
            $output = openssl_encrypt($string_with_salt, $encrypt_method, $key, 0, $initialization_vector);
            $output = base64_encode($output);
        } 
        if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $initialization_vector);
            // Remove salt after decryption
            $output = str_replace($salt, '', $output);
        }
    }
    return $output;
}

$id = 'Hello World';
$salt = generateRandomString(); // Generate a random salt

echo "Encrypted: " . convert_string('encrypt', $id, $salt) . "<br> <br>";
echo "Decrypted: " . convert_string('decrypt', convert_string('encrypt', $id, $salt), $salt) . "<br>";

// Function to generate a random string
function generateRandomString($length = 32) {
    return bin2hex(random_bytes($length));
}

?>
