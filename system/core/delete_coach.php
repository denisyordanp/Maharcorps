<?php
	include('connection.php');
    $id_coach = $_GET['id_coach'];
    $imgpath="../../img/coach/coach_photo_".$id_coach.".jpg";
    if(file_exists($imgpath)){
        if(!unlink($imgpath)){
            echo "<script>alert('Error on delete file, please contact developer.')</script>";
            echo "<script>window.location='/account/admin/my_activity.php'</script>";
            exit();
        }
    }
	$deletecoach="DELETE FROM futsal_coach WHERE id_coach='$id_coach'";
    $done = mysqli_query($mysqli, $deletecoach) or die(mysql_error);
    if($done){
        echo "<script>alert('Coach deleted.')</script>";
        echo "<script>window.location='/account/public/my_activity.php'</script>";
        exit();
    }else{
        echo "<script>alert('Error while delete to database, please contact administrator.')</script>";
        echo "<script>window.location='/account/public/my_activity.php'</script>";
        exit();
    }
?>