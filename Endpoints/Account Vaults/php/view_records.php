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

    // Sample queries all vault records within the user_id's primary location.
	
	require('shared.php');
    
    // Developer Variables
    $developerID = $developer['ID'];
    $host = $developer['Host'];
    
    // User Variables
    $userID = $user['ID'];
    $userAPIKey = $user['APIKey'];
    
    // Vault Variables
    $verb = "GET";
    $endpoint = "/v2/accountvaults"; // This will pull all records within the primary location of the user_id within the header. Additional query data and filters may be applied to reduce the number of records returned.
    
        
    // cURL to submit the GET.
    $curl = curl_init();
    $url = $host . $endpoint;
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $verb,
        CURLOPT_HTTPHEADER => array(
            "content-type: application/json",
            "developer-id: " . $developerID,
            "user-api-key: " . $userAPIKey,
            "user-id: " . $userID
        ),
    ));
    
    // Pull response data for logs and display
    $response = curl_exec($curl);
    $err = curl_error($curl);
    $respdata = json_decode($response);
    $pretty_resp = json_encode($respdata, JSON_PRETTY_PRINT);
    $errdata = json_decode($err);
    $pretty_err = json_encode($errdata, JSON_PRETTY_PRINT);
    
    echo '<pre>';
    print('Response: ' . $pretty_resp . "\n");
    print('Error: ' . $pretty_err . "\n");
    echo '</pre>';
    
    curl_close($curl);
    
    debug_to_console("Response:");
    debug_to_console($response);
    debug_to_console("Error:");
    debug_to_console($err);

?>
