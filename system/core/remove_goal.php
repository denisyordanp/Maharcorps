<?php
	include('connection.php');
    $id_match_goal = $_GET['id_match_goal'];
    $id_activity = $_GET['id_activity'];
    $id_match = $_GET['id_match'];
	$deletegoal="DELETE FROM match_goal WHERE id_match_goal='$id_match_goal'";
    $done = mysqli_query($mysqli, $deletegoal) or die(mysql_error);
    if($done){
        echo "<script>alert('Goal deleted.')</script>";
        echo "<script>window.location='/account/admin/live_report_match.php?id_activity=$id_activity&id_match=$id_match'</script>";
    }else{
        echo "<script>alert('Error while delete to database, please contact developer.')</script>";
        echo "<script>window.location='/account/admin/live_report_match.php?id_activity=$id_activity&id_match=$id_match'</script>";
    }
?>