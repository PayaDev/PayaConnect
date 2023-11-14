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
  
  // set variables
  $locationID = $location['ID'];
  $acctVaultAPIID = $_COOKIE["acctVaultAPIID"];
  $host = $developer['Host'];
  $developerID = $developer['ID'];
  $user_id = $user['ID'];
  $timestamp = time();

  // the RESTful API uses a user_api_key instead of the 
  // user_hash_key required for the accountform
  $user_api_key = $user['apiKey'];
    
  // query variables required for the accountvaults endpoint
  $verb = "GET";
  $endpoint = "/v2/accountvaults/";
  $query = "?api_id=1&location_id=" . $locationID;

  // Build URL
  $url = $host . $endpoint . $acctVaultAPIID . $query;
  echo $acctVaultAPIID;
  echo $url; 

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
  <h1>Your Account Has Been Successfully Stored</h1>

  <h2>Response Details</h2>
  <pre><?php print_r($response) ?></pre>

  

</html>
