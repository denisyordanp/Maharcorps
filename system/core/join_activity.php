<?php
	include('connection.php');
    include('../function.php');
    session_start();
    $id_account = $_SESSION['id_account'];
    $id_activity = $_GET['id_activity'];
    $type = $_GET['activity_type'];
    $date = date('Y-m-d');
    if(cek_join($mysqli, $id_account, $id_activity)==true){
        $id=idparticipant($mysqli);
        $joinactivity="INSERT INTO participant VALUES ('$id','$id_account','$id_activity',0,NULL,'$date')";
        $done = mysqli_query($mysqli, $joinactivity) or die(mysql_error);
        if($done){
            if($type == 'Futsal'){
                echo "<script>alert('You are Joined, please continue to create your Team.')</script>";
            }else{
                echo "<script>alert('You are Joined.')</script>";
            }
            echo "<script>window.location='/account/public/my_activity.php'</script>";
        }else{
            echo "<script>alert('Error while joined, please contact administrator.')</script>";
            echo "<script>window.location='/account/public/my_activity.php'</script>";
        }
    }
?>