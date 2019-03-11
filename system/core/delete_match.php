<?php
    include('connection.php');
    $id_match = $_GET['id_match'];
    $id_activity = $_GET['id_activity'];
    $deletematch = "DELETE FROM futsal_match WHERE id_match='$id_match'";
    $done = mysqli_query($mysqli, $deletematch) or die(mysqli_error);
    if($done){
        echo "<script>alert('Match deleted.')</script>";
        echo "<script>window.location='/account/admin/competition.php?id_activity=$id_activity'</script>";
        exit();
    }else{
        echo "<script>alert('Error while remove to database, please contact developer.')</script>";
        echo "<script>window.location='/account/admin/competition.php?id_activity=$id_activity'</script>";
        exit();
    }
?>