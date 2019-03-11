<?php
    include('connection.php');
    include('../function.php');
    $id_match=$_GET['id_match'];
    $id_activity=$_GET['id_activity'];
    $goal=$_POST['goal'];
    $assist=$_POST['assist'];
    $category=$_POST['category'];
    $time=$_POST['time'];
    $date=date('Y-m-d');
    $id=idgoal($mysqli);
    if($assist==NULL){
        $addgoal = "INSERT INTO match_goal VALUES ('$id', '$id_match', '$goal', NULL, '$category', '$time', '$date')";
    }else{
        $addgoal = "INSERT INTO match_goal VALUES ('$id', '$id_match', '$goal', '$assist', '$category', '$time', '$date')";
    }
    $done = mysqli_query($mysqli, $addgoal) or die(mysqli_error);
    if($done){
        echo "<script>window.location='/account/admin/competition_match.php?id_activity=$id_activity&id_match=$id_match'</script>";
    }else{
        echo "<script>alert('Error while save to database, please contact developer.')</script>";
        echo "<script>window.location='/account/admin/competition_match.php?id_activity=$id_activity&id_match=$id_match'</script>";
    }
?>