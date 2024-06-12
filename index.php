<?php
function convert_string($action, $string)
{
    $output = '';
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'vaUM777#$vaUM7$@57#$vaUM777#$vaUM7245#7#$';
    $secret_iv = 'localhost/hash/';
    $key = hash('sha256', $secret_key);
    $initialization_vector = substr(hash('sha256', $secret_iv), 0, 16);
    if ($string != '') {
        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $initialization_vector);
            $output = base64_encode($output);
        } 
        if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $initialization_vector);
        }
    }
    return $output;
}



for ($i = 0; $i <= 200; $i++) {
     // Perform encryption and print the result
     $encrypted_text = convert_string('encrypt', $i);
     echo "Encrypted text: " . $encrypted_text . "<br>";
 
    //  Perform decryption and print the result
     $decrypted_text = convert_string('decrypt', $encrypted_text);
     echo "Decrypted text: " . $decrypted_text . "<br>";




    // Perform encryption and print the result
    // $encrypted_text = convert_string('encrypt', $i);
    // echo "Encrypted text: " . $encrypted_text . "<br>";

    // // Perform decryption and print the result
    // $decrypted_text = convert_string('decrypt', $encrypted_text);
    // echo "Decrypted text: " . $decrypted_text . "<br>";
}
?>
