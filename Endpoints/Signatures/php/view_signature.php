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
  
    // Developer Sandbox Variables
    $developerId = "[Developer ID]";
    $host = "https://api.sandbox.payaconnect.com";
    
    // User Sandbox Variables
    $userId = "[User ID]";
    $userApiKey = "[User API Key]";
    
    // Signature Endpoint Variables
    $verb = "GET";
    $endpoint = "/v2/signatures";
    $query = "?resource_id=";
    // The signature endpoint will assign the transaction_id
    // value to the resource_id field within the signature endpoint
    $transID = "[Transaction ID]";
    


    // Initialize cURL request
    $url = $host . $endpoint . $query . $transID;
    echo '<pre>';
    print_r('URL: ' . $url);
    echo '</pre>';
    
    // ok, let's make the request! cURL is always an option, of course,
    // but i find that file_get_contents is a bit more intuitive.
    $config = [
        "http" => [
            "header" => [
                "developer-id: " . $developerId,
                "user-api-key: " . $userApiKey,
                "user-id: " . $userId,
                "content-type: application/json",
            ],
            "method" => $verb,
            "ignore_errors" => true // exposes response body on 4XX errors
        ]
    ];

    $context = stream_context_create($config);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result, true);
    $httpcode = http_response_code();

    // Parse the signature data from the response
    $signature = $response['signatures'][0]['signature'];
    
    // Display the API results
    echo '<pre>';
    print_r('HTTP Code: ' . $httpcode);
    echo '</pre>';
    echo '<pre>';
    print_r('API Response:');
    echo '</pre>';
    echo '<pre>';
    print_r($response);
    echo '</pre>';
    echo '<pre>';
    print_r('Signature:');
    echo '</pre>';
    echo '<pre>';
    print_r($signature);
    echo '</pre>';

    // create an image file the permissions "w+" will create the file
    // if it's not present or overwrite an existing file with the same
    // name, please keep that in mind
    $fp = fopen("signature.png", "w+");
    
    // write the data in image file
    fwrite($fp, base64_decode($signature));
    
    // close an open file pointer
    fclose($fp);

    // Display the image from the file that was created
    echo '<pre>';
    print_r('Display Signature:');
    echo '</pre>';
    echo '<img src="signature.png" />';

?>
