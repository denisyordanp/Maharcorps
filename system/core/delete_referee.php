<?php
	include('connection.php');
    $id_referee = $_GET['id_referee'];
    $imgpath1="../../img/referee/referee_photo_".$id_referee.".jpg";
    $imgpath2="../../img/referee/req/referee_req_".$id_referee.".jpg";
    if(file_exists($imgpath1)){
        if(!unlink($imgpath1)){
            echo "<script>alert('Error on delete photo, please contact developer.')</script>";
            echo "<script>window.location='/account/admin/futsal_referee.php'</script>";
            exit();
        }
    }
    if(file_exists($imgpath2)){
        if(!unlink($imgpath2)){
            echo "<script>alert('Error on delete photo, please contact developer.')</script>";
            echo "<script>window.location='/account/admin/futsal_referee.php'</script>";
            exit();
        }
    }
	$deletereferee="DELETE FROM futsal_referee WHERE id_referee='$id_referee'";
    $done = mysqli_query($mysqli, $deletereferee) or die(mysql_error);
    if($done){
        echo "<script>alert('Referee deleted.')</script>";
        echo "<script>window.location='/account/admin/futsal_referee.php'</script>";
        exit();
    }else{
        echo "<script>alert('Error while delete to database, please contact developer.')</script>";
        echo "<script>window.location='/account/admin/futsal_referee.php'</script>";
        exit();
    }
?>