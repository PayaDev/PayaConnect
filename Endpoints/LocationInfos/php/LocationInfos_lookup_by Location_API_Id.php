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
  
  // Used to GET information about a location based
  // on Location API ID this will need to be provided to
  // Paya Connect as part of the location general information.

  // More details on this request can be found at 
  // https://docs.payaconnect.com/developers/api/endpoints/locationinfos

  // Additional filters can be applied to supply only the product 
  // transaction ids on the account and their common name [title] by
  // adding additional $query "?field=value&field2=value2..."  

  // Build full endpoint URL
  $host = "https://api.sandbox.payaconnect.com";
  $endpoint = "/v2/locationinfos";
  $query = "?location_api_id=[location-api-id]";
  $url = $host . $endpoint . $query;
  $verb = "GET";

  // Developer/Integration User Credentials
  $developerid = "[Developer_id]";
  $userid = "[User_id]";
  $userAPIKey = "[User_API_id]";
  
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
