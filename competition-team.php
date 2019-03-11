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
      include('system/core/connection.php');
      include('system/function.php');
      include('system/session/general_session.php');
      $id_activity=$_GET['id_activity'];
?>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-shrink" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="index.php">Back to home</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#teamlist">Team</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="/competition-match.php?id_activity=<?php echo $id_activity;?>">Match</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
<?php
$querryactivitydetail="SELECT id_activity_futsal_detail, activity.id_activity, activity.activity_name, competition_system, DAY(technical_meeting_date), MONTH(technical_meeting_date), YEAR(technical_meeting_date), meeting_location FROM activity_futsal_detail INNER JOIN activity ON activity.id_activity=activity_futsal_detail.id_activity WHERE activity.id_activity='$id_activity'";
$activityquery="SELECT * FROM activity WHERE id_activity='$id_activity'";
$actdata=mysqli_query($mysqli, $activityquery) or die(mysqli_error);
$actdetail=mysqli_fetch_array($actdata);
$detaildata=mysqli_query($mysqli, $querryactivitydetail) or die(mysqli_error);
$futsaldetaildata=mysqli_fetch_array($detaildata);
$id_activity_futsal_detail=$futsaldetaildata['id_activity_futsal_detail'];
?>
    <!-- Header -->
    <header class="masthead">
      <div class="container">
        <div class="intro-text">
          <?php if(cekactivitydetail($mysqli, $id_activity)==false){ ?>
            <div style="margin-bottom:50px;" class="intro-lead-in">There's no data yet.</div>
        <?php }else{ ?>
            <div class="intro-lead-in"><?php echo $futsaldetaildata['activity_name']?></div>
            <div style="font-size:20px;" class="intro-lead-in">Technical meeting date : <?php echo $futsaldetaildata['DAY(technical_meeting_date)']." ".$month[$futsaldetaildata['MONTH(technical_meeting_date)']]." ".$futsaldetaildata['YEAR(technical_meeting_date)']?></div>
            <div style="font-size:20px;" class="intro-lead-in">Location : <?php echo $futsaldetaildata['meeting_location']?></div>
            <div style="font-size:20px;" class="intro-lead-in">Competition system : <?php echo $futsaldetaildata['competition_system'];?></div>
            <?php } ?>
        </div>
      </div>
    </header>
<?php if(cekactivitydetail($mysqli, $id_activity)==true){ ?>

    <!-- Team List -->
    <section class="bg-light" id="teamlist">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">Team</h2>
            <h3 class="section-subheading text-muted">Team registered list</h3>
          </div>
        </div>
          <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-table"></i> Team list
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Logo</th>
                    <th>Team name</th>
                    <th>Manager</th>
                    <th>Coach</th>
                    <th>Total player</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Logo</th>
                    <th>Team name</th>
                    <th>Manager</th>
                    <th>Coach</th>
                    <th>Total player</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php
                    $querryteamactivity="SELECT id_futsal_detail, participant.id_activity, futsal_team.id_team, account.id_account, account.account_name, futsal_team.team_name, futsal_team.team_logo FROM futsal_detail INNER JOIN participant ON participant.id_participant=futsal_detail.id_participant INNER JOIN futsal_team ON futsal_team.id_team=futsal_detail.id_team INNER JOIN account ON futsal_team.id_account=account.id_account WHERE participant.id_activity='$id_activity'";
                    $activityteamdata=mysqli_query($mysqli, $querryteamactivity) or die(mysqli_error);
                    $data=mysqli_query($mysqli, $querryteamactivity) or die(mysqli_error);
                    $checkdata = mysqli_fetch_array($data);
                      if(is_array($checkdata)==0){
                  ?>
                        <tr>
                            <td colspan="6" style="text-align:center;">There's no team listed yet.</td>
                        </tr>
                  <?php
                      }else{
                          $a=1;
                          while($activityteamlist = mysqli_fetch_array($activityteamdata)){
                        $id_team=$activityteamlist['id_team'];
                        $querryteam="SELECT * FROM futsal_player WHERE id_team='$id_team'";
                        $totalplayer=mysqli_query($mysqli, $querryteam) or die(mysqli_error);
                        $querrycoachteam="SELECT * FROM futsal_coach WHERE id_team='$id_team'";
                        $coach=mysqli_query($mysqli, $querrycoachteam) or die(mysqli_error);
                        $coachdata = mysqli_fetch_array($coach);
                        if($coachdata!=NULL){
                            $coachname=$coachdata['coach_name'];
                        }else{
                            $coachname="Not Set"; } ?>
                    <tr>
                      <td><?php echo $a;?></td>
                      <td style="text-align:center;"><a href="/team_detail.php?id_team=<?php echo $id_team?>&id_activity=<?php echo $id_activity;?>&page=Competition"><img style="max-height:50px;" src="/img/team_logo/<?php echo $activityteamlist['team_logo'];?>.png"></a></td>
                      <td><?php echo $activityteamlist['team_name'];?></td>
                      <td><?php echo $activityteamlist['account_name'];?></td>
                      <td><?php echo $coachname;?></td>
                      <td><?php echo mysqli_num_rows($totalplayer)?></td>
                    </tr>
                  <?php $a++;} } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        </div>
      </div>
    </section>
    <?php } ?>
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
