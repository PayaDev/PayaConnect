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

    // Location Variables
    $locationID = "[Location ID]";
    $terminalID = "[Terminal ID]";
    
    // Developer Variables
    $developerID = "[Developer ID]";
    
    // Connection Variables
    $host = "https://api.sandbox.payaconnect.com";
    $endpoint = "/v2/routertransactions";
    
    // User Variables
    $userID = "[User ID]";
    $userAPIKey = "[User API Key]";
    
    // Transaction Variables
    $verb = "POST";
    $timestamp = time();
    
    // Build the request
    $req = [
      "routertransaction"=> [
        "action"=> "sale",
        "payment_method"=> "cc",
        "location_id"=> $locationID,
        "terminal_id"=> $terminalID,
        "transaction_amount"=> "7.00",
        "order_num"=> "SDKTest" . $timestamp,
        ]
    ];
    
    $payload = json_encode($req);

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
        "content" => $payload,
        "ignore_errors" => true // exposes response body on 4XX errors
      ]
    ];

    $context = stream_context_create($config);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result);
    $httpcode = http_response_code();
    
    echo '<pre>';
    print_r('HTTP Code: ' . $httpcode);
    echo '</pre>';
    echo '<pre>';
    print_r('API Response:');
    echo '</pre>';
    echo '<pre>';
    print_r($response);
    echo '</pre>';


?>
