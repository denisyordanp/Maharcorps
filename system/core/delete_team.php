<?php
    include('connection.php');
    include('../function.php');
    $id_team = $_GET['id_team'];
    session_start();
    if(cekfutsaldate($mysqli,$id_team)==1){
        echo "<script>alert('Cannot delete team, because this team are joined at ongoing competition.')</script>";
        if($_SESSION['akses']=="Public" || $_SESSION['akses'] == "Member"){
            echo "<script>window.location='/account/public/my_activity.php'</script>";
        }else{
            echo "<script>window.location='/account/admin/futsal_team.php'</script>";
        }
        exit();
    }elseif(cekfutsaldate($mysqli,$id_team)==2){
        echo "<script>alert('This team are joined on competition, you need unjoin the team from competition first.')</script>";
        if($_SESSION['akses']=="Public" || $_SESSION['akses'] == "Member"){
            echo "<script>window.location='/account/public/my_activity.php'</script>";
        }else{
            echo "<script>window.location='/account/admin/futsal_team.php'</script>";
        }
        exit();
    }else{
        $imgpath="../../img/team_logo/logo_".$id_team.".png";
        if(file_exists($imgpath)){
            if(!unlink($imgpath)){
                if($_SESSION['akses']=="Public" || $_SESSION['akses'] == "Member"){
                    echo "<script>alert('Error on delete logo, please contact administrator.')</script>";
                    echo "<script>window.location='/account/public/my_activity.php'</script>";
                }else{
                    echo "<script>alert('Error on delete logo, please contact developer.')</script>";
                    echo "<script>window.location='/account/admin/futsal_team.php'</script>";
                }
                exit();
            }
        }
        $deleteteam="DELETE FROM futsal_team WHERE id_team='$id_team'";
        $done = mysqli_query($mysqli, $deleteteam) or die(mysql_error);
        if($done){
            echo "<script>alert('Team deleted.')</script>";
            if($_SESSION['akses']=="Public" || $_SESSION['akses'] == "Member"){
                echo "<script>window.location='/account/public/my_activity.php'</script>";
            }else{
                echo "<script>window.location='/account/admin/futsal_team.php'</script>";
            }
            exit();
        }else{
            if($_SESSION['akses']=="Public" || $_SESSION['akses'] == "Member"){
                echo "<script>alert('Error while delete to database, please contact administrator.')</script>";
                echo "<script>window.location='/account/public/my_activity.php'</script>";
            }else{
                echo "<script>alert('Error while delete to database, please contact developer.')</script>";
                echo "<script>window.location='/account/admin/futsal_team.php'</script>";
            }
            exit();
        }
    }
?>