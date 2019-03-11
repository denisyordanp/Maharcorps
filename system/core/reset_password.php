<?php
    include('connection.php');
    include('../function.php');
    $id_account = $_GET['id_account'];
    $new=random();
    $encr=md5($new);  
    $to = $_GET['email'];
    $subject = "Reset passwrod";
    $message = "Your password has been reseted by admin, new password is ".$new.". Please login to www.maharcorps.org/account.php and immediately change your password on profil tab. Thank you.";
    $headers = "From: service@maharcorps.org";
    $reset="UPDATE account SET account_password='$encr' WHERE id_account='$id_account'";
    $done = mysqli_query($mysqli, $reset) or die(mysql_error);
    $sent = mail($to,$subject,$message,$headers);
    if($done && $sent){
        echo "<script>alert('Password reseted and new password has been sent to user email.')</script>";
        echo "<script>window.location='/account/admin/account.php'</script>";
    }else{
        echo "<script>alert('Error while update to database, please contact developer.')</script>";
        echo "<script>window.location='/account/admin/account.php'</script>";
    }
?>