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
    
    // this is the location ID Contact id is optional
    $location = [
        "ID" => "[Location ID]",
        "ContactID" => "[Contact ID]"
    ];
    
    // User Credentials
    $user = [
        "ID" => "[User ID]",
        "HashKEY" => "[User Hash Key]"
    ];
    
    $developer = [
        "ID" => "[Developer ID]",
        "Host" => "https://api.sandbox.payaconnect.com"
    ];
    
    // Function to display output into the console.
    function debug_to_console( $data ) {
        $output = $data;
        if ( is_array( $output ) )
            $output = implode( ',', $output);
    
        echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
    }
    
?>