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

    require('shared.php');
    
    // Developer Variables
    $developerID = $developer['ID'];
    $host = $developer['Host'];
    
    // User Variables
    $userID = $user['ID'];
    $userAPIKey = $user['APIKey'];
    
    // Endpoint Variables
    $verb = "POST";
	  $endpoint = "/v2/transactionlevel3s";
    
    // Build the request
    $req = file_get_contents("request_lvl3.json");
    $transactionID = "[Transaction ID]";
    $req = str_replace('@transactionID', $transactionID, $req);
    echo $req;
    
    //$payload = json_encode($req);
    
    // file_get_contents to submit the POST. cURL may be used as well.
    $url = $host . $endpoint;
    $config = [
    "http" => [
        "header" => [
            "developer-id: " . $developerID,
            "user-api-key: " . $userAPIKey,
            "user-id: " . $userID,
            "content-type: application/json",
        ],
        "method" => $verb,
        "content" => $req,
        "ignore_errors" => true // exposes response body on 4XX errors
      ]
    ];

    $context = stream_context_create($config);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result);
    $httpcode = http_response_code();
    
    // Pull response data for logs and display
    $pretty_resp = json_encode($response, JSON_PRETTY_PRINT);
    
    echo '<pre>';
    print('Response: ' . $pretty_resp . "\n");
    echo '</pre>';
    
    debug_to_console("Response:");
    debug_to_console($response);
    debug_to_console("Error:");
    debug_to_console($err);

?>
