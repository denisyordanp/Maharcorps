<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Maharcorps | Public</title>
    <link rel="icon" type="image/png" href="/img/icon.png">

    <!-- Bootstrap core CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="/css/agency.min.css" rel="stylesheet">

  </head>

  <body id="page-top">
    <?php
      include('../../system/core/connection.php');
      include('../../system/querry/querry_all.php');
      include('../../system/function.php');
      include('../../system/session/verification_session.php');
      $id_account=$_SESSION['id_account'];
    ?>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Maharcorps</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="/system/core/logout.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead">
      <div class="container">
        <div class="intro-text">
            <div class="intro-lead-in">You need to verification your email first</div>
            <div style="width:280px;margin:auto;padding:15px;margin-bottom:10px;">
                    <div class="portfolio-hover">
                    <div class="portfolio-hover-content">
                    <form method="POST" action="/system/core/verification_email.php">
                        <button style="padding:10px;" type="submit" name="send-verification" class="btn btn-primary btn-xl text-uppercase">Send Verification</button>
                    </form>
                    </div>
                    </div>
                <a href="" data-toggle="modal" data-target="#change">
                    <div class="portfolio-hover">
                    <div class="portfolio-hover-content">
                        <i style="padding:10px;" class="btn btn-primary btn-xl text-uppercase">Change Email</i>
                    </div>
                    </div>
                </a>
            </div>
        </div>
      </div>
    </header>

    <!-- Change Email -->
    <div class="portfolio-modal modal fade" id="change" tabindex="-1" role="dialog" aria-hidden="true">
        <div style="max-width:500px;margin:auto;" class="modal-dialog">
        <div style="padding:20px;" class="modal-content">
            <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                <div class="modal-body">
                    <!-- Project Details Go Here -->
                    <p>Email</p>
                    <form method="POST" action="/system/core/verification_email.php">
                        <input value="<?php echo $_SESSION['email'];?>" type="text" name="email">
                        <button class="btn btn-primary" type="submit" name="update-email"><i class="fa fa-pencil"></i> Update</button>
                        <button class="btn btn-primary" data-dismiss="modal" type="button"><i class="fa fa-times"></i> Cancel</button>
                    </form>
                </div>
                </div>
            </div>
            </div>
            </div>
        </div>
        </div>
    </div>

    <!-- Contact -->
    <section id="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">Contact Us</h2>
            <h3 class="section-subheading text-muted">Send message directly to administrator.</h3>
          </div>
        </div>
        <?php 
          $querylogacc="SELECT * FROM account WHERE id_account='$id_account'";
          $acc=mysqli_query($mysqli,$querylogacc);
          $dataacc=mysqli_fetch_array($acc);
        ?>
        <div class="row">
          <div class="col-lg-12">
            <form id="contactForm" name="sentMessage" novalidate="novalidate">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input class="form-control" id="name" type="text" value="<?php echo $dataacc['account_name'];?>" required="required" data-validation-required-message="Please enter your name.">
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="email" type="email" value="<?php echo $dataacc['account_email'];?>" required="required" data-validation-required-message="Please enter your email address.">
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="phone" type="tel" value="<?php echo $dataacc['account_contact_number'];?>" required="required" data-validation-required-message="Please enter your phone number.">
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <textarea class="form-control" id="message" placeholder="Your Message *" required="required" data-validation-required-message="Please enter a message."></textarea>
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-12 text-center">
                  <div id="success"></div>
                  <button id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase" type="submit">Send Message</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <?php
      	//  if(isset($_POST['admin_message'])){
        //   $name=$_POST['name'];
        //   $email=$_POST['email'];
        //   $phone=$_POST['phone'];
        //   $message=$_POST['message'];
        //   $date=date('Y-m-d H:i:s');
        //   $insert="INSERT INTO 'message' VALUES(NULL,'$name','$email','$phone','$text','$date')";
        //   mysqli_query($mysqli,$insert);
        // } 
    ?>

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

    <!-- Bootstrap core JavaScript -->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Contact form JavaScript -->
    <script src="/js/jqBootstrapValidation.js"></script>
    <script src="/js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="/js/agency.min.js"></script>

  </body>

</html>
