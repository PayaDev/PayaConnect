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
    
    // Location Credentials
	// This is provided by the merchant. A test location has been created.
	// You can find your test Location ID under Project Details on the developer portal.
    $location = [
        "ID" => "[Location ID]",
        "ContactID" => "[Contact ID]",
        "ProdTransIDCC" => "[Product Transaction ID for CC Service]",
        "ProdTransIDACH" => "[Product Transaction ID for ACH Service]"
    ];
    
    // User Credentials
	// The integrator may provide a single user account for use with the API. This
	// same user account may then be added to merchants' locations. Otherwise the
	// merchant will need to provide a set of user credentials for use with the API.
	// You can find your test user credentials under API Credentials on the developer portal.
    $user = [
        "ID" => "[User ID]",
        "APIKey" => "[User API Key]",
    ];
    
    // Developer Credentials
	// Your test developer credentials are found under Project Details and API Credentials.
    $developer = [
        "ID" => "[Developer ID]",
        "Host" => "https://api.sandbox.payaconnect.com"
    ];
    
    // Function to write debug information to console.
    function debug_to_console( $data ) {
        $output = $data;
        if ( is_array( $output ) )
            $output = implode( ',', $output);
    
        echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
    }
    

    
?>
