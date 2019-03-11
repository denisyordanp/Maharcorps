<?php
session_start();
session_destroy();
header('location: /account/admin/login.php');?>