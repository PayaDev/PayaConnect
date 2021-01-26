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
  
  // Used to submit an application using the Offer ID.
  // More details on this request can be found at 
  // https://docs.payaconnect.com/developers/boarding-api-integration-application/boarding-api-endpoint-actions#createanapplication

  // Build full endpoint URL
  $host = "https://boarding.sandbox.payaconnect.com";
  $endpoint = "/v1/application";
  $url = $host . $endpoint;
  $verb = "POST";

  // Developer/Integration User Credentials
  $developerid = "[Developer ID]";
  $userid = "[User ID]";
  $boardinguserid = "[Boarding User ID]"; // In the sandbox this may be the same as the offer id
  $userAPIKey = "[User API Key]";
  
  // Build Payload
  $request = file_get_contents('create_application.json');
  $payload = str_replace("@boardingUserId",$boardinguserid,$request);
  
  // Set headers and connection details
  $config = [
  "http" => [
      "header" => [
          "content-type: application/json",
          "developer-id: " . $developerid,
          "user-id: " . $userid,
          "user-api-key: " . $userAPIKey
      ],
      "method" => $verb,
      "content" => $payload,
      "ignore_errors" => false // exposes response body on 4XX errors
    ]
  ];
  
  // Submit the request
  $context = stream_context_create($config);
  $result = file_get_contents($url, false, $context);
  $response = json_decode($result);
  $httpcode = $http_response_header[0];
  
  // Display the results
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