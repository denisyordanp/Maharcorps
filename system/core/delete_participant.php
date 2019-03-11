<?php
	include('connection.php');
    include('../function.php');
    $id_participant = $_GET['id_participant'];
    $id_activity = $_GET['id_activity'];
    $id_account = $_GET['id_account'];
    $deleteparticipant="DELETE FROM participant WHERE id_participant='$id_participant'";
    $done = mysqli_query($mysqli, $deleteparticipant) or die(mysql_error);
    if($done){
        echo "<script>alert('Participant deleted.')</script>";
        echo "<script>window.location='/account/admin/participant.php?id_activity=$id_activity'</script>";
    }else{
        echo "<script>alert('Error while delete to database, please contact developer.')</script>";
        echo "<script>window.location='/account/admin/participant.php?id_activity=$id_activity'</script>";
    }
?>