<?php
    include('connection.php');
    include('../function.php');
    $id_team = $_POST['team'];
    $id_participant = $_GET['id_participant'];
    $id_activity = $_GET['id_activity'];
    $date=date('Y-m-d');
    $id=idfutsaldetail($mysqli);
    $addTeam = "INSERT INTO futsal_detail VALUES ('$id', '$id_participant', '$id_team', '$date')";
    if(cek_join_team($mysqli, $id_participant, $id_team)==true){
        if (cek_total_player($mysqli, $id_team)==true){
            $done = mysqli_query($mysqli, $addTeam) or die(mysqli_error);
            if($done){
                echo "<script>alert('Your team are joined.')</script>";
                echo "<script>window.location='/account/public/competition-team.php?id_activity=$id_activity'</script>";
            }else{
                echo "<script>alert('Error while save to database, please contact administrator.')</script>";
                echo "<script>window.location='/account/public/my_activity.php'</script>";
            }
        }else{
            echo"<script>alert('You need to add minimal 3 player for this team first.')</script>";
		    echo"<script>window.location='/account/public/my_activity.php'</script>";
        }
    }else{
        echo"<script>alert('This team already joined.')</script>";
		echo"<script>window.location='/account/public/my_activity.php'</script>";
    }
?>