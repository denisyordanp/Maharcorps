<?php
    include('connection.php');
    session_start();
    $id_account = $_SESSION['id_account'];
    $email = $_SESSION['email'];
    if(isset($_POST['update-email'])){
        $email = $_POST['email'];
        $checkemail = "SELECT * FROM account WHERE account_email='$email' AND id_account!='$id_account'";
        $emaildata1 = mysqli_query($mysqli,$checkemail);
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if(mysqli_num_rows($emaildata1) >= 1){
                echo "<script>alert('Sorry, this email is used by another account. Please use another email.')</script>";
                echo "<script>window.location='/account/public/verification.php'</script>";
                exit();
            }else{
                $updateemail1="UPDATE account SET account_email='$email' WHERE id_account='$id_account'";
                $done=mysqli_query($mysqli, $updateemail1) or die(mysql_error);
                if ($done) {
                    $_SESSION['email'] = $email;
                    echo"<script>alert('Email has updated, please continue to send verification email.')</script>";
                    echo"<script>window.location='/account/public/verification.php'</script>";
                    exit();
                }
            }
        }else{
            echo "<script>alert('Please enter a valid email address and try again. Thank you.')</script>";
            // echo "<script>window.location='/account/public/verification.php'</script>";
            exit();
        }
    }
    if(isset($_POST['send-verification'])){
        $code = md5($id_account);
        $done = mail($email,"Email Verification","Please click this link to confirm your email www.maharcorps.org/verification.php?id=".$id_account."&code=".$code,"From : service@maharcorps.org");
        if($done){
            echo"<script>alert('Your verification link has been sent, please wait about 1 hour to receive the email.')</script>";
            echo"<script>window.location='/account/public/verification.php'</script>";
            exit();
        }
    }
?>