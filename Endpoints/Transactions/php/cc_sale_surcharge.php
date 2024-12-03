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
    
    // Location Variables
    $locationID = $location['ID'];
    $contactID = "[Contact ID]"; // This will be listed within Contacts under the location.
    $prodTransID = "[Product Transaction ID]"; // This is listed as a service under the location.
    
    // Developer Variables
    $developerID = $developer['ID'];
    $host = $developer['Host'];
    
    // User Variables
    $userID = $user['ID'];
    $userAPIKey = $user['APIKey'];
    
    // Transaction Variables
    $verb = "POST";
	$endpoint = "/v2/transactions";
    
    // Build the request
    $req = [
        "transaction" => [
            // Required Fields
            "action" => "sale",
            "payment_method" => "cc",
            "location_id" => $locationID,
            "subotal_amount" => "100.00",
            "surcharge_amount" => "3.00",
            "transaction_amount" => "103.00",
            // Required to specify funding service.
            "product_transaction_id" => $prodTransID,
            "order_num" => "Invoice" . time(), // Should be unique per transaction to prevent duplicate charges.
            
            // Required (conditional) Fields
            "account_number" => "5454545454545454", // Required if no vault token is present.
            "exp_date" => "1221", // Required if no vault token is present. 
            
            // Recommended Optional Fields
            "cvv" => "123", // Recommended for Card Not Present transactions.
            "account_holder_name" => "SDK Test",
            "billing_street" => "123 Main St", // Recommended for Card Not Present transactions.
            "billing_city" => "Savannah",
            "billing_state" => "GA",
            "billing_zip" => "31405", // Recommended for Card Not Present transactions.
            "billing_phone" => "8005555555",
            "description" => "SDK Support CC Sale",
            "contact_id" => $contactID // Include to connect transaction to a specific contact.
        ]
    ];
    
    $payload = json_encode($req);
    
    // cURL to submit the POST.
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
        CURLOPT_POSTFIELDS => $payload,
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
