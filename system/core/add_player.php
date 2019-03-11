<?php
    include('connection.php');
    include('../function.php');
    $id_team = $_GET['id_team'];
    $name = $_POST['name'];
    $birthday = $_POST['birthday'];
    $number = $_POST['number'];
    $date=date('Y-m-d');
    $id=idplayer($mysqli);
    $addPlayer = "INSERT INTO futsal_player VALUES ('$id', '$id_team', '$name', '$number', '$birthday', 'player_photo_$id', 'player_req_$id', '$date')";
    if(cek_team($mysqli, $id_team)==true){
        if(cek_number($mysqli, $id_team, $number)==true){
            $size1 = $_FILES['photo']['size'];
            $filetype1 = $_FILES['photo']['type'];
            $size2 = $_FILES['requirement']['size'];
            $filetype2 = $_FILES['requirement']['type'];
            if(updateimg('image/jpeg', $size1, $filetype1)==true && updateimg('image/jpeg', $size2, $filetype2)==true){
                $target_dir1 = "../../img/player/";
                $imageFileType1 = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
                $name1 = "player_photo_".$id.".".$imageFileType1;
                $tmpname1 = $_FILES["photo"]["tmp_name"];
                $filepath1 = $target_dir1.$name1;
                $target_dir2 = "../../img/player/req/";
                $imageFileType2 = strtolower(pathinfo($_FILES['requirement']['name'], PATHINFO_EXTENSION));
                $name2 = "player_req_".$id.".".$imageFileType2;
                $tmpname2 = $_FILES["requirement"]["tmp_name"];
                $filepath2 = $target_dir2.$name2;
                if (resizeimg($tmpname1, $filepath1, 80, 'profil')==true && resizeimg($tmpname2, $filepath2, 80, 'pay')==true){
                    $done = mysqli_query($mysqli, $addPlayer) or die(mysqli_error);
                    if($done){
                        echo "<script>alert('Player joined to the team.')</script>";
                        echo "<script>window.location='/account/public/my_activity.php'</script>";
                    }else{
                        echo "<script>alert('Error while save to database, please contact administrator.')</script>";
                        echo "<script>window.location='/account/public/my_activity.php'</script>";
                    }
                }
            }else{
                echo"<script>alert('Unknown error, please contact administrator.')</script>";
                echo"<script>window.location='/account/public/my_activity.php'</script>";
            }
        }else{
            echo "<script>alert('number $number is already used by another player on your team.')</script>";
            echo "<script>window.location='/account/public/my_activity.php'</script>";
        }
    }else{
        echo"<script>alert('This team already has a maximum of players.')</script>";
		echo"<script>window.location='/account/public/my_activity.php'</script>";
    }
?>