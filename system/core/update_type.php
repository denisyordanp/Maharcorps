<?php
	include('connection.php');
    include('../function.php');
    $id_account=$_GET['id_account'];
    $type=$_POST['type'];
    $updatetype="UPDATE account SET account_user_type='$type' WHERE id_account='$id_account'";
    $done = mysqli_query($mysqli, $updatetype) or die(mysql_error);
    if($done){
        echo "<script>alert('User type updated.')</script>";
        echo "<script>window.location='/account/admin/account.php'</script>";
    }else{
        echo "<script>alert('Error while update to database, please contact developer.')</script>";
        echo "<script>window.location='/account/admin/account.php'</script>";
    }
?>