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
    $contactID = $location['ContactID'];
    $host = $developer['Host'];
    $developerID = $developer['ID'];
    
    // set variables for generating the required hash
    $user_id = $user['ID'];
    $user_hash_key = $user['HashKEY'];
    $timestamp = time();
    
    // Generate the secure hash, making sure the variables
    // are in the proper sequence.
    $data = $user_id . $timestamp;
    $hash_key = hash_hmac('sha256', $data, $user_hash_key);

    // set *api_id
    $transactionAPIID = "SDK" . $timestamp;
    
    // Create Request
    $req = [
        "transaction" => [
            "payment_method" => "cc",
            "action" => "sale",
            "transaction_amount" => "7.00",
            "location_id" => $locationID,
            "contact_id" => $contactID,
            "transaction_api_id" => $transactionAPIID,
            "surcharge_amount" => "0.01",
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
            "save_account_title" => "sdk payform test",
            "redirect_url_on_approval" => "[HOST]/approved.php",
            "redirect_url_on_decline" => "[HOST]/declined.php",
            "redirect_url_delay" => 0,
            "description" => "SDK Test PayForm Redirect"
        ]
    ];
    
    // Hex encode the request data
    $hexReq = bin2hex(json_encode($req));
    
    // Build URL (URL + Developer ID + Hash Key + User ID + Timestamp + Hex-encoded Request Data)
    $url = $host . "/v2/payform?developer-id=" . $developerID . "&hash-key=" . $hash_key . "&user-id=" . $user_id . "&timestamp=" . $timestamp . "&data=" . $hexReq;


    // create and set cookie to send the transaction_api_id
    // to the approved page to GET transaction details for display
    setcookie("TransAPIID", $transactionAPIID);
    
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
              
              // Write Response from PayForm to Parent Page
			        //document.getElementById("form_response").innerHTML //= JSON.stringify(event.data);

              // Write Response from PayForm to Parent Page
			        var response = document.getElementById("form_response");
              var obj = JSON.parse(event.data);
              response.innerHTML = JSON.stringify(obj, undefined, 2);
			      }
        </script>
        
    </head>
    <body>
    
        <div>
            <h1>Paya Connect Payment Form</h1>
            <br />
        </div>
        
        
        
        <!-- include the iframe after the script tag for the event listener -->
        <iframe src="<?= $url ?>" width="400px" height="500px"></iframe>
        
        <div>
          <h1>Parent Page Response</h1>
          <pre id="form_response"></pre>
        </div>


    </body>
</html>



