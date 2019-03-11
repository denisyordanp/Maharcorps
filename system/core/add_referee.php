<?php
    include('connection.php');
    include('../function.php');
    function cek_img($id){
		if (isset($_POST["add-referee"])){
            $referee_name = $_POST['name'];
            $photoFileType = strtolower(pathinfo($_FILES['referee-image']['name'], PATHINFO_EXTENSION));
            $reqFileType = strtolower(pathinfo($_FILES['referee-req']['name'], PATHINFO_EXTENSION));
            $photoName = "referee_photo_".$id.".".$photoFileType;
            $reqName = "referee_req_".$id.".".$reqFileType;
            $photo_tmp_img = $_FILES['referee-image']['tmp_name'];
            $req_tmp_img = $_FILES['referee-req']['tmp_name'];
            $photo_img_size = $_FILES['referee-image']['size'];
            $req_img_size = $_FILES['referee-req']['size'];
            $photo_target_dir = "../../img/referee/".$photoName;
            $req_target_dir = "../../img/referee/req/".$reqName;
		}	
		if($photoFileType != 'jpg') {
			echo "<script>alert('referee photo file is not a jpg or not supported, please contact administrator.')</script>";
            echo "<script>window.location='/account/admin/futsal_referee.php'</script>";
            if($reqFileType != 'jpg'){
                echo "<script>alert('referee requirement file is not a jpg or not supported, please contact administrator.')</script>";
                echo "<script>window.location='/account/admin/futsal_referee.php'</script>";
            }
		} elseif ($photo_img_size > 5000000) {
			echo "<script>alert('referee photo file is to large, max image size 5MB.')</script>";
            echo "<script>window.location='/account/admin/futsal_referee.php'</script>";
            if ($req_img_size > 5000000) {
                echo "<script>alert('referee requirement file is to large, max image size 5MB.')</script>";
                echo "<script>window.location='/account/admin/futsal_referee.php'</script>";
            }
		}else{
			if (move_uploaded_file($photo_tmp_img, $photo_target_dir) || move_uploaded_file($req_tmp_img, $req_target_dir)) {
				return true;
			} else {
				echo "<script>alert('Unknown error, please contact developer.')</script>";
				echo "<script>window.location='/account/admin/futsal_referee.php'</script>";
			}			
		}
    }
    $name = $_POST['name'];
    $birthday = $_POST['birthday'];
    $date=date('Y-m-d');
    $id=idreferee($mysqli);
    $addreferee = "INSERT INTO futsal_referee VALUES ('$id', '$name', '$birthday', 'referee_photo_$id', 'referee_req_$id', '$date')";
    if(cek_img($id)==true){
        $done = mysqli_query($mysqli, $addreferee) or die(mysqli_error);
        if($done){
            echo "<script>alert('Referee added')</script>";
            echo "<script>window.location='/account/admin/futsal_referee.php'</script>";
        }else{
            echo "<script>alert('Error while save to database, please contact developer.')</script>";
            echo "<script>window.location='/account/admin/futsal_referee.php'</script>";
        }
    }else{
        echo"<script>alert('Error while saving image, please contact developer.')</script>";
        echo"<script>window.location='/account/admin/futsal_referee.php'</script>";
    }
?>