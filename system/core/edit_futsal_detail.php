<?php
    include('connection.php');
    include('../function.php');
    $id_activity = $_GET['id_activity'];
	$system = $_POST['system'];
    $meeting = $_POST['meeting'];
    $location = $_POST['location'];
    $maxteam = $_POST['maxteam'];
    $date=date('Y-m-d');
    $id=idactivityfutsaldetail($mysqli);
    $querryactivityfutsaldetail="SELECT id_activity_futsal_detail, id_activity FROM activity_futsal_detail WHERE id_activity='$id_activity'";
    $cekactivity = mysqli_query($mysqli, $querryactivityfutsaldetail) or die(mysql_error);
    $data=mysqli_fetch_array($cekactivity);
    if($data!=NULL){
        $updatedetailfutsal="UPDATE activity_futsal_detail SET competition_system='$system', technical_meeting_date='$meeting', meeting_location='$location', competition_maxteam='$maxteam' WHERE id_activity='$id_activity'";
        $done = mysqli_query($mysqli, $updatedetailfutsal) or die(mysql_error);
    }else{
        $adddetailfutsal="INSERT INTO activity_futsal_detail VALUES ('$id','$id_activity','$system','$meeting','$location','$maxteam','$date')";
        $done = mysqli_query($mysqli, $adddetailfutsal) or die(mysql_error);
    }
    if($done){
        echo "<script>alert('Detail updated.')</script>";
        echo "<script>window.location='/account/admin/competition.php?id_activity=$id_activity'</script>";
    }else{
        echo "<script>alert('Error while update to database, please contact developer.')</script>";
        echo "<script>window.location='/account/admin/competition.php?id_activity=$id_activity'</script>";
    }
?>