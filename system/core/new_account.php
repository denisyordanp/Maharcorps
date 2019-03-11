<?php
	include('connection.php');
	include('../function.php');
	$name = $_POST['name'];
	$email = $_POST['email'];
	$birthday = $_POST['birthday'];
	$contact = $_POST['contact'];
	$address = $_POST['address'];
    $pass = md5($_POST['pass']);
	if(cek_email($mysqli,$email)==true){
        $id=idaccount($mysqli);
        $code=md5($id);
		$dateregis=date('Y-m-d');
		$regis="INSERT INTO account VALUES ('$id','$email','$name','$birthday','$contact','$address','$pass','Public',NULL,'$code',0,'$dateregis')";
		$done=mysqli_query($mysqli,$regis) or die (mysqli_error);
		if($done){
			echo "<script>alert('Congratulation you are registered. Please continue to login.')</script>";
			echo "<script>window.location='/account.php'</script>";
		}else{
			echo "<script>alert('Failed to registering. Please contact administrator.')</script>";
			echo "<script>window.location='/account.php'</script>";
		}
	}
?>