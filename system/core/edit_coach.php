<?php
    include('connection.php');
    include('../function.php');
    $id_coach = $_GET['id_coach'];
	$name = $_POST['name'];
    $birthday = $_POST['birthday'];
	$updatecoach="UPDATE futsal_coach SET coach_name='$name', coach_date_of_birth='$birthday' WHERE id_coach='$id_coach'";
    $done = mysqli_query($mysqli, $updatecoach) or die(mysql_error);
    if($done){
        if($_FILES['photo']['name']!=NULL){
            $size = $_FILES['photo']['size'];
            $filetype = $_FILES['photo']['type'];
            if(updateimg('image/jpeg', $size, $filetype)==true){
                $imgpath="../../img/coach/coach_photo_".$id_coach.".jpg";
                if(file_exists($imgpath)){
                    if(!unlink($imgpath)){
                    echo "<script>alert('Error on update file, please contact administrator.')</script>";
                    echo "<script>window.location='/account/public/my_activity.php'</script>";
                    exit();
                    }
                }
                $target_dir = "../../img/coach/";
                $imageFileType = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
                $name = "coach_photo_".$id_coach.".".$imageFileType;
                $tmpname = $_FILES["photo"]["tmp_name"];
                $filepath = $target_dir.$name;
                if (resizeimg($tmpname, $filepath, 100, 'profil')==false) {
                    echo "<script>alert('Error while updload image, please contact administrator.')</script>";
                    echo "<script>window.location='/account/public/my_activity.php'</script>";
                    exit();
                }
            }
        }
        echo "<script>alert('Coach data updated.')</script>";
        echo "<script>window.location='/account/public/my_activity.php'</script>";
    }else{
        echo "<script>alert('Error while update, please contact administrator.')</script>";
        echo "<script>window.location='/account/public/my_activity.php'</script>";
    }
        
    
?>