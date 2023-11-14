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
    
    // Developer Variables
    $developerID = $developer['ID'];
    $host = $developer['Host'];
    
    // User Variables
    $userID = $user['ID'];
    $userAPIKey = $user['APIKey'];
    
    // Transaction Variables
    $verb = "GET";
    $endpoint = "/custom/contactsso?";
    $timestamp = time();
    
    // Build the request
    $req = [
        "timestamp" => $timestamp,
        "user_id" => $userID,
        "user_api_key" => $userAPIKey,
        "location_id" => $locationID,
        "route" => "virtualterminal",
        "params" =>	[
          "transaction_amount" => "1.00",
          "billing_street" => "123 Main Street",
          "billing_zip" => "31405",
          "order_num" => "SDK Test Invoice " . $timestamp
        ]
    ];
    
    $payload = bin2hex(json_encode($req));
    $url = $host . $endpoint . 'developer-id=' . $developerID . '&data=' . $payload;


?>

<!--Create a page to display the payment link.-->
<style>
    a {
        display:inline-block;
        background-color:#428bca;
        border-color:#357ebd;
        border-radius:5px;
        border-width:0;
        border-style:none;
        color:#ffffff;
        font-size:12px;
        height:30px;
        width:100px;
        margin:0px;
        padding:7px;
        text-decoration:none;
        text-align:center;
    }
</style>

<div>
    <h1>Paya Connect SSO Virtual Terminal</h1>
    <br />
    <!--Build the payment link.-->
    <a href="<?= $url ?>" type="button">Go To Payment Form</a>
</div>
