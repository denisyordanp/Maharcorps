<?php
    error_reporting(-1);
    ini_set('display_errors', 'On');
    set_error_handler("var_dump");
    $from = "service@maharcorps.org";    
    $to = "denis240196@gmail.com";    
    $subject = "Reset password";    
    $message = "Testing";   
    $headers = "From: ". $from;       
    mail($to,$subject,$message);
?>