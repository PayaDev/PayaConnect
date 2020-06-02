<?php

/*----------------------------------------------
Author: SDK Support Group
Company: Paya
Contact: sdksupport@paya.com
!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
!!! Samples intended for educational use only!!!
!!!        Not intended for production       !!!
!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
-----------------------------------------------*/    

    require('shared.php');
    
    // Location Variables
    $locationID = $location['ID'];
    $contactID = $location['ContactID'];
    $CCprodTransID = $location['ProdTransIDCC'];
    $ACHprodTransID = $location['ProdTransIDACH'];
    
    // Developer Variables
    $developerID = $developer['ID'];
    $host = $developer['Host'];
    
    // User Variables
    $userID = $user['ID'];
    $userAPIKey = $user['APIKey'];
    
    // Transaction Variables
    $verb = "POST";
    $endpoint = "/v2/quickinvoices";
    
    // Build the request
    $req = [
        "quickinvoice" => [
            // Required Fields
            "title" => "API Invoice",
            "due_date" => "2020-05-07", //YYYY-MM-DD
            "item_list" => [
                "API Resource" => 3,
                "SDK Service" => 4,
                "Consulting Fee" => 39.99
            ],
            "location_id" => $locationID,
            "cc_product_transaction_id" => $CCprodTransID,
            "ach_product_transaction_id" => $ACHprodTransID,
            "invoice_number" => "Invoice " . time(),
            // Conditional Fields - Use if you want the invoice to be sent immediately via email.
            "email" => "[email address]",
            "contact_id" => $contactID,
            "send_email" => 1,
            "notification_days_before_due_date" => 0,
            "notification_on_due_date" => 0,
        ]
    ];

    $payload = json_encode($req);
    $url = $host . $endpoint;
    
    // ok, let's make the request! cURL is always an option, of course,
    // but i find that file_get_contents is a bit more intuitive.
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
    print_r('URL: ' . $url);
    echo '</pre>';
    echo '<pre>';
    print_r('Request:');
    echo '</pre>';
    echo '<pre>';
    print_r($req);
    echo '</pre>';
    echo '<pre>';
    print_r('HTTP Code: ' . $httpcode);
    echo '</pre>';
    echo '<pre>';
    print_r('API Response:');
    echo '</pre>';
    echo '<pre>';
    print_r($response);
    echo '</pre>';
    
    // Pull response data for logs and display
    $pretty_resp = json_encode($response, JSON_PRETTY_PRINT);
    $errdata = json_decode($err);
    $pretty_err = json_encode($errdata, JSON_PRETTY_PRINT);
    
    echo '<pre>';
    print('Response: ' . $pretty_resp . "\n");
    print('Error: ' . $pretty_err . "\n");
    echo '</pre>';
    
    debug_to_console("Response:");
    debug_to_console($response);
    debug_to_console("Error:");
    debug_to_console($err);

?>