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
    
    // set variable
    $locationID = $location['ID'];
    $contactID = $location['ContactID'];
    
    $host = $developer['Host'];
    $developerID = $developer['ID'];
    
    // Define the secret hash_key used for hashing the variables
    $user_hash_key = $user['HashKEY'];
     
    // Define variables for generating the required hash
    $user_id = $user['ID'];
    $timestamp = time();
    
    
    // Generate the secure hash, making sure the variables
    // are in the proper sequence.
    $data = $user_id . $timestamp;
    $hash_key = hash_hmac('sha256', $data, $user_hash_key);

    // set *api_id
    $acctVaultAPIID = "SDK" . $timestamp;
    
    // Create Request
    $req = [
        "transaction" => [
            "payment_method" => "cc", // Required field
            "action" => "authonly",
            "transaction_amount" => "1.00",
            "location_id" => $locationID,  // Required field
            "contact_id" => $contactID, // optional, but recommended
            "transaction_api_id" => $acctVaultAPIID,
            //"account_vault_api_id" => $acctVaultAPIID,  // Required field
            "account_holder_name" => "john smith",
            "billing_street" => "123 Main St",
            "billing_zip" => "31405",
            "entry_method" => "manual",
            "show_account_holder_name" => true,
            "show_street" => true,
            "show_zip" => true,
            "send_parent_message" => 1,
            "parent_close" => 0,
            "parent_close_delay" => 1,
            "parent_origin" => null,
            "display_close_button" => true,
            "save_account" => 1,
            "save_account_title" => "sdk payform test"
        ]
    ];
    
    // Hex encode the request data
    $hexReq = bin2hex(json_encode($req));
    
    // Build URL (URL + Developer ID + Hash Key + User ID + Timestamp + Hex-encoded Request Data)
    $url = $host . "/v2/payform?developer-id=" . $developerID . "&hash-key=" . $hash_key . "&user-id=" . $user_id . "&timestamp=" . $timestamp . "&data=" . $hexReq;
    
    debug_to_console($url);
    
?>
<html>
    <head>    
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
        
        <!-- Add this script tag prior to embedding the iFrame -->
        <script>
            window.addEventListener("message", receiveMessage, false);
            
            function receiveMessage(event) {
              // Make sure the value for allowed matches the domain of the iFrame you are embedding.
              var allowed = "https://api.sandbox.payaconnect.com";
              // Verify sender's identity
              if (event.origin !== allowed) return;
            
              // Add logic here for doing something in response to the message
              console.log(event); // for example only, log event object
              console.log(JSON.parse(event.data)); // for example only, log JSON data
              
              // Write Response from Account Form to Parent Page
			  document.getElementById("form_response").innerHTML = JSON.stringify(event.data);
			}
        </script>
        
    </head>
    <body>
    
        <div>
            <h1>Paya Connect Payment Form</h1>
            <br />
            <!-- <a href="<?= $url ?>" type="button">Pay Now</a> -->
        </div>
        
        
        
        <!-- include the iframe after the script tag for the event listener -->
        <iframe src="<?= $url ?>" width="400px" height="500px"></iframe>
        
        <div>
			<h1>Response</h1>
			<p id="form_response"></p>
		</div>
    </body>
</html>



