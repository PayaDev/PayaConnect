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
  
  // Used to add integration roles for integrations users ONLY with Paya Connect APIs.
  // Additional location users must be createed in the Paya Connect UI.
  // More details on this request can be found at 
  // https://docs.payaconnect.com/developers/api/endpoints/authroleusers
  // review the README.md file for additional information about configuration

  // Build full endpoint URL
  $host = "https://api.sandbox.payaconnect.com";
  $endpoint = "/v2/authroleusers";
  $url = $host . $endpoint;
  $verb = "POST";

  // Developer/Integration User Credentials
  $developerid = [DeveloperId];
  $userid = [Partner Global Integration User];
  $userAPIKey = [Partner Global integration User API Key]];
  
  // Build Payload
  $request = file_get_contents('integrationuserauthrole.json');
  
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
      "content" => $request,
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
