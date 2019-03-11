<?php
	session_start();
	if(cek_login($mysqli) == true){
		if($_SESSION['verification']==0){
            header('location: verification.php');
			exit();
        }
	}else{
		header('location: ../../index.php');
		exit();
	}
?>