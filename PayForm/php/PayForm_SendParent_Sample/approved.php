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
  
  // set variables
  $locationID = $location['ID'];
  $transactionAPIID = $_COOKIE["TransAPIID"];
  $host = $developer['Host'];
  $developerID = $developer['ID'];
  $user_id = $user['ID'];
  $timestamp = time();

  // the RESTful API uses a user_api_key instead of the 
  // user_hash_key required for the PayForm
  $user_api_key = $user['apiKey'];
    
  // query variables required for the Transactions endpoint
  $verb = "GET";
  $endpoint = "/v2/transactions/";
  $query = "?api_id=1&location_id=" . $locationID;

  // Build URL
  $url = $host . $endpoint . $transactionAPIID . $query;

  // ok, let's make the request! cURL is always an option, of course,
  // but i find that file_get_contents is a bit more intuitive.
  $config = [
      "http" => [
          "header" => [
              "developer-id: " . $developerID,
              "user-api-key: " . $user_api_key,
              "user-id: " . $user_id,
              "content-type: application/json",
          ],
          "method" => $verb,
          "ignore_errors" => true // exposes response body on 4XX errors
      ]
  ];
  $context = stream_context_create($config);
  $result = file_get_contents($url, false, $context);
  $response = json_decode($result);
  $httpcode = http_response_code();


?>

<html>
  <h1>Your Transaction Has Been Approved</h1>

  <h2>Response Details</h2>
  <pre><?php print_r($response) ?></pre>

  

</html>