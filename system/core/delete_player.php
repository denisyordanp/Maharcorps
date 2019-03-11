<?php
    include('connection.php');
    include('../function.php');
    session_start();
    $id_player = $_GET['id_player'];
    $id_team = $_GET['id_team'];
    $imgpath1="../../img/player/player_photo_".$id_player.".jpg";
    $imgpath2="../../img/player/req/player_req_".$id_player.".jpg";
    if(cekfutsaldate($mysqli,$id_team)==1){
        echo "<script>alert('Cannot delete player, because this player are joined at ongoing competition.')</script>";
        if($_SESSION['akses']=="Public" || $_SESSION['akses'] == "Member"){
            echo "<script>window.location='/account/public/my_activity.php'</script>";
        }else{
            echo "<script>window.location='/account/admin/futsal_player.php'</script>";
        }
        exit();
    }elseif(cekfutsaldate($mysqli,$id_team)==2){
        echo "<script>alert('This player are joined on competition, you need unjoin the team from competition where this player play first.')</script>";
        if($_SESSION['akses']=="Public" || $_SESSION['akses'] == "Member"){
            echo "<script>window.location='/account/public/my_activity.php'</script>";
        }else{
            echo "<script>window.location='/account/admin/futsal_player.php'</script>";
        }
        exit();
    }else{
        if(file_exists($imgpath1)){
            if(!unlink($imgpath1)){
                if($_SESSION['akses']=="Public" || $_SESSION['akses'] == "Member"){
                    echo "<script>alert('Error on delete photo, please contact administrator.')</script>";
                    echo "<script>window.location='/account/public/my_activity.php'</script>";
                }else{
                    echo "<script>alert('Error on delete photo, please contact developer.')</script>";
                    echo "<script>window.location='/account/admin/futsal_player.php'</script>";
                }
                exit();
            }
        }
        if(file_exists($imgpath2)){
            if(!unlink($imgpath2)){
                if($_SESSION['akses']=="Public" || $_SESSION['akses'] == "Member"){
                    echo "<script>alert('Error on delete req, please contact administrator.')</script>";
                    echo "<script>window.location='/account/public/my_activity.php'</script>";
                }else{
                    echo "<script>alert('Error on delete req, please contact developer.')</script>";
                    echo "<script>window.location='/account/admin/futsal_player.php'</script>";
                }
                exit();
            }
        }
        $deleteplayer="DELETE FROM futsal_player WHERE id_player='$id_player'";
        $done = mysqli_query($mysqli, $deleteplayer) or die(mysql_error);
        if($done){
            echo "<script>alert('Player deleted.')</script>";
            if($_SESSION['akses']=="Public" || $_SESSION['akses'] == "Member"){
                echo "<script>window.location='/account/public/my_activity.php'</script>";
            }else{
                echo "<script>window.location='/account/admin/futsal_player.php'</script>";
            }
            exit();
        }else{
            if($_SESSION['akses']=="Public" || $_SESSION['akses'] == "Member"){
                echo "<script>alert('Error while delete to database, please contact administrator.')</script>";
                echo "<script>window.location='/account/public/my_activity.php'</script>";
            }else{
                echo "<script>alert('Error while delete to database, please contact developer.')</script>";
                echo "<script>window.location='/account/admin/futsal_player.php'</script>";
            }
            exit();
        }
    }
?>