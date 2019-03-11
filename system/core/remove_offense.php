<?php
	include('connection.php');
    $id_offense = $_GET['id_offense'];
    $id_activity = $_GET['id_activity'];
    $id_match = $_GET['id_match'];
	$deleteoffense="DELETE FROM match_offense WHERE id_offense='$id_offense'";
    $done = mysqli_query($mysqli, $deleteoffense) or die(mysql_error);
    if($done){
        echo "<script>alert('Offense deleted.')</script>";
        echo "<script>window.location='/account/admin/live_report_match.php?id_activity=$id_activity&id_match=$id_match'</script>";
    }else{
        echo "<script>alert('Error while delete to database, please contact developer.')</script>";
        echo "<script>window.location='/account/admin/live_report_match.php?id_activity=$id_activity&id_match=$id_match'</script>";
    }
?>