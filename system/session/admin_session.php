<?php
	session_start();	 
	if(cek_login($mysqli) == true){
		if ($_SESSION['akses'] == "Public" || $_SESSION['akses'] == "Member") {
			header('location: ../public/index.php');
			exit();
		}
	}else{
		header('location: index.php');
		exit();
	}
?>