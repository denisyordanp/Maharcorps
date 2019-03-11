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
    <link href="/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  </head>

  <body id="page-top">
<?php
      include('../../system/core/connection.php');
      include('../../system/function.php');
      include('../../system/session/public_session.php');
      $id_team=$_GET['id_team'];
      $id_activity=$_GET['id_activity'];
      $page=$_GET['page'];
?>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-shrink" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" <?php if($page=='Competition'){echo 'href="competition-team.php?id_activity='.$id_activity.'"';}else{echo 'href="competition-match.php?id_activity='.$id_activity.'"';}?>>Back to <?php echo $page?></a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#official">Official</a>
            </li>
            <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#player">Player</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
<?php
    $querryteamdetil="SELECT id_team, account.id_account, account.account_name, account.account_email, account.account_date_of_birth, account.account_img, id_coach, team_name, team_logo FROM futsal_team INNER JOIN account ON account.id_account=futsal_team.id_account WHERE id_team='$id_team'";
    $teamdata=mysqli_query($mysqli, $querryteamdetil) or die(mysqli_error);
    $detailteam=mysqli_fetch_array($teamdata);
    $coach=$detailteam['id_coach'];
?>
    <!-- Header -->
    <header class="masthead">
      <div class="container">
        <div style="padding-top:140px;" class="intro-text">
            <div class="intro-lead-in"><?php echo $detailteam['team_name']?></div>
            <div class="intro-lead-in"><img style="max-width:275px" src="/img/team_logo/<?php echo $detailteam['team_logo']?>.png"></div>
        </div>
      </div>
    </header>

    <!-- Official -->
    <section class="bg-light" id="official">
      <div style="text-align:center;" class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">Official</h2>
            <h3 class="section-subheading text-muted">Team official</h3>
          </div>
        </div>
        <div class="row">
        <div style="margin:auto;" class="col-md-4 col-sm-6 portfolio-item">
          <div class="portfolio-caption">
            <h4>Manager</h4>
          </div>
            <img class="img-fluid" src="/img/account/<?php echo ceknullimg($detailteam['account_img']);?>.jpg" alt="">
          <div class="portfolio-caption">
            <p class="text-muted">Name : <?php echo $detailteam['account_name'];?></p>
            <p class="text-muted">Age  : <?php echo age($detailteam['account_date_of_birth']); ?></p>
          </div>
          </div>
          <?php if($coach!=NULL){
              $querrycoach="SELECT * FROM futsal_coach WHERE id_coach='$coach'";
              $coachdata=mysqli_query($mysqli, $querrycoach) or die(mysqli_error);
              $detailcoach=mysqli_fetch_array($coachdata);
              ?>
          <div style="margin:auto;" class="col-md-4 col-sm-6 portfolio-item">
          <div class="portfolio-caption">
            <h4>Coach</h4>
          </div>
            <img class="img-fluid" src="/img/coach/<?php echo ceknullimg($detailcoach['coach_img']);?>.jpg" alt="">
          <div class="portfolio-caption">
            <p class="text-muted">Name : <?php echo $detailcoach['coach_name'];?></p>
            <p class="text-muted">Age  : <?php echo age($detailcoach['coach_date_of_birth']); ?></p>
          </div>
          </div>
          <?php } ?>
        </div>
      </div>
    </section>

    <!-- Player List -->
    <section class="bg-light" id="player">
      <div style="text-align:center;" class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">Player</h2>
            <h3 class="section-subheading text-muted">Team player</h3>
          </div>
        </div>
        <div class="row">
        <?php
            $querryplayer="SELECT * FROM futsal_player WHERE id_team='$id_team'";
            $playerdata=mysqli_query($mysqli, $querryplayer) or die(mysqli_error);
            $cekplayer=mysqli_query($mysqli, $querryplayer) or die(mysqli_error);
            $playercek=mysqli_fetch_array($cekplayer);
            if($playercek!=NULL){
            while($playerdetail=mysqli_fetch_array($playerdata)){
         ?>
        <div style="margin:auto;margin-bottom:20px;" class="col-md-4 col-sm-6 portfolio-item">
          <div class="portfolio-caption">
            <h4><?php echo $playerdetail['player_name'];?></h4>
          </div>
            <img class="img-fluid" src="/img/player/<?php echo ceknullimg($playerdetail['player_img']);?>.jpg" alt="">
          <div class="portfolio-caption">
            <p class="text-muted">Number : <?php echo $playerdetail['player_number'];?></p>
            <p class="text-muted">Age  : <?php echo age($playerdetail['player_date_of_birth']); ?></p>
          </div>
          </div>
            <?php }}else{?>
                <h5 style="margin:auto;">There's no player on this team yet.</h5>
            <?php }?>
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

    <div style="position:absolute;display:none;background-color:lightblue;border-radius:2px;padding:3px;" id="view">View more</div>

    <!-- Bootstrap core JavaScript -->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="/vendor/datatables/jquery.dataTables.js"></script>
    <script src="/js/sb-admin.min.js"></script>
    <script src="/js/sb-admin-datatables.min.js"></script>

    <!-- Contact form JavaScript -->
    <script src="/js/jqBootstrapValidation.js"></script>
    <script src="/js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="/js/agency.min.js"></script>

  </body>

</html>
