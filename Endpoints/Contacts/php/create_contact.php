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
  
  // Used to create a contact in Paya Connect.
  // More details on this request can be found at 
  // https://docs.payaconnect.com/developers/api/endpoints/contacts

  // Build full endpoint URL
  $host = "https://api.sandbox.payaconnect.com";
  $endpoint = "/v2/contacts";
  $url = $host . $endpoint;
  $verb = "POST";

  // Build request variables
  $contactAPIId = "contact" . time(); // see notes on API docs for additional information about this variable  https://docs.payaconnect.com/developers/api/endpoints/contacts#fields

  // Developer/Integration User Credentials
  $developerid = "[Developer ID]";
  $userid = "[User ID]";
  $userAPIKey = "[User API Key]";
  
  // Build Payload
  $request = file_get_contents('contactspayload.json');
  $payload = str_replace("@contactAPIId",$contactAPIId,$request);
  
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
