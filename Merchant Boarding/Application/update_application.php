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
  
  // Used to update an application using the Application ID.
  // More details on this request can be found at 
  // https://docs.payaconnect.com/developers/boarding-api-integration-application/boarding-api-endpoint-actions#updatemissingkeyvalues
  
  //!!!!!!!!!!!!!!!!WARNING!!!!!!!!!!!!!!!!!!!!!
  // All fields must be resubmitted with correct
  // values. Any fields left blank will erase
  // existing input.
  //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

  // Build full endpoint URL
  $host = "https://boarding.sandbox.payaconnect.com";
  $endpoint = "/v1/application/";
  $applicationId = "[Application ID]";
  $url = $host . $endpoint . $applicationId;
  $verb = "PUT";

  // Developer/Integration User Credentials
  $developerid = "[Developer ID]";
  $userid = "[User ID]";
  $userAPIKey = "[User API Key]";
  
  // Build Payload
  $payload = file_get_contents('update_application.json');
  
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