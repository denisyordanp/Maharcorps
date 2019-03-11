<?php
	session_start();
	if(cek_login($mysqli) == true){
        if($_SESSION['verification']==1){
            header('location: index.php');
			exit();
        }
	}else{
		header('location: ../../index.php');
		exit();
	}
?>