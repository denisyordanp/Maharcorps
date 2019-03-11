<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Maharcorps</title>
    <link rel="icon" type="image/png" href="/img/icon.png">
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
    <!-- Custom styles for this template -->
    <link href="css/agency.min.css" rel="stylesheet">
  </head>
  
  <body id="page-top">
<?php
    include('system/core/connection.php');
    include('system/function.php');
    include('system/session/general_session.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      if(isset($_POST['login'])){
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
          if(login($email, $pass, $mysqli) == true){
            if($_SESSION['akses'] == "Public" || $_SESSION['akses'] == "Member" || $_SESSION['akses'] == "Admin"){
              header('location: /account/public/index.php');
              exit();
            }
          }else{
            echo "<script>alert('Sorry your email not registered yet or you inputed wrong password. Please try again or kindly contact our administrator. Thank you.')</script>";
            echo "<script>window.location='account.php'</script>";
            exit(); 
          }
        }else{
          echo "<script>alert('Please enter a valid email address and try again. Thank you.')</script>";
          echo "<script>window.location='account.php'</script>";
        }
      }
    }
?>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-shrink" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="index.php">Back to home</a>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead">
      <div class="container">
        <div class="intro-text">
            <div style="width:215px;margin:auto;padding:15px;">
                <a class="portfolio-link" data-toggle="modal" href="#register">
                    <div class="portfolio-hover">
                    <div class="portfolio-hover-content">
                        <i class="btn btn-primary btn-xl text-uppercase">Register</i>
                    </div>
                    </div>
                </a>
            </div>
            <div style="width:200px;margin:auto;padding:15px;">
            <a class="portfolio-link" data-toggle="modal" href="#login">
                <div class="portfolio-hover">
                <div class="portfolio-hover-content">
                    <i class="btn btn-primary btn-xl text-uppercase">Login</i>
                </div>
                </div>
            </a>
            </div>
        </div>
      </div>
    </header>

    <!-- Register -->
    <div class="portfolio-modal modal fade" id="register" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div style="max-width:700px;margin:auto;" class="modal-content">
          <div class="close-modal" data-dismiss="modal">
            <div class="lr">
              <div class="rl"></div>
            </div>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-lg-8 mx-auto">
                <div class="modal-body">
                  <!-- Project Details Go Here -->
                  <h3 class="text-uppercase">REGISTER</h3>
                  <form method="POST" name="register" action="system/core/new_account.php">
                    <table class="tb-form">
                        <tr>
                            <td>Name</td>
                            <td><input type="text" name="name" maxlength="30" required></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><input type="email" name="email" required></td>
                        </tr>
                        <tr>
                            <td>Date of Birth</td>
                            <td><input type="date" name="birthday" required></td>
                        </tr>
                        <tr>
                            <td>Contact Number</td>
                            <td><input type="text" minlength="11" maxlength="13" name="contact" onkeypress="validate(event)" required></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td><input type="text" name="address" maxlength="30" required></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><input type="password" name="pass" minlength="8" maxlength="12" required></td>
                        </tr>
                        <tr>
                            <td>Repeat Password</td>
                            <td><input type="password" name="re-pass" minlength="8" maxlength="12" required></td>
                        </tr>
                    </table>
                      <button class="btn btn-primary" type="submit" name="regis"><i class="fa fa-plus"></i> Register</button>
                      <button data-dismiss="modal" class="btn btn-primary" type="button" ><i class="fa fa-times"></i> Close</button>
                </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Login -->
    <div class="portfolio-modal modal fade" id="login" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div style="max-width:700px;margin:auto;" class="modal-content">
          <div class="close-modal" data-dismiss="modal">
            <div class="lr">
              <div class="rl"></div>
            </div>
          </div>
          <div class="container">
            <div class="row">
              <div class="col-lg-8 mx-auto">
                <div class="modal-body">
                  <!-- Project Details Go Here -->
                  <h3 class="text-uppercase">LOGIN</h3>
                  <form method="POST" name="login">
                    <table class="tb-form">
                        <tr>
                            <td>Email</td>
                            <td><input type="email" name="email" required></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><input type="password" name="pass" minlength="8" maxlength="12" required></td>
                        </tr>
                    </table>
                      <button class="btn btn-primary" type="submit" name="login"> Login</button>
                      <button data-dismiss="modal" class="btn btn-primary" type="button" ><i class="fa fa-times"></i> Close</button>
                </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <span class="copyright">All right reserved. Copyright &copy; Maharcorps 2018.</span>
          </div>
          <div class="col-md-4">
            <ul class="list-inline social-buttons">
              <li class="list-inline-item">
                <a target="_blank" href="http://www.instagram.com/maharcorps/">
                  <i class="fa fa-instagram"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a target="_blank" href="http://www.twitter.com/maharcorps/">
                  <i class="fa fa-twitter"></i>
                </a>
              </li>
            </ul>
          </div>
          <div class="col-md-4">
            <ul class="list-inline quicklinks">
              <li class="list-inline-item">Developed by 
                <a href="#">Denis Yordan P</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>

    <script>
    function validate(evt) {
    var theEvent = evt || window.event;
    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
    // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }
    var regex = /[0-9]|\./;
    if( !regex.test(key) ) {
        theEvent.returnValue = false;
        if(theEvent.preventDefault) theEvent.preventDefault();
    }
    }
    </script>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Contact form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/agency.min.js"></script>

  </body>

</html>
