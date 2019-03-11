<?php
define("HOST", "localhost");
define("USER", "maharcor_root");
define("PASSWORD", "maHarcorps11");
define("DATABASE", "maharcor_main");
 
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
 
if($mysqli->connect_error){
 trigger_error('Connection Error: ' . $mysqli->connect_error, E_USER_ERROR);   
}

date_default_timezone_set("Asia/Jakarta");
?>