<?php
	include('connection.php');
    include('../function.php');
    $id_account = $_GET['id_account'];
    $imgpath="../../img/account/account_".$id_account.".jpg";
    if(file_exists($imgpath)){
        if(!unlink($imgpath)){
            echo "<script>alert('Error on delete file, please contact developer.')</script>";
            echo "<script>window.location='/account/admin/account.php'</script>";
            exit();
        }
    }
	$deleteaccount="DELETE FROM account WHERE id_account='$id_account'";
    $done = mysqli_query($mysqli, $deleteaccount) or die(mysql_error);
    if($done){
        
        echo "<script>alert('Account deleted.')</script>";
        echo "<script>window.location='/account/admin/account.php'</script>";
    }else{
        echo "<script>alert('Error while delete to database, please contact developer.')</script>";
        echo "<script>window.location='/account/admin/account.php'</script>";
    }
?>