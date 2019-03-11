<?php
	include('connection.php');
	include('../function.php');
    function cek_img(){
		if (isset($_POST["newTeam"])){
			$team_name = $_POST['teamName'];  
			$imageFileType = strtolower(pathinfo($_FILES['teamLogo']['name'], PATHINFO_EXTENSION));
			$name = "logo_".$team_name.".".$imageFileType;
			$tmp_img = $_FILES['teamLogo']['tmp_name'];
			$img_size = $_FILES['teamLogo']['size'];
			$target_dir = "../../img/team_logo/".$name;
		}	
		if($imageFileType != 'png') {
			echo "<script>alert('File is not a png or not supported, please contact administrator.')</script>";
			echo "<script>window.location='/account/public/my_activity.php'</script>";
		} elseif ($img_size > 1000000) {
			echo "<script>alert('File is to large, max image size 1MB.')</script>";
			echo "<script>window.location='/account/public/my_activity.php'</script>";
		}else{
			if (move_uploaded_file($tmp_img, $target_dir)) {
				return true;
			} else {
				echo "<script>alert('Unknown error, please contact administrator.')</script>";
				echo "<script>window.location='/account/public/my_activity.php'</script>";
			}			
		}
	}
	function cek_name_new($mysqli, $name){
        $querryName = "SELECT id_team, team_name FROM futsal_team WHERE team_name='$name'";
        $check_name = mysqli_query($mysqli, $querryName) or die(mysql_error);
        if(mysqli_num_rows($check_name) == 0){
            return true;
		}else{
			return false;
		}
    }
    session_start();
	$id_account = $_SESSION['id_account'];
	$name = $_POST['teamName'];
	$uniform = $_POST['uniform'];
	$date = date('Y-m-d');
	$id=idteam($mysqli);
    
    $newteam ="INSERT INTO futsal_team VALUES (
        '$id',
        '$id_account',
		NULL,
        '$name',
        'logo_$name',
		'$uniform',
		'$date'
		)";
	if(cek_name_new($mysqli, $name)==true){
		if(cek_img()==true){
			$done = mysqli_query($mysqli, $newteam);
			if($done){
				echo "<script>alert('Team created, please continue to add player.')</script>";
				echo "<script>window.location='/account/public/my_activity.php#futsal-team'</script>";
			}else{
				echo "<script>alert('Error while save to database, please contact administrator.')</script>";
				echo "<script>window.location='/account/public/my_activity.php'</script>";
			}
		}
	}else{
		echo "<script>alert('This team name is already used by another user, please use another name.')</script>";
        echo "<script>window.location='/account/public/my_activity.php'</script>";
	}
	
?>