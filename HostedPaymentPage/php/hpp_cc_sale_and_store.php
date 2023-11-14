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
    
	// HPP Variables
    $id = $hpp['ID'];
	$contact_id = "[Contact ID]"; // This will be listed within Contacts under the location.
    
    // Custom request for HPP.
	// This request includes the option to store the card into the vault.
    $req = [
		"id" => $id,
        "field_configuration" => [
            "body" => [
                "fields" => [
                    [
                        "id" => "transaction_amount",
                        "value" => 7.00,
    		            "label" => "Amount",
    		            "readonly" => true,
    		            "visible" => true
		            ],
                    [
                        "id" => "contact_id",
                        "value" => $contact_id, // Required to add account data to the vault.
                        "visible" => false
                    ],
                    [
                        "id" => "save_account",
                        "value" => true, // Must be set to "true" in order to vault the account.
                        "visible" => false
                    ],
                    [
                        "id" => "save_account_title", // Optional, if not included it will record without an account title.
                        "value" => "SDK Primary Card",
                        "visible" => false
                    ]
                ]
            ]
        ],
        "redirect_url_on_approve" => "https://google.com",
		"redirect_url_on_decline" => "https://google.com"
    ];
    
    // Encrypt request for transport
 	$sReq = json_encode($req);
 	$data = getEncodedData($sReq, $hpp['KEY']);
    
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
    <h1>Paya Connect Hosted Payment Page</h1>
    <br />
    <!--Build the payment link.-->
    <a href="https://api.sandbox.payaconnect.com/hostedpaymentpage?id=<?= $id ?>&data=<?= $data ?>" type="button">Pay Now</a>
</div>
