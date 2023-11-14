<?php
/*----------------------------------------------
Author: SDK Support Group
Company: Paya
Contact: sdksupport@nuvei.com
!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
!!! Samples intended for educational use only!!!
!!!        Not intended for production       !!!
!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
-----------------------------------------------*/    
    
    // This is the Hosted Payment Page ID and Encryption Key.
    // These are provided when you setup an HPP under a location.
    $hpp = [
        "ID" => "[Hosted Payment Page ID]",
        "KEY" => "[HPP Encryption Key]"
    ];
    
    // Function to encrypt/encode data.
    function getEncodedData($toBeHashed, $password){
        $salt = openssl_random_pseudo_bytes(8);

        $salted = '';
        $dx = '';
        
        while (strlen($salted) < 48) {
            $dx = md5($dx . $password . $salt, true);
            $salted .= $dx;
        }
        
        $key = substr($salted, 0, 32);
        $iv = substr($salted, 32, 16);
        
        // Encrypt the JSON object using the encryptionKey
        $encryptedString = openssl_encrypt($toBeHashed, 'aes-256-cbc', $key, true, $iv);
        
        $encodedEncryptedString =  urlencode(base64_encode("Salted__" . $salt . $encryptedString));
        
        return $encodedEncryptedString;
    }
    
    // Function to write debug information to console.
    function debug_to_console( $data ) {
        $output = $data;
        if ( is_array( $output ) )
            $output = implode( ',', $output);
    
        echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
    }
    

    
?>
