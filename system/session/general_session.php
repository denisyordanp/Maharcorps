<?php 
	session_start();
	if(cek_login($mysqli) == true){
		if ($_SESSION['akses'] == "Admin") {
			header('location: account/admin/index.php');
			exit();
		}elseif ($_SESSION['akses'] == "Public" || $_SESSION['akses'] == "Member") {
			header('location: account/public/index.php');
			exit();
		}
	}
?>