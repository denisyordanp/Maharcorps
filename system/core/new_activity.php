<?php
    include('connection.php');
    include('../function.php');
    function cek_img($id){
		$target_dir = "../../img/activity/";
		$imageFileType = strtolower(pathinfo($_FILES['activity-image']['name'], PATHINFO_EXTENSION));
		$name = "activity_".$id.".".$imageFileType;
		if (isset($_POST["create-event"])) {
			$check = @getimagesize($_FILES["activity-image"]["tmp_name"]);
			if ($check == false) {
				echo "<script>alert('File is not an image.')</script>";
				echo "<script>window.location='/account/admin/activity.php'</script>";
			} elseif ($_FILES["activity-image"]["size"] > 500000) {
				echo "<script>alert('File is to large.')</script>";
				echo "<script>window.location='/account/admin/activity.php'</script>";
			}else{
				if (move_uploaded_file($_FILES["activity-image"]["tmp_name"],$target_dir.$name)) {
					return true;
				} else {
					echo "<script>alert('Unknown error, please contact developer.')</script>";
					echo "<script>window.location='/account/admin/activity.php'</script>";
				}
			}
        }
    }
    $name = $_POST['name'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $datestart = $_POST['datestart'];
    $dateend = $_POST['dateend'];
    $desc = $_POST['desc'];
    $status = $_POST['status'];
    $type = $_POST['type'];
    $location = $_POST['location'];
    $fee = $_POST['fee'];
    $id=idactivity($mysqli);
    $dateregis=date('Y-m-d');
    if($type=="General"){
        $timestart = $_POST['timestart'];
        $timeend = $_POST['timeend'];
        $date1 = $datestart.' '.$timestart;
        $date2 = $dateend.' '.$timeend;
    }else{
        $timestart = "00:00:00";
        $date1 = $datestart.' '.$timestart;
        $date2 = NULL;
    }
	$newactivity ="INSERT INTO activity VALUES (
        '$id',
        '$name',
        '$start',
        '$end',
        '$date1',
        '$date2',
        '$desc',
        '$status',
        '$type',
        '$location',
        '$fee',
        'activity_$id',
        '$dateregis'
        )";
        if(cek_img($id)==true){
            $done = mysqli_query($mysqli, $newactivity);
            if($done){
                echo "<script>alert('Activity created.')</script>";
				echo "<script>window.location='/account/admin/activity.php'</script>";
            }else{
                echo "<script>alert('Error while save to database, please contact developer.')</script>";
				echo "<script>window.location='/account/admin/activity.php'</script>";
            }
        }           
?>