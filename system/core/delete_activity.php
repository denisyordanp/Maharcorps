<?php
	include('connection.php');
    include('../function.php');
    $id_activity = $_GET['id_activity'];
    $imgpath="../../img/activity/activity_".$id_activity.".jpg";
    if(file_exists($imgpath)){
        if(!unlink($imgpath)){
            echo "<script>alert('Error on delete file, please contact developer.')</script>";
            echo "<script>window.location='/account/admin/activity.php'</script>";
            exit();
        }
    }
	$deleteactivity="DELETE FROM activity where id_activity='$id_activity'";
    $done = mysqli_query($mysqli, $deleteactivity) or die(mysql_error);
    if($done){
        echo "<script>alert('Activity deleted.')</script>";
        echo "<script>window.location='/account/admin/activity.php'</script>";
    }else{
        echo "<script>alert('Error while delete to database, please contact developer.')</script>";
        echo "<script>window.location='/account/admin/activity.php'</script>";
    }
?>