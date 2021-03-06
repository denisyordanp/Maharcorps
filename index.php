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
      include('system/querry/querry_all.php');
      include('system/function.php');
      include('system/session/general_session.php');
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
              <a class="nav-link js-scroll-trigger" href="#portfolio">Activity</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#about">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#howto">How To</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="account.php">Register/Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead">
      <div class="container">
        <div class="intro-text">
          <div class="intro-lead-in">Welcome To</div>
          <div class="intro-heading text-uppercase">MAHAR CORPS</div>
          <!-- <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">Tell Me More</a> -->
        </div>
      </div>
    </header>

    <!-- Activity -->
    <section class="bg-light" id="portfolio">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">Activity</h2>
            <h3 class="section-subheading text-muted">Let's join our upcoming activity</h3>
          </div>
        </div>
        <div class="row">
        <?php
        $activity=mysqli_query($mysqli, $querryactivity) or die(mysqli_error);
        $a=0;
          while($activitydata1 = mysqli_fetch_array($activity))
            {$a++;
              $datestatus="Join Now!";
              if(cekclosed($mysqli, $activitydata1['activity_registration_end'], $activitydata1['activity_date'], $activitydata1['activity_type'])==false){
                $datestatus="Closed";
              }
        ?>
        <div class="col-md-4 col-sm-6 portfolio-item">
          <div class="portfolio-caption">
            <h4><?php echo $activitydata1['activity_name'];?></h4>
          </div>
          <a class="portfolio-link" data-toggle="modal" href="#portfolioModal<?php echo $a; ?>">
            <div class="portfolio-hover">
              <div class="portfolio-hover-content">
                <i class="fa fa-plus fa-3x"></i>
              </div>
            </div>
            <img class="img-fluid" src="img/activity/<?php echo $activitydata1['activity_img'];?>.jpg" alt="">
          </a>
          <div class="portfolio-caption">
            <p class="text-muted">Event for <?php echo $activitydata1['DAY(activity_date)'], " ",$month[$activitydata1['MONTH(activity_date)']]," ",$activitydata1['YEAR(activity_date)'];?></p>
            <p class="text-muted">Status  : <?php echo $activitydata1['activity_status'];?></p>
            <p class="text-muted"><?php echo $datestatus; ?></p>
          </div>
          </div>
        <?php } ?>
        </div>
      </div>
    </section>

    <!-- Activity Modal -->
    <?php
      $activitymodal=mysqli_query($mysqli, $querryactivity) or die(mysqli_error);
      $a=0;
        while($modal = mysqli_fetch_array($activitymodal))
          {	$a++;
            $datestatus1="Join Now!";
            if(cekclosed($mysqli, $modal['activity_registration_end'], $modal['activity_date'], $modal['activity_type'])==false){
              $datestatus1="Closed";
            }
    ?>
    <div class="portfolio-modal modal fade" id="portfolioModal<?php echo $a; ?>" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
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
                  <h2 class="text-uppercase"><?php echo $modal['activity_name'] ?></h2>
                  <p class="item-intro text-muted">Event for <?php echo $modal['DAY(activity_date)'], " ", $month[$modal['MONTH(activity_date)']]," ", $modal['YEAR(activity_date)'];?></p>
                  <img class="img-fluid d-block mx-auto" src="img/activity/<?php echo $modal['activity_img'];?>.jpg" alt="">
                  <p><?php echo $modal['activity_description'] ?></p>
                  <ul class="list-inline">
                    <li>Registration: <?php echo $modal['DAY(activity_registration_start)'], " ", $month[$modal['MONTH(activity_registration_start)']]," ", $modal['YEAR(activity_registration_start)'];?> until <?php echo $modal['DAY(activity_registration_end)'], " ", $month[$modal['MONTH(activity_registration_end)']]," ", $modal['YEAR(activity_registration_end)'];?></li>
                    <?php if($modal['activity_type']=="General"){ if(date('Y-m-d',strtotime($modal['activity_date']))==date('Y-m-d',strtotime($modal['activity_end']))){ ?>
                    <li>Start from: <?php echo date('H:i',strtotime($modal['activity_date']));?> until <?php echo date('H:i',strtotime($modal['activity_end']));?></li>
                    <?php }else{ ?>
                    <li>Start from: <?php echo date('d F Y H:i',strtotime($modal['activity_date']));?> WIB until <?php echo date('d F Y H:i',strtotime($modal['activity_end']));?> WIB</li>
                    <?php }} ?>
                    <li>Location: <?php echo $modal['activity_location'];?></li>
                    <li>Status: <?php echo $modal['activity_status'];?></li>
                    <li>Type: <?php echo $modal['activity_type'];?></li>
                    <li>Registration fee: <?php if($modal['activity_fee']==0){ echo "Free";}else{echo rupiah($modal['activity_fee']);} if($modal['activity_type']=='Futsal'){echo "/Team";}?></li>
                    <?php if($datestatus1=="Closed"){?>
                    <li>"EVENT CLOSED"</li>
                    <?php } ?>
                  </ul>
                  <?php
                  $maxteam=true;
                  if($modal['activity_type']=="Futsal"){
                    ?>
                        <a href="/competition-team.php?id_activity=<?php echo $modal['id_activity'];?>" class="btn btn-primary"><i class="fa fa-fw fa-eye"></i> Competition</a>
                    <?php if(cekmaxteam($mysqli, $modal['id_activity'])==false){$maxteam=false;}
                    }
                  if($datestatus1!="Closed"){
                    if($maxteam==false){ ?>
                        <p style="margin-bottom:0px;">Sorry the competition is full.</p>
                <?php }else{ ?>
                    <a href="/account.php" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i> Join now!</a>
                    <p style="margin-bottom:0px;">You need to Login/Register first to Join.</p>
                <?php } } ?>
                    <button class="btn btn-primary" data-dismiss="modal" type="button"><i class="fa fa-times"></i> Close</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
          }
    ?>

    <!-- About -->
    <?php
      $aboutdata=mysqli_query($mysqli, $querryabout) or die(mysqli_error);
      $about = mysqli_fetch_array($aboutdata);
    ?>
    <section id="about">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">About Us</h2>
            <h3 class="section-subheading text-muted">Here's a bit of our story</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <ul class="timeline">
              <li>
                <div class="timeline-image">
                  <img class="rounded-circle img-fluid" src="img/about/2.jpg" alt="">
                </div>
                <div class="timeline-panel">
                  <div class="timeline-heading">
                    <h4>Before September 16th, 2012</h4>
                    <h4 class="subheading">Beginnings of all</h4>
                  </div>
                  <div class="timeline-body">
                    <p class="text-muted"><?php echo $about['paragraph1'];?></p>
                  </div>
                </div>
              </li>
              <li class="timeline-inverted">
                <div class="timeline-image">
                  <img class="rounded-circle img-fluid" src="img/about/2.jpg" alt="">
                </div>
                <div class="timeline-panel">
                  <div class="timeline-heading">
                    <h4>On September 16th, 2012</h4>
                    <h4 class="subheading">We born</h4>
                  </div>
                  <div class="timeline-body">
                    <p class="text-muted"><?php echo $about['paragraph2'];?></p>
                  </div>
                </div>
              </li>
              <li>
                <div class="timeline-image">
                  <img class="rounded-circle img-fluid" src="img/about/2.jpg" alt="">
                </div>
                <div class="timeline-panel">
                  <div class="timeline-heading">
                    <h4>After September 16th, 2012</h4>
                    <h4 class="subheading">Keep fighting!</h4>
                  </div>
                  <div class="timeline-body">
                    <p class="text-muted"><?php echo $about['paragraph3'];?></p>
                  </div>
                </div>
              </li>
              <li class="timeline-inverted">
                <div class="timeline-image">
                  <h4>Be Part
                    <br>Of Our
                    <br>Story!</h4>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- HOW TO -->
    <section id="howto">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">How To</h2>
            <h3 class="section-subheading text-muted">Here's the step to join our activity.</h3>
          </div>
        </div>
        <img class="img-fluid d-block mx-auto" src="img/about/how to.png" alt="">
      </div>
    </section>

    <!-- Contact -->
    <section id="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">Contact Us</h2>
            <h3 class="section-subheading text-muted">Send message directly to administrator.</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <form id="contactForm" name="sentMessage" novalidate="novalidate">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input class="form-control" id="name" type="text" placeholder="Your Name *" required="required" data-validation-required-message="Please enter your name.">
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="email" type="email" placeholder="Your Email *" required="required" data-validation-required-message="Please enter your email address.">
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="phone" type="tel" placeholder="Your Phone *" required="required" data-validation-required-message="Please enter your phone number.">
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
