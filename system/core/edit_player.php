<?php
    include('connection.php');
    include('../function.php');
    $id_player = $_GET['id_player'];
    $id_team = $_GET['id_team'];
    $name = $_POST['name'];
    $number = $_POST['number'];
    $birthday = $_POST['birthday'];
    $updateplayer="UPDATE futsal_player SET player_name='$name', player_number='$number', player_date_of_birth='$birthday' WHERE id_player='$id_player'";
    if(cek_number($mysqli, $id_player, $id_team, $number)==true){
        $done = mysqli_query($mysqli, $updateplayer) or die(mysql_error);
        if($done){
            if($_FILES['photo']['name']!=NULL){
                $size = $_FILES['photo']['size'];
                $filetype = $_FILES['photo']['type'];
                if(updateimg('image/jpeg', $size, $filetype)==true){
                    $imgpath="../../img/player/player_photo_".$id_player.".jpg";
                    if(file_exists($imgpath)){
                        if(!unlink($imgpath)){
                        echo "<script>alert('Error on update file, please contact administrator.')</script>";
                        echo "<script>window.location='/account/public/my_activity.php'</script>";
                        exit();
                        }
                    }
                    $target_dir = "../../img/player/";
                    $imageFileType = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
                    $name = "player_photo_".$id_player.".".$imageFileType;
                    $tmpname = $_FILES["photo"]["tmp_name"];
                    $filepath = $target_dir.$name;
                    if (resizeimg($tmpname, $filepath, 100, 'profil')==false) {
                        echo "<script>alert('Error while updload image, please contact administrator.')</script>";
                        echo "<script>window.location='/account/public/my_activity.php'</script>";
                        exit();
                    }
                }
            }
            if($_FILES['req']['name']!=NULL){
                $size = $_FILES['req']['size'];
                $filetype = $_FILES['req']['type'];
                if(updateimg('image/jpeg', $size, $filetype)==true){
                    $imgpath="../../img/player/req/player_req_".$id_player.".jpg";
                    if(file_exists($imgpath)){
                        if(!unlink($imgpath)){
                        echo "<script>alert('Error on update file, please contact administrator.')</script>";
                        echo "<script>window.location='/account/public/my_activity.php'</script>";
                        exit();
                        }
                    }
                    $target_dir = "../../img/player/req/";
                    $imageFileType = strtolower(pathinfo($_FILES['req']['name'], PATHINFO_EXTENSION));
                    $name = "player_req_".$id_player.".".$imageFileType;
                    $tmpname = $_FILES["req"]["tmp_name"];
                    $filepath = $target_dir.$name;
                    if (resizeimg($tmpname, $filepath, 100, 'profil')==false) {
                        echo "<script>alert('Error while updload image, please contact administrator.')</script>";
                        echo "<script>window.location='/account/public/my_activity.php'</script>";
                        exit();
                    }
                }
            }
            echo "<script>alert('Player data updated.')</script>";
            echo "<script>window.location='/account/public/my_activity.php'</script>";
        }else{
            echo "<script>alert('Error while update, please contact administrator.')</script>";
            echo "<script>window.location='/account/public/my_activity.php'</script>";
        }
    }else{
        echo "<script>alert('number $number is already used by another player on your team.')</script>";
        echo "<script>window.location='/account/public/my_activity.php'</script>";
    }
?>