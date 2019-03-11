<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Mahar Corps | Admin</title>
  <link rel="icon" type="image/png" href="/img/icon.png">
  <!-- Bootstrap core CSS-->
  <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="/css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">

<?php
  include('../../system/core/connection.php');
  include('../../system/function.php');
  session_start();
	if(cek_login($mysqli) == true){
		if ($_SESSION['akses'] == "Admin") {
			header('location: index.php');
			exit();
		}elseif($_SESSION['akses'] == "Public") {
      header('location: ../public/index.php');
      exit();
    }
	}

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['login'])){
      $email = $_POST['email'];
      $pass = $_POST['pass'];
      if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        if(login($email, $pass, $mysqli) == true){
          if ($_SESSION['akses'] == "Admin") {
            header('location: index.php');
            exit();
          }elseif($_SESSION['akses'] == "Public"){
            echo "<script>alert('What are you doing!')</script>";
            echo "<script>window.location='/system/core/logout.php'</script>";
            exit();
          }
        }else{
          echo "<script>alert('Sorry your email not registered yet or you inputed wrong password. Please try again or kindly contact our administrator. Thank you.')</script>";
          exit(); 
        }
      }else{
        echo "<script>alert('Please enter a valid email address and try again. Thank you.')</script>";
      }
    }
  }
?>

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form method="POST">
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input class="form-control" name="email" type="email"  placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" name="pass" type="password" maxlength="12" minlength="8" placeholder="Password">
          </div>
          <button class="btn btn-primary btn-block" type="submit" name="login">Login</button>
        </form>
        <div class="text-center">
          <!-- <a class="d-block small mt-3" href="register.html">Register an Account</a>
          <a class="d-block small" href="forgot-password.html">Forgot Password?</a> -->
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="/vendor/jquery/jquery.min.js"></script>
  <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
