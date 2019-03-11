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
              <a class="nav-link js-scroll-trigger" href="#myactivity">My activity</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#futsal-team">My futsal team</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead">
      <div class="container">
        <div class="intro-text">
            <div class="intro-lead-in">Create team for futsal competition</div>
            <div style="width:215px;margin:auto;padding:15px;margin-bottom:10px;">
                <a class="portfolio-link" data-toggle="modal" href="#createTeam">
                    <div class="portfolio-hover">
                    <div class="portfolio-hover-content">
                        <i style="padding:10px;" class="btn btn-primary btn-xl text-uppercase">Create Team</i>
                    </div>
                    </div>
                </a>
            </div>
        </div>
      </div>
    </header>

    <!-- My Activity -->
    <section class="bg-light" id="myactivity">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">Activity</h2>
            <h3 class="section-subheading text-muted">Your activity list</h3>
          </div>
        </div>
          <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-table"></i> Activity
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Event name</th>
                    <th>Event date</th>
                    <th>Event type</th>
                    <th>Event location</th>
                    <th>Payment status</th>
                    <th>Registration date</th>
                    <th>Detail</th>
                  </tr>
                </thead>
                <tfoot>
                  <tr>
                    <th>Event name</th>
                    <th>Event date</th>
                    <th>Event type</th>
                    <th>Event location</th>
                    <th>Payment status</th>
                    <th>Registration date</th>
                    <th>Detail</th>
                  </tr>
                </tfoot>
                <tbody>
                  <?php
                    $id_account = $_SESSION['id_account'];
                    $querrymyactivity="SELECT id_participant, account.id_account, activity.id_activity, activity.activity_name, DAY(activity.activity_date), MONTH(activity.activity_date), YEAR(activity.activity_date), activity.activity_description, activity.activity_status, activity.activity_type, activity.activity_location, activity.activity_fee, activity.activity_img, participant_payment_status, payment_status_img, DAY(participant_registration_date), MONTH(participant_registration_date), YEAR(participant_registration_date) FROM participant
                    INNER JOIN activity ON activity.id_activity=participant.id_activity
                    INNER JOIN account ON account.id_account=participant.id_account WHERE account.id_account = '$id_account'";
                    $activity2=mysqli_query($mysqli, $querrymyactivity) or die(mysqli_error);
                    $data=mysqli_query($mysqli, $querrymyactivity) or die(mysqli_error);
                    $checkdata = mysqli_fetch_array($data);
                      if(is_array($checkdata)==0){
                  ?>
                        <tr>
                            <td colspan="7" style="text-align:center;">You haven't joined any activities</td>
                        </tr>
                  <?php
                      }else{
                          $a=0;
                          while($activitydata2 = mysqli_fetch_array($activity2)){
                  ?>
                    <tr>
                      <td><?php echo $activitydata2['activity_name'];?></td>
                      <td><?php echo $activitydata2['DAY(activity.activity_date)'], " ",$month[$activitydata2['MONTH(activity.activity_date)']]," ",$activitydata2['YEAR(activity.activity_date)'];?></td>
                      <td><?php echo $activitydata2['activity_type'];?></td>
                      <td><?php echo $activitydata2['activity_location'];?></td>
                      <td><?php if($activitydata2['payment_status_img']=="Rejected"){echo "Rejected";}elseif($activitydata2['participant_payment_status']==1){echo "Complete";}elseif($activitydata2['payment_status_img']!=NULL){echo "On process";}else{echo "Not yet";}?></td>
                      <td><?php echo $activitydata2['DAY(participant_registration_date)']," ",$month[$activitydata2['MONTH(participant_registration_date)']]," ",$activitydata2['YEAR(participant_registration_date)'];?></td>
                      <td style="text-align:center;"><a href="" data-toggle="modal" data-target="#viewModal<?php echo $a+1;?>" data-tooltip="#view"><i class="fa fa-fw fa-eye"></i></a></td>
                    </tr>
                  <?php
                        $a++;
                          }
                      }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        </div>
      </div>
    </section>
    
    <!-- Team -->
    <section class="bg-light" id="futsal-team">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">Futsal Team</h2>
            <h3 class="section-subheading text-muted">Your list team</h3>
          </div>
        </div>
        <div class="row">
        <?php
        $querryteam="SELECT id_team, id_account, team_name, team_logo, team_uniform FROM futsal_team WHERE id_account='$id_account'";
        $team=mysqli_query($mysqli, $querryteam) or die(mysqli_error);
        $data=mysqli_query($mysqli, $querryteam) or die(mysqli_error);
        $checkdata = mysqli_fetch_array($data);
          if(is_array($checkdata)==0){
            echo "<div style='margin:auto;'>You haven't created any team</div>";
          }else{
        $a=0;
          while($teamdata1 = mysqli_fetch_array($team))
            {
        ?>
        <div style="text-align:center;" class="col-md-4 col-sm-6 portfolio-item">
          <div class="portfolio-caption">
            <h4><?php echo $teamdata1['team_name']; ?></h4>
          </div>
          <a class="portfolio-link" data-toggle="modal" href="#teamView<?php echo $a+1; ?>">
            <div class="portfolio-hover">
              <div class="portfolio-hover-content">
              <img style="margin-top:20px;height:230px;" class="img-fluid" src="/img/team_logo/<?php echo ceknullimg($teamdata1['team_logo']);?>.png" alt="">
              <label>Click logo to see team detail</label>
              </div>
            </div>
          </a>
          <div class="portfolio-caption">
          <a class="btn btn-primary" data-toggle="modal" href="#teamEdit<?php echo $a+1;?>"><i class="fa fa-pencil"></i> Edit</a>
          <a class="btn btn-primary" data-toggle="modal" href="#teamDelete<?php echo $a+1;?>"><i class="fa fa-trash"></i> Remove</a>
          </div>
        </div>
        <?php
        $a++;
            }
              
            }
        ?>
        </div>
      </div>
    </section>

    <!-- Delete Team Modal -->
    <?php
          $teamdelete=mysqli_query($mysqli, $querryteam) or die(mysqli_error);
          $a=0;
            while($teamdata3 = mysqli_fetch_array($teamdelete))
              {	$a++;
        ?>
    <div class="portfolio-modal modal fade" id="teamDelete<?php echo $a;?>" tabindex="-1" role="dialog" aria-hidden="true">
        <div style="max-width:500px;margin:auto;" class="modal-dialog">
        <div style="padding:20px;" class="modal-content">
            <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                <div class="modal-body">
                    <!-- Project Details Go Here -->
                    <p>Are you sure want to remove <?php echo $teamdata3['team_name'];?> with all player on this team?</p>
                    <a style="color:white;background-color:red;border-color:red;" href="/system/core/delete_team.php?id_team=<?php echo $teamdata3['id_team'];?>" class="btn btn-primary" type="submit"><i class="fa fa-trash"></i> Remove</a>
                    <button class="btn btn-primary" data-dismiss="modal" type="button"><i class="fa fa-times"></i> Cancel</button>
                </div>
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

    <!-- Edit Team Modal -->
    <?php
          $teamEdit=mysqli_query($mysqli, $querryteam) or die(mysqli_error);
          $a=0;
            while($teamdata4 = mysqli_fetch_array($teamEdit))
              {	$a++;
    ?>
    <div class="portfolio-modal modal fade" id="teamEdit<?php echo $a;?>" tabindex="-1" role="dialog" aria-hidden="true">
          <div style="max-width:800px;margin:auto;" class="modal-dialog">
            <div style="padding:20px;" class="modal-content">
                <div class="container">
                <div class="row">
                  <div class="col-lg-8 mx-auto">
                    <div class="modal-body">
                      <!-- Project Details Go Here -->
                      <h3 class="text-uppercase">Edit Team</h3>
                      <form action="/system/core/edit_team.php?id_team=<?php echo $teamdata4['id_team'];?>" method="POST" enctype="multipart/form-data">
                        <table class="tb-form">
                            <tr>
                                <td>Team name</td>
                                <td><input value="<?php echo $teamdata4['team_name'];?>" type="text" name="teamName" placeholder="Enter your team name" required></td>
                            </tr>
                            <tr>
                                <td>Team uniform color</td>
                                <td><input value="<?php echo $teamdata4['team_uniform'];?>" type="text" name="uniform" placeholder="Enter your team uniform color" required></td>
                            </tr>
                        </table>
                          <button class="btn btn-primary" name="editTeam" type="submit"><i class="fa fa-pencil"></i> Update</button>
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
        <?php
    }
    ?>

    <!-- Team View Modal -->
    <?php
          $teamModal=mysqli_query($mysqli, $querryteam) or die(mysqli_error);
          $a=0;
            while($teamModaldata = mysqli_fetch_array($teamModal))
              {	$a++;
        ?>
    <div class="portfolio-modal modal fade" id="teamView<?php echo $a;?>" tabindex="-1" role="dialog" aria-hidden="true">
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
                      <h2 class="text-uppercase"><?php echo $teamModaldata['team_name'] ?></h2>                 
                      <img class="img-fluid d-block mx-auto" src="/img/team_logo/<?php echo $teamModaldata['team_logo'];?>.png" alt="">
                      <div class="card mb-3">
                        <div class="card-header">
                          <i class="fa fa-table"></i> Player
                        </div>
                        <div class="card-body">
                        <div class="table-responsive">
                          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Number</th>
                                <th>Date of birth</th>
                                <th>Operation</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $id_team = $teamModaldata['id_team'];
                              $querryplayer="SELECT id_player, id_team, player_name, player_number, DAY(player_date_of_birth), MONTH(player_date_of_birth), YEAR(player_date_of_birth) FROM futsal_player WHERE id_team='$id_team' ORDER BY player_number ASC";
                              $playerdata=mysqli_query($mysqli, $querryplayer) or die(mysqli_error);
                              $playerdatacheck=mysqli_query($mysqli, $querryplayer) or die(mysqli_error);
                              $checkdata2 = mysqli_fetch_array($playerdatacheck);
                              if(is_array($checkdata2)==NULL){
                                ?>
                                  <tr>
                                      <td colspan="7" style="text-align:center;">You haven't add any player for this team, add now.</td>
                                  </tr>
                                <?php
                              }else{
                                  $b=1;
                                  while($player = mysqli_fetch_array($playerdata)){
                                ?>
                                <tr>
                                  <td><?php echo $b;?></td>
                                  <td><?php echo $player['player_name'];?></td>
                                  <td><?php echo $player['player_number'];?></td>
                                  <td><?php echo $player['DAY(player_date_of_birth)']," ",$month[$player['MONTH(player_date_of_birth)']]," ",$player['YEAR(player_date_of_birth)'];?></td>
                                  <td style="text-align:center;"><a href="" data-toggle="modal" data-target="#viewPlayer<?php echo $a.$b;?>" data-tooltip="#view"><i class="fa fa-fw fa-eye"></i></a> | <a href="" data-toggle="modal" data-target="#editPlayer<?php echo $a.$b;?>" data-tooltip="#edit"><i class="fa fa-fw fa-pencil"></i></a> | <a href="" data-toggle="modal" data-target="#deletePlayer<?php echo $a.$b;?>" data-tooltip="#delete"><i class="fa fa-fw fa-trash"></i></a></td>
                                </tr>
                              <?php
                                    $b++;
                                      }
                                  }
                              ?>
                            </tbody>
                          </table>
                        </div>
                        </div>
                        </div>
                        <div class="card mb-3">
                        <div class="card-header">
                          <i class="fa fa-table"></i> Coach
                        </div>
                        <div class="card-body">
                        <div class="table-responsive">
                          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Date of birth</th>
                                <th>Operation</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $id_team = $teamModaldata['id_team'];
                              $querrycoach="SELECT id_coach, id_team, coach_name, DAY(coach_date_of_birth), MONTH(coach_date_of_birth), YEAR(coach_date_of_birth) FROM futsal_coach WHERE id_team='$id_team'";
                              $coachdata=mysqli_query($mysqli, $querrycoach) or die(mysqli_error);
                              $coachdatacheck=mysqli_query($mysqli, $querrycoach) or die(mysqli_error);
                              $checkdata3 = mysqli_fetch_array($coachdatacheck);
                              if(is_array($checkdata3)==NULL){
                                ?>
                                  <tr>
                                      <td colspan="7" style="text-align:center;">You haven't add any coach for this team, add now.</td>
                                  </tr>
                                <?php
                              }else{
                                  $c=1;
                                  while($coach = mysqli_fetch_array($coachdata)){
                                ?>
                                <tr>
                                  <td><?php echo $c;?></td>
                                  <td><?php echo $coach['coach_name'];?></td>
                                  <td><?php echo $coach['DAY(coach_date_of_birth)']," ",$month[$coach['MONTH(coach_date_of_birth)']]," ",$coach['YEAR(coach_date_of_birth)'];?></td>
                                  <td style="text-align:center;"><a href="" data-toggle="modal" data-target="#viewCoach<?php echo $a.$c;?>" data-tooltip="#view"><i class="fa fa-fw fa-eye"></i></a> | <a href="" data-toggle="modal" data-target="#editCoach<?php echo $a.$c;?>" data-tooltip="#edit"><i class="fa fa-fw fa-pencil"></i></a> | <a href="" data-toggle="modal" data-target="#deleteCoach<?php echo $a.$c;?>" data-tooltip="#delete"><i class="fa fa-fw fa-trash"></i></a></td>
                                </tr>
                              <?php
                                    $c++;
                                      }
                                  }
                              ?>
                            </tbody>
                          </table>
                        </div>
                        </div>
                        </div>
                        <?php
                          if(is_array($checkdata3)==NULL){
                            ?>
                              <a style="color:white;" name="addCoachBtn" class="btn btn-primary" data-toggle="modal" data-target="#addCoach<?php echo $a;?>"><i class="fa fa-plus"></i> Add Coach</a>
                            <?php
                          }if(cek_team($mysqli, $id_team)==true){
                        ?>
                            <a style="color:white;" name="addPlayerBtn" class="btn btn-primary" data-toggle="modal" data-target="#addPlayer<?php echo $a;?>"><i class="fa fa-plus"></i> Add player</a>
                          <?php } ?>
                        <button class="btn btn-primary" data-dismiss="modal" type="button"><i class="fa fa-times"></i> Cancel</button>
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

    <!-- Delete Player -->
    <?php
      $deletePlayerTeam=mysqli_query($mysqli, $querryteam) or die(mysqli_error);
      $a=0;
        while($playerTeamDeleteData = mysqli_fetch_array($deletePlayerTeam))
          {	$a++;
            $id_team = $playerTeamDeleteData['id_team'];
            $querryplayer1="SELECT id_player, id_team, player_name, player_number FROM futsal_player WHERE id_team='$id_team'";
            $deletePlayer=mysqli_query($mysqli, $querryplayer1) or die(mysqli_error);
            $b=0;
            while($playerDeleteData = mysqli_fetch_array($deletePlayer))
            {	$b++;
    ?>
    <div style="z-index:1100;" class="portfolio-modal modal fade" id="deletePlayer<?php echo $a.$b;?>" tabindex="-1" role="dialog" aria-hidden="true">
      <div style="max-width:500px;margin:auto;" class="modal-dialog">
        <div style="padding:20px;" class="modal-content">
          <div class="container">
            <div class="row">
              <div class="col-lg-8 mx-auto">
                <div class="modal-body">
                  <!-- Project Details Go Here -->
                  <p>Are you sure want to remove <?php echo $playerDeleteData['player_name'];?> ?</p>
                  <a style="color:white;background-color:red;border-color:red;" href="/system/core/delete_player.php?id_player=<?php echo $playerDeleteData['id_player'];?>&id_team=<?php echo $playerDeleteData['id_team'];?>" class="btn btn-primary" type="submit"><i class="fa fa-trash"></i> Remove</a>
                  <button class="btn btn-primary" data-dismiss="modal" type="button"><i class="fa fa-times"></i> Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
        <?php
                }
            }
    ?>

    <!-- Edit Player -->
    <?php
      $editPlayerTeam=mysqli_query($mysqli, $querryteam) or die(mysqli_error);
      $a=0;
        while($playerTeamEditData = mysqli_fetch_array($editPlayerTeam))
          {	$a++;
            $id_team = $playerTeamEditData['id_team'];
            $querryplayer2="SELECT id_player, id_team, player_name, player_number, player_date_of_birth FROM futsal_player WHERE id_team='$id_team'";
            $editPlayer=mysqli_query($mysqli, $querryplayer2) or die(mysqli_error);
            $b=0;
            while($playerEditData = mysqli_fetch_array($editPlayer))
            {	$b++;
    ?>
    <div style="z-index:1100;" class="portfolio-modal modal fade" id="editPlayer<?php echo $a.$b;?>" tabindex="-1" role="dialog" aria-hidden="true">
      <div style="max-width:500px;margin:auto;" class="modal-dialog">
        <div style="padding:20px;" class="modal-content">
          <div class="container">
            <div class="row">
              <div class="col-lg-8 mx-auto">
                <div class="modal-body">
                  <h5>Edit player data</h5>
                  <form enctype="multipart/form-data" action="/system/core/edit_player.php?id_player=<?php echo $playerEditData['id_player'];?>&id_team=<?php echo $playerTeamEditData['id_team'];?>" method="POST">
                    <table class="tb-form">
                      <tr>
                          <td>Name</td>
                          <td><input value="<?php echo $playerEditData['player_name'];?>" type="text" name="name" required></td>
                      </tr>
                      <tr>
                          <td>Number</td>
                          <td><input value="<?php echo $playerEditData['player_number'];?>" type="text" name="number" required></td>
                      </tr>
                      <tr>
                          <td>Date of Birth</td>
                          <td><input value="<?php echo $playerEditData['player_date_of_birth'];?>" type="date" name="birthday" required></td>
                      </tr>
                      <tr>
                          <td>Change Photo</td>
                          <td><input type="file" name="photo" placeholder="Select photo file"></td>
                      </tr>
                      <tr>
                          <td>Change Req</td>
                          <td><input type="file" name="req" placeholder="Select req file"></td>
                      </tr>
                    </table>
                    </div>
                      <button name="editPlayer" class="btn btn-primary" type="submit"><i class="fa fa-pencil"></i> Update</button>
                      <button class="btn btn-primary" data-dismiss="modal" type="button"><i class="fa fa-times"></i> Cancel</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
        <?php
                }
            }
    ?>

    <!-- View Player -->
    <?php
      $viewPlayerTeam=mysqli_query($mysqli, $querryteam) or die(mysqli_error);
      $a=0;
        while($playerTeamViewData = mysqli_fetch_array($viewPlayerTeam))
          {	$a++;
            $id_team = $playerTeamViewData['id_team'];
            $querryplayer3="SELECT id_player, id_team, player_name, player_number, player_date_of_birth, player_img FROM futsal_player WHERE id_team='$id_team'";
            $viewPlayer=mysqli_query($mysqli, $querryplayer3) or die(mysqli_error);
            $b=0;
            while($playerViewData = mysqli_fetch_array($viewPlayer))
            {	$b++;
    ?>
    <div style="z-index:1100;" class="portfolio-modal modal fade" id="viewPlayer<?php echo $a.$b;?>" tabindex="-1" role="dialog" aria-hidden="true">
      <div style="max-width:500px;margin:auto;" class="modal-dialog">
        <div style="padding:20px;" class="modal-content">
          <div class="container">
            <div class="row">
              <div class="col-lg-8 mx-auto">
                <div class="modal-body">
                <h5>Player data</h5>
                <img class="img-fluid d-block mx-auto" src="/img/player/<?php echo $playerViewData['player_img'];?>.jpg" alt="">
                <ul class="list-inline">
                  <li>Name: <?php echo $playerViewData['player_name'];?></li>
                  <li>Number: <?php echo $playerViewData['player_number'];?></li>
                  <li>Age: <?php echo age($playerViewData['player_date_of_birth'])?></li>
                </ul>
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
            }
    ?>

    <!-- Delete Coach -->
    <?php
      $deleteCoachTeam=mysqli_query($mysqli, $querryteam) or die(mysqli_error);
      $a=0;
        while($coachTeamData = mysqli_fetch_array($deleteCoachTeam))
          {	$a++;
            $id_team = $coachTeamData['id_team'];
            $b=0;
            $querrycoach1="SELECT id_coach, id_team, coach_name, DAY(coach_date_of_birth), MONTH(coach_date_of_birth), YEAR(coach_date_of_birth) FROM futsal_coach WHERE id_team='$id_team'";
            $deleteCoach=mysqli_query($mysqli, $querrycoach1) or die(mysqli_error);
            while($coachData = mysqli_fetch_array($deleteCoach))
            {	$b++;
    ?>
    <div style="z-index:1100;" class="portfolio-modal modal fade" id="deleteCoach<?php echo $a.$b;?>" tabindex="-1" role="dialog" aria-hidden="true">
      <div style="max-width:500px;margin:auto;" class="modal-dialog">
        <div style="padding:20px;" class="modal-content">
          <div class="container">
            <div class="row">
              <div class="col-lg-8 mx-auto">
                <div class="modal-body">
                  <!-- Project Details Go Here -->
                  <p>Are you sure want to remove coach <?php echo $coachData['coach_name'];?> ?</p>
                  <a style="color:white;background-color:red;border-color:red;" href="/system/core/delete_coach.php?id_coach=<?php echo $coachData['id_coach'];?>" class="btn btn-primary" type="submit"><i class="fa fa-trash"></i> Remove</a>
                  <button class="btn btn-primary" data-dismiss="modal" type="button"><i class="fa fa-times"></i> Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
        <?php
            }
          }
    ?>

    <!-- Edit Coach -->
    <?php
      $editCoachTeam=mysqli_query($mysqli, $querryteam) or die(mysqli_error);
      $a=0;
        while($coachrTeamEditData = mysqli_fetch_array($editCoachTeam))
          {	$a++;
            $id_team = $coachrTeamEditData['id_team'];
            $querrycoach2="SELECT id_coach, id_team, coach_name, coach_date_of_birth FROM futsal_coach WHERE id_team='$id_team'";
            $editCoach=mysqli_query($mysqli, $querrycoach2) or die(mysqli_error);
            $b=0;
            while($coachEditData = mysqli_fetch_array($editCoach))
            {	$b++;
    ?>
    <div style="z-index:1100;" class="portfolio-modal modal fade" id="editCoach<?php echo $a.$b;?>" tabindex="-1" role="dialog" aria-hidden="true">
      <div style="max-width:500px;margin:auto;" class="modal-dialog">
        <div style="padding:20px;" class="modal-content">
          <div class="container">
            <div class="row">
              <div class="col-lg-8 mx-auto">
                <div class="modal-body">
                  <h5>Edit coach data</h5>
                  <form enctype="multipart/form-data" action="/system/core/edit_coach.php?id_coach=<?php echo $coachEditData['id_coach'];?>" method="POST">
                    <table class="tb-form">
                      <tr>
                          <td>Name</td>
                          <td><input value="<?php echo $coachEditData['coach_name'];?>" type="text" name="name" required></td>
                      </tr>
                      <tr>
                          <td>Date of Birth</td>
                          <td><input value="<?php echo $coachEditData['coach_date_of_birth'];?>" type="date" name="birthday" required></td>
                      </tr>
                      <tr>
                          <td>Change Photo</td>
                          <td><input type="file" name="photo" placeholder="Select req file"></td>
                      </tr>
                    </table>
                    </div>
                      <button name="editCoach" class="btn btn-primary" type="submit"><i class="fa fa-pencil"></i> Update</button>
                      <button class="btn btn-primary" data-dismiss="modal" type="button"><i class="fa fa-times"></i> Cancel</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
        <?php
                }
            }
    ?>

    <!-- View Coach -->
    <?php
      $viewCoachTeam=mysqli_query($mysqli, $querryteam) or die(mysqli_error);
      $a=0;
        while($coachTeamViewData = mysqli_fetch_array($viewCoachTeam))
          {	$a++;
            $id_team = $coachTeamViewData['id_team'];
            $querryCoach3="SELECT id_coach, id_team, coach_name, coach_date_of_birth, coach_img FROM futsal_coach WHERE id_team='$id_team'";
            $viewCoach=mysqli_query($mysqli, $querryCoach3) or die(mysqli_error);
            $b=0;
            while($coachViewData = mysqli_fetch_array($viewCoach))
            {	$b++;
    ?>
    <div style="z-index:1100;" class="portfolio-modal modal fade" id="viewCoach<?php echo $a.$b;?>" tabindex="-1" role="dialog" aria-hidden="true">
      <div style="max-width:500px;margin:auto;" class="modal-dialog">
        <div style="padding:20px;" class="modal-content">
          <div class="container">
            <div class="row">
              <div class="col-lg-8 mx-auto">
                <div class="modal-body">
                <h5>coach data</h5>
                <img class="img-fluid d-block mx-auto" src="/img/coach/<?php echo $coachViewData['coach_img'];?>.jpg" alt="">
                <ul class="list-inline">
                  <li>Name: <?php echo $coachViewData['coach_name'];?></li>
                  <li>Age: <?php echo age($coachViewData['coach_date_of_birth'])?></li>
                </ul>
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
            }
    ?>

    <!-- Activity View Modal -->
    <?php
          $activity3=mysqli_query($mysqli, $querrymyactivity) or die(mysqli_error);
          $a=0;
            while($activitydata3 = mysqli_fetch_array($activity3))
              {	$a++;
    ?>
    <div class="portfolio-modal modal fade" id="viewModal<?php echo $a;?>" tabindex="-1" role="dialog" aria-hidden="true">
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
                      <h2 class="text-uppercase"><?php echo $activitydata3['activity_name'] ?></h2>
                      <p class="item-intro text-muted">Event for <?php echo $activitydata3['DAY(activity.activity_date)'], " ", $month[$activitydata3['MONTH(activity.activity_date)']]," ", $activitydata3['YEAR(activity.activity_date)'];?></p>
                      <img class="img-fluid d-block mx-auto" src="/img/activity/<?php echo $activitydata3['activity_img'];?>.jpg" alt="">
                      <p><?php echo $activitydata3['activity_description'] ?></p>
                      <ul class="list-inline">
                        <?php if($activitydata3['activity_type']=="General"){ if(date('Y-m-d',strtotime($activitydata3['activity_date']))==date('Y-m-d',strtotime($activitydata3['activity_end']))){ ?>
                        <li>Start from: <?php echo date('H:i',strtotime($activitydata3['activity_date']));?> until <?php echo date('H:i',strtotime($activitydata3['activity_end']));?></li>
                        <?php }else{ ?>
                        <li>Start from: <?php echo date('d F Y H:i',strtotime($activitydata3['activity_date']));?> WIB until <?php echo date('d F Y H:i',strtotime($activitydata3['activity_end']));?> WIB</li>
                        <?php }} ?>
                        <li>Location: <?php echo $activitydata3['activity_location'];?></li>
                        <li>Status: <?php echo $activitydata3['activity_status'];?></li>
                        <li>Type: <?php echo $activitydata3['activity_type'];?></li>
                        <li>Registratin fee: <?php if($activitydata3['activity_fee']==0){ echo "Free";}else{echo rupiah($activitydata3['activity_fee']);} if($activitydata3['activity_type']=='Futsal'){echo "/Team";}else{echo "/Person";}?></li>
                        <?php
                          $id_activity = $activitydata3['id_activity'];
                          $querryfutsaldetail="SELECT participant.id_activity, futsal_team.id_team, futsal_team.id_account, futsal_team.team_name FROM futsal_detail INNER JOIN futsal_team ON futsal_team.id_team=futsal_detail.id_team INNER JOIN participant ON participant.id_participant=futsal_detail.id_participant WHERE participant.id_activity='$id_activity' AND futsal_team.id_account='$id_account'";
                          $teamdata2=mysqli_query($mysqli, $querryfutsaldetail) or die(mysqli_error);
                          $teamdetailcheck=mysqli_query($mysqli, $querryfutsaldetail) or die(mysqli_error);
                          $checkdata1 = mysqli_fetch_array($teamdetailcheck);
                          if($checkdata1['participant_status_img']!=NULL){
                              $payment="On process";
                          }
                          if($activitydata3['activity_type']=='Futsal'){
                            if(is_array($checkdata1)==NULL){
                              ?>
                                <li>You haven't add any team for this activity, add now!</li>
                              <?php
                            }else{
                              ?>
                                <li>Team registered :</li>
                              <?php
                              $b=0;
                              while($detailteam = mysqli_fetch_array($teamdata2)){
                                $b++;
                              ?>
                                <li><?php echo "$b. ".$detailteam['team_name']; ?></li>
                              <?php
                              }
                            }
                          }
                          if($activitydata3['activity_type']=='Futsal' && $b!=0){
                        ?>
                        <li>Total payment : <?php echo rupiah($b*$activitydata3['activity_fee']);?></li>
                        <?php
                      }elseif($activitydata3['activity_type']=='General'){
                        ?>
                        <li>Total payment : <?php echo rupiah($activitydata3['activity_fee']);?></li>
                      <?php } ?>
                      <li>Payment status : <?php if($activitydata3['payment_status_img']=="Rejected"){echo "Rejected";}elseif($activitydata3['participant_payment_status']==1){echo "Complete";}elseif($activitydata3['payment_status_img']!=NULL){echo "On process";}else{echo "Not yet";}?></li>
                      </ul>
                      <button class="btn btn-primary" data-dismiss="modal" type="button"><i class="fa fa-times"></i> Close</button>
                      <?php if($activitydata3['participant_payment_status']!=1){ ?>
                        <a href="" class="btn btn-primary" data-toggle="modal" data-target="#uploadPayment<?php echo $a;?>"><i class="fa fa-money"></i> Payment</a>
                      <?php } ?>
                        <?php
                        if($activitydata3['activity_type']=="Futsal"){
                            if(is_array($checkdata1)!=NULL){
                              ?>
                                <a style="color:white;" class="btn btn-primary" data-toggle="modal" data-target="#removeTeam<?php echo $a;?>"><i class="fa fa-trash"></i> Remove team</a>
                              <?php
                            }
                          ?>
                            <a style="color:white;" name="addTeamBtn" class="btn btn-primary" data-toggle="modal" data-target="#addTeam<?php echo $a;?>"><i class="fa fa-plus"></i> Add team</a>
                            <a href="/account/public/competition-team.php?id_activity=<?php echo $activitydata3['id_activity'];?>" style="color:white;" class="btn btn-primary"><i class="fa fa-eye"></i> Competition</a>
                            <p>Click competition button above for competition detail</p>
                          <?php
                        }
                        ?>
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

        <!-- Upload Payment -->
        <?php
          $activity6=mysqli_query($mysqli, $querrymyactivity) or die(mysqli_error);
          $a=0;
            while($activitydata6 = mysqli_fetch_array($activity6))
              {	$a++;
                $id_activity=$activitydata6['id_activity'];
                $querypart="SELECT * FROM participant WHERE id_activity='$id_activity' AND id_account='$id_account'";
                $querydata=mysqli_query($mysqli, $querypart);
                $datapart=mysqli_fetch_array($querydata);
                $id_participant=$datapart['id_participant'];
    ?>
    <div class="portfolio-modal modal fade" id="uploadPayment<?php echo $a;?>" tabindex="-1" role="dialog" aria-hidden="true">
          <div style="max-width:510px;margin:auto;" class="modal-dialog">
            <div style="padding:20px;" class="modal-content">
                <div class="container">
                <div class="row">
                  <div class="col-lg-8 mx-auto">
                    <div class="modal-body">
                      <!-- Project Details Go Here -->
                      <h5 class="text-uppercase">Upload proof of payment</h5>
                      <img class="img-fluid d-block mx-auto" src="/img/participant/<?php echo $datapart['payment_status_img'];?>.jpg" alt="">
                      <form action="/system/core/upload_payment.php?id_participant=<?php echo $id_participant;?>&img=<?php echo $datapart['payment_status_img'];?>&activity=<?php echo $activitydata6['activity_name'];?>" method="POST" enctype="multipart/form-data">
                        <input type="file" name="payment_img" placeholder="Upload photo" required>
                        <button class="btn btn-primary" name="payment_upload" type="submit"><i class="fa fa-upload"></i> Upload</button>
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
        <?php
    }
    ?>

    <!-- Add Team Modal -->
    <?php
          $activity4=mysqli_query($mysqli, $querrymyactivity) or die(mysqli_error);
          $a=0;
            while($activitydata4 = mysqli_fetch_array($activity4))
              {	$a++;
        ?>
    <div style="z-index:1100;" class="portfolio-modal modal fade" id="addTeam<?php echo $a;?>" tabindex="-1" role="dialog" aria-hidden="true">
          <div style="max-width:500px;margin:auto;" class="modal-dialog">
            <div style="height:195px;padding:20px;" class="modal-content">
                <div class="container">
                <div class="row">
                  <div class="col-lg-8 mx-auto">
                    <div class="modal-body">
                      <!-- Project Details Go Here -->
                      <h5>Choose your team</h5>
                      <form action="/system/core/add_team.php?id_participant=<?php echo $activitydata4['id_participant'];?>&id_activity=<?php echo $activitydata4['id_activity'];?>" method="POST">
                        <select name="team">
                        <?php
                          $addteamquerry=mysqli_query($mysqli, $querryteam) or die(mysqli_error);
                          $b=0;
                          while($teamdata = mysqli_fetch_array($addteamquerry))
                              {	$b++;
                        ?>
                          <option value="<?php echo $teamdata['id_team'];?>"><?php echo $teamdata['team_name'];?></option>
                          <?php
                              }
                          ?>
                        </select>
                    </div>
                      <button name="addTeam" class="btn btn-primary" type="submit"><i class="fa fa-plus"></i> Add</button>
                      <button class="btn btn-primary" data-dismiss="modal" type="button"><i class="fa fa-times"></i> Close</button>
                  </div>
                  </form>
                </div>
              </div>
              </div>
            </div>
          </div>
        </div>
        <?php
    }
    ?>

    <!-- Remove Team -->
    <?php
          $activity5=mysqli_query($mysqli, $querrymyactivity) or die(mysqli_error);
          $a=0;
            while($activitydata5 = mysqli_fetch_array($activity5))
              {	$a++;
                $id_participant = $activitydata5['id_participant'];
        ?>
    <div style="z-index:1100;" class="portfolio-modal modal fade" id="removeTeam<?php echo $a;?>" tabindex="-1" role="dialog" aria-hidden="true">
          <div style="max-width:500px;margin:auto;" class="modal-dialog">
            <div style="height:195px;padding:20px;" class="modal-content">
                <div class="container">
                <div class="row">
                  <div class="col-lg-8 mx-auto">
                    <div class="modal-body">
                      <!-- Project Details Go Here -->
                      <h5>Choose your team</h5>
                      <form action="/system/core/remove_team.php?id_participant=<?php echo $id_participant?>" method="POST">
                        <select name="team">
                        <?php
                          $querryremoveteam = "SELECT id_futsal_detail, participant.id_activity, futsal_team.id_team, futsal_team.id_account, futsal_team.team_name FROM futsal_detail INNER JOIN futsal_team ON futsal_team.id_team=futsal_detail.id_team INNER JOIN participant ON participant.id_participant=futsal_detail.id_participant WHERE participant.id_activity='$id_activity' AND futsal_team.id_account='$id_account'";
                          $removeteam=mysqli_query($mysqli, $querryremoveteam) or die(mysqli_error);
                          $b=0;
                          while($teamdata5 = mysqli_fetch_array($removeteam))
                              {	$b++;
                        ?>
                          <option value="<?php echo $teamdata5['id_team'];?>"><?php echo $teamdata5['team_name'];?></option>
                          <?php
                              }
                          ?>
                        </select>
                    </div>
                      <button name="removeTeam" class="btn btn-primary" type="submit"><i class="fa fa-plus"></i> Remove</button>
                      <button class="btn btn-primary" data-dismiss="modal" type="button"><i class="fa fa-times"></i> Close</button>
                  </div>
                  </form>
                </div>
              </div>
              </div>
            </div>
          </div>
        </div>
        <?php
    }
    ?>

    <!-- Add Player -->
        <?php
          $playerModal=mysqli_query($mysqli, $querryteam) or die(mysqli_error);
          $a=0;
            while($playerModaldata = mysqli_fetch_array($playerModal))
              {	$a++;
        ?>
    <div style="z-index:1100;" class="portfolio-modal modal fade" id="addPlayer<?php echo $a;?>" tabindex="-1" role="dialog" aria-hidden="true">
          <div style="max-width:900px;margin:auto;" class="modal-dialog">
            <div class="modal-content">
                <div class="container">
                <div class="row">
                  <div class="col-lg-8 mx-auto">
                    <div class="modal-body">
                      <!-- Project Details Go Here -->
                      <h5>Add Player to <?php echo $playerModaldata['team_name'];?></h5>
                      <form action="/system/core/add_player.php?id_team=<?php echo $playerModaldata['id_team'];?>" method="POST" enctype="multipart/form-data">
                        <table class="tb-form">
                          <tr>
                              <td>Name</td>
                              <td><input type="text" name="name" required></td>
                          </tr>
                          <tr>
                              <td>Number</td>
                              <td><input type="number" name="number" min="1" max="99" required></td>
                          </tr>
                          <tr>
                              <td>Date of Birth</td>
                              <td><input type="date" name="birthday" required></td>
                          </tr>
                          <tr>
                            <td>Player photo</td>
                            <td><input type="file" name="photo" placeholder="Upload player photo" required></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td style="font-size:10px;">Note: File extension must be 500x500 resolution and .jpg file image.</td>
                          </tr>
                          <tr>
                            <td>Player requirement document</td>
                            <td><input type="file" name="requirement" placeholder="Upload player requirement" required></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td style="font-size:10px;">Student Card/Certificate from school/Identity Card/Birth certificate</td>
                          </tr>
                          <tr>
                            <td></td>
                            <td style="font-size:10px;">Note: File extension must be .jpg file image.</td>
                          </tr>
                        </table>
                        </div>
                          <button name="addPlayer" class="btn btn-primary" type="submit"><i class="fa fa-plus"></i> Add</button>
                          <button class="btn btn-primary" data-dismiss="modal" type="button"><i class="fa fa-times"></i> Cancel</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
    }
    ?>

     <!-- Add Coach -->
     <?php
          $coachModal=mysqli_query($mysqli, $querryteam) or die(mysqli_error);
          $a=0;
            while($coachModaldata = mysqli_fetch_array($coachModal))
              {	$a++;
        ?>
    <div style="z-index:1100;" class="portfolio-modal modal fade" id="addCoach<?php echo $a;?>" tabindex="-1" role="dialog" aria-hidden="true">
          <div style="max-width:900px;margin:auto;" class="modal-dialog">
            <div class="modal-content">
                <div class="container">
                <div class="row">
                  <div class="col-lg-8 mx-auto">
                    <div class="modal-body">
                      <!-- Project Details Go Here -->
                      <h5>Add Coach to <?php echo $coachModaldata['team_name'];?></h5>
                      <form action="/system/core/add_coach.php?id_team=<?php echo $coachModaldata['id_team'];?>" method="POST" enctype="multipart/form-data">
                        <table class="tb-form">
                          <tr>
                              <td>Name</td>
                              <td><input type="text" name="name" required></td>
                          </tr>
                          <tr>
                              <td>Date of Birth</td>
                              <td><input type="date" name="birthday" required></td>
                          </tr>
                          <tr>
                            <td>Coach photo</td>
                            <td><input type="file" name="photo" placeholder="Upload player photo" required></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td style="font-size:10px;">Note: File extension must be 500x500 resolution and and .jpg file image.</td>
                          </tr>
                        </table>
                        </div>
                          <button name="addCoach" class="btn btn-primary" type="submit"><i class="fa fa-plus"></i> Add</button>
                          <button class="btn btn-primary" data-dismiss="modal" type="button"><i class="fa fa-times"></i> Cancel</button>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
    }
    ?>

    <!-- Create Team -->
    <div class="portfolio-modal modal fade" id="createTeam" tabindex="-1" role="dialog" aria-hidden="true">
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
                  <h3 class="text-uppercase">Create Team</h3>
                  <form action="/system/core/new_team.php" method="POST" enctype="multipart/form-data">
                    <table class="tb-form">
                        <tr>
                            <td>Team name</td>
                            <td><input style="max-width:65%;" type="text" name="teamName" placeholder="Enter your team name" required></td>
                        </tr>
                        <tr>
                            <td>Team uniform color</td>
                            <td><input style="max-width:65%;" type="text" name="uniform" placeholder="Enter your team uniform color" required></td>
                        </tr>
                        <tr>
                            <td>Team logo</td>
                            <td><input type="file" name="teamLogo" placeholder="Upload team logo" required></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="font-size:10px;">Note: File extension must be .png file image</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td style="font-size:10px;">and 500x500 resolution</td>
                        </tr>
                    </table>
                      <button class="btn btn-primary" name="newTeam" type="submit"><i class="fa fa-plus"></i> Create team</button>
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

    <div style="position:absolute;display:none;background-color:lightblue;border-radius:2px;padding:3px;" id="view">View more</div>

    <!-- Bootstrap core JavaScript -->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="/vendor/datatables/jquery.dataTables.js"></script>
    <script src="/js/sb-admin-datatables.min.js"></script>

    <!-- Contact form JavaScript -->
    <script src="/js/jqBootstrapValidation.js"></script>
    <script src="/js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="/js/agency.min.js"></script>

  </body>

</html>
