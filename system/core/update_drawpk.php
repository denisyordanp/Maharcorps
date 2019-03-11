<?php
    include('connection.php');
    $id_match=$_GET['id_match'];
    $id_activity=$_GET['id_activity'];
    $id=$id_match.'1';
    $h1=$_POST['h1'];
    $h2=$_POST['h2'];
    $h3=$_POST['h3'];
    $h4=$_POST['h4'];
    $a1=$_POST['a1'];
    $a2=$_POST['a2'];
    $a3=$_POST['a3'];
    $a4=$_POST['a4'];
    $cekpk="SELECT * FROM match_drawpk WHERE id_match_drawpk='$id'";
    $check = mysqli_query($mysqli, $cekpk) or die(mysqli_error);
    $rows=mysqli_num_rows($check);
    if($rows==NULL){
        $updatepk = "INSERT INTO match_drawpk VALUES('$id','$id_match','$h1','$h2','$h3','$h4','$a1','$a2','$a3','$a4')";
    }else{
        $updatepk = "UPDATE match_drawpk SET h1='$h1',h2='$h2',h3='$h3',h4='$h4',a1='$a1',a2='$a2',a3='$a3',a4='$a4'";
    }
    $done = mysqli_query($mysqli, $updatepk) or die(mysqli_error);
    if($done){
        echo "<script>alert('Draw-PK updated')</script>";
        echo "<script>window.location='/account/admin/competition_match.php?id_activity=$id_activity&id_match=$id_match'</script>";
    }else{
        echo "<script>alert('Error while save to database, please contact developer.')</script>";
        echo "<script>window.location='/account/admin/competition_match.php?id_activity=$id_activity&id_match=$id_match'</script>";
    }
?>