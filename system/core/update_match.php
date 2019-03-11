<?php
    include('connection.php');
    $id_match=$_GET['id_match'];
    $id_activity=$_GET['id_activity'];
    if(isset($_POST['update-match'])){
        $id_activity_futsal_detail=$_GET['id_activity_futsal_detail'];
        $home=$_POST['home'];
        $away=$_POST['away'];
        $time=$_POST['time'];
        $updatematch = "UPDATE futsal_match SET Home='$home', Away='$away', match_time='$time' WHERE id_match='$id_match'";
        $done = mysqli_query($mysqli, $updatematch) or die(mysqli_error);
        if($done){
            echo "<script>alert('Match updated')</script>";
            echo "<script>window.location='/account/admin/competition.php?id_activity=$id_activity'</script>";
            exit();
        }else{
            echo "<script>alert('Error while save to database, please contact developer.')</script>";
            echo "<script>window.location='/account/admin/competition.php?id_activity=$id_activity'</script>";
            exit();
        }
    }
    if(isset($_POST['update-referee'])){
        $referee1 = $_POST['referee1'];
        $referee2 = $_POST['referee2'];
        if($referee1==$referee2){
            echo "<script>alert('You need to add different referee between referee 1 and referee 2')</script>";
            echo "<script>window.location='/account/admin/competition_match.php?id_match=$id_match&id_activity=$id_activity'</script>";
            exit();
        }
        $updatematch = "UPDATE futsal_match SET id_referee_1='$referee1', id_referee_2='$referee2' WHERE id_match='$id_match'";
        $done = mysqli_query($mysqli, $updatematch) or die(mysqli_error);
        if($done){
            echo "<script>alert('Referee added')</script>";
            echo "<script>window.location='/account/admin/competition_match.php?id_match=$id_match&id_activity=$id_activity'</script>";
            exit();
        }else{
            echo "<script>alert('Error while save to database, please contact developer.')</script>";
            echo "<script>window.location='/account/admin/competition_match.php?id_match=$id_match&id_activity=$id_activity'</script>";
            exit();
        }
    }
?>