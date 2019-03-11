<?php
    include('connection.php');
    include('../function.php');
    $id_team = $_GET['id_team'];
    $name = $_POST['name'];
    $birthday = $_POST['birthday'];
    $date = date('Y-m-d');
    $id=idcoach($mysqli);
    $addcoach = "INSERT INTO futsal_coach VALUES ('$id', '$id_team', '$name', '$birthday', 'coach_photo_$id','$date')";
    $setcoach = "UPDATE futsal_team SET id_coach='$id' WHERE id_team='$id_team'";
    $size = $_FILES['photo']['size'];
    $filetype = $_FILES['photo']['type'];
    if(updateimg('image/jpeg', $size, $filetype)==true){
        $target_dir = "../../img/coach/";
        $imageFileType = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
        $name = "coach_photo_".$id.".".$imageFileType;
        $tmpname = $_FILES["photo"]["tmp_name"];
        $filepath = $target_dir.$name;
        if (resizeimg($tmpname, $filepath, 80, 'profil')==true){
            $done = mysqli_query($mysqli, $addcoach) or die(mysqli_error);
            $done1 = mysqli_query($mysqli, $setcoach) or die(mysqli_error);
            if($done && $done1){
                echo "<script>alert('Coach joined to the team.')</script>";
                echo "<script>window.location='/account/public/my_activity.php'</script>";
            }else{
                echo "<script>alert('Error while save to database, please contact administrator.')</script>";
                echo "<script>window.location='/account/public/my_activity.php'</script>";
            }
        }else{
            echo"<script>alert('Error while saving image, please contact administrator.')</script>";
            echo"<script>window.location='/account/public/my_activity.php'</script>";
        }
    }else{
        echo"<script>alert('Unknown error, please contact administrator.')</script>";
        echo"<script>window.location='/account/public/my_activity.php'</script>";
    }
?>