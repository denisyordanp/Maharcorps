<?php
    include('connection.php');
    include('../function.php');
    $id_detail=$_GET['id_activity_futsal_detail'];
    $id_activity=$_GET['id_activity'];
    $date=date('Y-m-d');
    $field=$_POST['field'];
    $datematch=$_POST['date'];
    $range=$_POST['range'];
    $start=$_POST['start'];
    $end=$_POST['end'];
    $nulltime = "SELECT * FROM futsal_match WHERE match_time IS NULL AND id_activity_futsal_detail='$id_detail'";
    $null = mysqli_query($mysqli, $nulltime) or die(mysqli_error);
    $matchtime=date('Y-m-d H:i:s',strtotime($datematch.' '.$start));
    $a=0;
    $b=1;
    while($time=mysqli_fetch_array($null)){
        if(date('H:i',strtotime(matchadd($matchtime,$range)))>$end){
            echo "<script>alert('Succesfully generated $a match')</script>";
            echo "<script>window.location='/account/admin/competition.php?id_activity=$id_activity'</script>";
            exit();
        }else{
            $id_match=$time['id_match'];
            $done="UPDATE futsal_match SET match_time='$matchtime', match_field='$b' WHERE id_match='$id_match'; ";
            mysqli_query($mysqli, $done);
            $a++;
            if($b==$field){
                $b=0;
                $matchtime=matchadd($matchtime,$range);
            }
            $b++;
        }
    }
    if($done){
        echo "<script>alert('Succesfully generated $a match')</script>";
        echo "<script>window.location='/account/admin/competition.php?id_activity=$id_activity'</script>";
    }else{
        echo "<script>alert('Error while save to database, please contact developer.')</script>";
        echo "<script>window.location='/account/admin/competition.php?id_activity=$id_activity'</script>";
    }
?>