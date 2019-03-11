<?php
    include('connection.php');
    include('../function.php');
    $id_team = $_GET['id_team'];
    $name = $_POST['teamName'];
    $uniform = $_POST['uniform'];
	$updateTeam="UPDATE futsal_team SET team_name='$name', team_uniform='$uniform' WHERE id_team='$id_team'";
    if(cek_name($mysqli, $name, $id_team)==true){
        $done = mysqli_query($mysqli, $updateTeam) or die(mysql_error);
        if($done){
            echo "<script>alert('Team data updated.')</script>";
            echo "<script>window.location='/account/public/my_activity.php'</script>";
        }else{
            echo "<script>alert('Error while update to database, please contact administrator.')</script>";
            echo "<script>window.location='/account/public/my_activity.php'</script>";
        }
    }else{
        echo "<script>alert('This team name is already used by another user, please use another name.')</script>";
        echo "<script>window.location='/account/public/my_activity.php'</script>";
    }
?>