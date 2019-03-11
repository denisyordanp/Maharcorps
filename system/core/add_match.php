<?php
    include('connection.php');
    include('../function.php');
    $id_detail=$_GET['id_activity_futsal_detail'];
    $id_activity=$_GET['id_activity'];
    $date=date('Y-m-d');
    $id=idmatch($mysqli);
    $home=$_POST['home'];
    $away=$_POST['away'];
    if($home==$away){
        echo "<script>alert('You cant add same team on one match.')</script>";
        echo "<script>window.location='/account/admin/competition.php?id_activity=$id_activity'</script>";
        exit();
    }
    if(isset($_POST['add-match'])){
        $addmatch = "INSERT INTO futsal_match VALUES ('$id', '$id_detail', '$home', '$away', NULL, NULL, NULL, NULL, '$date')";
        $done = mysqli_query($mysqli, $addmatch) or die(mysqli_error);
        if($done){
            echo "<script>window.location='/account/admin/competition.php?id_activity=$id_activity'</script>";
        }else{
            echo "<script>alert('Error while save to database, please contact developer.')</script>";
            echo "<script>window.location='/account/admin/competition.php?id_activity=$id_activity'</script>";
        }
    }
?>