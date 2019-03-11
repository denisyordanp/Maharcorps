<?php
	include('connection.php');
    include('../function.php');
    $id_activity = $_GET['id_activity'];
	$name = $_POST['name'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $desc = $_POST['desc'];
    $status = $_POST['status'];
    $type = $_POST['type'];
    if($type=="General"){
        $timestart = $_POST['timestart'];
        $timeend = $_POST['timeend'];
        $datestart = $_POST['datestart2'];
        $dateend = $_POST['dateend'];
        $date1 = $datestart.' '.$timestart;
        $date2 = $dateend.' '.$timeend;
    }else{
        $timestart = "00:00:00";
        $datestart = $_POST['datestart1'];
        $date1 = $datestart.' '.$timestart;
        $date2 = NULL;
    }
    $location = $_POST['location'];
    $fee = $_POST['fee'];
	$updateactivity="UPDATE activity SET activity_name='$name',activity_registration_start='$start',activity_registration_end='$end',activity_date='$date1',activity_end='$date2', activity_description='$desc',activity_status='$status',activity_type='$type',activity_location='$location', activity_fee='$fee' WHERE id_activity='$id_activity'";
    $done = mysqli_query($mysqli, $updateactivity) or die(mysql_error);
    if($done){
        echo "<script>alert('Activity updated.')</script>";
        echo "<script>window.location='/account/admin/activity.php'</script>";
    }else{
        echo "<script>alert('Error while update to database, please contact developer.')</script>";
        echo "<script>window.location='/account/admin/activity.php'</script>";
    }
?>