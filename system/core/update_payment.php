<?php
	include('connection.php');
    include('../function.php');
    $page=$_GET['page'];
    $id_participant=$_GET['id_participant'];
    $id_activity=$_GET['id_activity'];
    $email=$_GET['email'];
    $activity=$_GET['activity'];
    $payment=$_POST['payment'];
    if($payment=="Rejected"){
        $updatepayment="UPDATE participant SET participant_payment_status='0', payment_status_img='$payment' WHERE id_participant='$id_participant'";
        $msg = "Sorry your payment for ".$activity." activity are rejected, please contact administrator for more information. Thank you.";
    }elseif($payment=="1"){
        $updatepayment="UPDATE participant SET participant_payment_status='$payment' WHERE id_participant='$id_participant'";
        $msg = "Congratulation your payment for ".$activity." activity are complete. Thank you.";
    }else{
        $updatepayment="UPDATE participant SET participant_payment_status='$payment' WHERE id_participant='$id_participant'";
    }
    $done = mysqli_query($mysqli, $updatepayment) or die(mysql_error);
    if($done){
        if($payment!="0"){
            mail($email,"Payment status",$msg,"From : service@maharcorps.org");
        }
        echo "<script>alert('Payment status updated.')</script>";
        if($page=="payment"){
            echo "<script>window.location='/account/admin/payment_status.php?id_activity=$id_activity'</script>";
        }else{
            echo "<script>window.location='/account/admin/participant.php?id_activity=$id_activity'</script>";
        }
    }else{
        echo "<script>alert('Error while update to database, please contact developer.')</script>";
        echo "<script>window.location='/account/admin/participant.php?id_activity=$id_activity'</script>";
    }
?>