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
    
    // HPP Variables
	$id = $hpp['ID'];
    
    // Minimum Request for HPP
    //$req = [
    //	"id" => $id
    //];
    
    // Custom request for HPP.
    $req = [
		"id" => $id,
        "field_configuration" => [
            "body" => [
                "fields" => [
                    [
                        "id" => "transaction_amount",
                        "value" => 1.00,
    		            "label" => "Amount",
    		            "readonly" => true,
    		            "visible" => true
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