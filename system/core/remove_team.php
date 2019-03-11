<?php
    include('connection.php');
    $id_participant = $_GET['id_participant'];
    if(isset($_POST['removeTeam'])){
        $id_team = $_POST['team'];
    }else{
        $id_team = $_GET['id_team'];
    }
    $removeTeam = "DELETE FROM futsal_detail WHERE id_participant='$id_participant' AND id_team='$id_team'";
    $done = mysqli_query($mysqli, $removeTeam) or die(mysqli_error);
    session_start();
    if($done){
        echo "<script>alert('Team removed.')</script>";
        if($_SESSION['akses']=="Public" || $_SESSION['akses']=="Member"){
            echo "<script>window.location='/account/public/my_activity.php'</script>";
        }else{
            echo "<script>window.location='/account/admin/competition.php?id_activity=$id_activity'</script>";
        }
        exit();
    }else{
        if($_SESSION['akses']=="Public" || $_SESSION['akses']=="Member"){
            echo "<script>alert('Error while remove to database, please contact administrator.')</script>";
            echo "<script>window.location='/account/public/my_activity.php'</script>";
        }else{
            echo "<script>alert('Error while remove to database, please contact developer.')</script>";
            echo "<script>window.location='/account/admin/competition.php?id_activity=$id_activity'</script>";
        }
        exit();
    }
?>