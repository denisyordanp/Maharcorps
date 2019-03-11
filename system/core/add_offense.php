<?php
    include('connection.php');
    include('../function.php');
    $id_match=$_GET['id_match'];
    $id_activity=$_GET['id_activity'];
    $offense=$_POST['offense'];
    $card=$_POST['card'];
    $category=$_POST['category'];
    $time=$_POST['time'];
    $date=date('Y-m-d');
    $id=idoffense($mysqli);
    if($card==NULL){
        $addoffense = "INSERT INTO match_offense VALUES ('$id', '$id_match', '$offense', NULL, '$category', '$time', '$date')";
    }else{
        $addoffense = "INSERT INTO match_offense VALUES ('$id', '$id_match', '$offense', '$card', '$category', '$time', '$date')";
    }
    $done = mysqli_query($mysqli, $addoffense) or die(mysqli_error);
    if($done){
        echo "<script>window.location='/account/admin/competition_match.php?id_activity=$id_activity&id_match=$id_match'</script>";
    }else{
        echo "<script>alert('Error while save to database, please contact developer.')</script>";
        echo "<script>window.location='/account/admin/competition_match.php?id_activity=$id_activity&id_match=$id_match'</script>";
    }
?>