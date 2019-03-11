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
  <!-- Page level plugin CSS-->
  <link href="/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="/css/sb-admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<?php
  include('../../system/core/connection.php');
  include('../../system/querry/querry_all.php');
  include('../../system/function.php');
  include('../../system/session/admin_page_session.php');
  $id_activity = $_GET['id_activity'];
?>
  <!-- Navigation-->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.html">Maharcorps</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="index.php">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-file"></i>
            <span class="nav-link-text">Content</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePages">
            <li>
              <a href="activity.php">Activity</a>
            </li>
            <li>
              <a href="news.php">News</a>
            </li>
            <li>
              <a href="about.php">About</a>
            </li>
            <li>
              <a href="announcement.php">Announcement</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Menu Levels">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-table"></i>
            <span class="nav-link-text">Data</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseMulti">
            <li>
              <a href="account.php">Account</a>
            </li>
            <li>
              <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti2">Futsal</a>
              <ul class="sidenav-third-level collapse" id="collapseMulti2">
                <li>
                  <a href="futsal_team.php">Team</a>
                </li>
                <li>
                  <a href="futsal_player.php">Player</a>
                </li>
                <li>
                  <a href="futsal_referee.php">Referee</a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Setting</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
              <a href="navbar.html">Navbar</a>
            </li>
            <li>
              <a href="cards.html">Cards</a>
            </li>
          </ul>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
          <a class="nav-link" href="#">
            <i class="fa fa-fw fa-link"></i>
            <span class="nav-link-text">Link</span>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="/system/core/admin_logout.php">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>
    <?php
        $querryactivitydetail="SELECT id_activity_futsal_detail, activity.id_activity, activity.activity_name, activity.activity_date, competition_system, technical_meeting_date, meeting_location, competition_maxteam FROM activity_futsal_detail INNER JOIN activity ON activity.id_activity=activity_futsal_detail.id_activity WHERE activity.id_activity='$id_activity'";
        $detaildata=mysqli_query($mysqli, $querryactivitydetail) or die(mysqli_error);
        $futsaldetaildata=mysqli_fetch_array($detaildata);
        $querryactivity="SELECT * FROM activity WHERE id_activity='$id_activity'";
        $activitydata=mysqli_query($mysqli, $querryactivity) or die(mysqli_error);
        $activity=mysqli_fetch_array($activitydata);
        $detail=$futsaldetaildata['id_activity_futsal_detail'];
        $querrytechmeet="SELECT competition_system, technical_meeting_date FROM activity_futsal_detail WHERE id_activity_futsal_detail='$detail'";
        $techmetdata=mysqli_query($mysqli, $querrytechmeet) or die(mysqli_error);
        $systemtechmet = mysqli_fetch_array($techmetdata);
        $id_activity_futsal_detail=$futsaldetaildata['id_activity_futsal_detail'];
        $querrymatch="SELECT id_match, id_activity_futsal_detail, Home, Away, id_referee_1, id_referee_2, match_time, DAY(match_time), MONTH(match_time), YEAR(match_time), match_field FROM futsal_match WHERE id_activity_futsal_detail='$id_activity_futsal_detail'";
        $matchdata=mysqli_query($mysqli, $querrymatch) or die(mysqli_error);
        $matchtotal=mysqli_query($mysqli, $querrymatch) or die(mysqli_error);
        $matchtotal=mysqli_num_rows($matchtotal)+1;
        $ceckmatch=mysqli_query($mysqli, $querrymatch) or die(mysqli_error);
        $matchcheck=mysqli_fetch_array($ceckmatch);
        $querrymatchnull="SELECT * FROM futsal_match WHERE id_activity_futsal_detail='$id_activity_futsal_detail' AND match_time IS NULL";
        $ceckmatchnull=mysqli_query($mysqli, $querrymatchnull) or die(mysqli_error);
        $matchchecknull=mysqli_fetch_array($ceckmatchnull);
        $querrymatchdate="SELECT match_time FROM futsal_match WHERE id_activity_futsal_detail='$id_activity_futsal_detail' AND match_time IS NOT NULL ORDER BY match_time DESC LIMIT 1";
        $ceckmatchdate=mysqli_query($mysqli, $querrymatchdate) or die(mysqli_error);
        $matchcheckdate=mysqli_fetch_array($ceckmatchdate);
        if($matchcheckdate['match_time']!=NULL){
            $lastdate=date('Y-m-d',strtotime($matchcheckdate['match_time']));
        }else{
            $lastdate=NULL;
        }
    ?>
  <!-- Content -->
  <div class="content-wrapper">
    <div class="container-fluid">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <p>Content</p>
        </li>
        <li class="breadcrumb-item active"><a style="text-decoration:none;" href="activity.php">Activity</a></li>
        <li class="breadcrumb-item active">Competition</li>
      </ol>
      <?php
      if($systemtechmet['competition_system']==NULL||$systemtechmet['technical_meeting_date']==NULL){
      ?>
      <h4 style="text-align:center;">Update competition system and technical meeting date first</h4>
      <?php
      }
      $techdate="";
      $mindate=date($activity['activity_registration_end'].'\T00:00:00');
      $maxdate=date($activity['activity_date'].'\T00:00:00');
      if($futsaldetaildata['technical_meeting_date']!=NULL){$techdate=date('Y-m-d\TH:i', strtotime($futsaldetaildata['technical_meeting_date']));}
      ?>
      <h4 style="text-align:center;"><?php echo $futsaldetaildata['activity_name']?></h4>
      <form method="post" action="/system/core/edit_futsal_detail.php?id_activity=<?php echo $id_activity;?>">
        <div class="form-group">
            <label>Competition system</label>
            <select name="system" class="form-control" required>
                <option value="">Select competition system</option>
                <option value="Knockout" <?php echo ($futsaldetaildata['competition_system'] == 'Knockout')? 'selected="selected"':'';?>>Knockout</option>
            </select>
        </div>
        <div class="form-group">
            <label>Max team</label>
            <input class="form-control" type="number" min="2" name="maxteam" value="<?php echo $futsaldetaildata['competition_maxteam']?>" placeholder="Enter max team number" required>
        </div>
        <div class="form-group">
            <label>Technical meeting date</label>
            <input class="form-control" min="<?php echo $mindate;?>" max="<?php echo $maxdate;?>" type="datetime-local" name="meeting" value="<?php echo $techdate;?>" required>
        </div>
        <div class="form-group">
            <label>Meeting location</label>
            <input class="form-control" type="text" name="location" value="<?php echo $futsaldetaildata['meeting_location']?>" placeholder="Enter meeting location" required>
        </div>
        <button type="submit" style="margin-bottom:20px;color:white;" name="update-detail" class="btn btn-primary btn-block"><i class="fa fa-pencil"></i> Update detail</button>
      </form>

      <!-- TOP SCORE -->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Top Score</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Team name</th>
                  <th>Player Name</th>
                  <th>Player Number</th>
                  <th>Total Goal</th>
                </tr>
              </thead>
              <tbody>
                <?php
                    $querrytopscore="SELECT futsal_team.team_name, futsal_player.player_name, futsal_player.player_number, COUNT(*) AS score FROM match_goal INNER JOIN futsal_player ON futsal_player.id_player=match_goal.goal INNER JOIN futsal_team ON futsal_team.id_team=futsal_player.id_team GROUP BY goal HAVING COUNT(goal) >0 LIMIT 5";
                    $topscore=mysqli_query($mysqli, $querrytopscore) or die(mysqli_error);
                    $cekscore=mysqli_query($mysqli, $querrytopscore) or die(mysqli_error);
                    $cekscoredata=mysqli_fetch_array($cekscore);
                    $a=1;
                    if($cekscoredata==NULL){ ?>
                        <td colspan="5"align="center">There's no any goal yet.</td>
                    <?php
                    }else{
                        while($topscoredata=mysqli_fetch_array($topscore)){ ?>
                        <tr>
                        <td><?php echo $a;?></td>
                        <td><?php echo $topscoredata['team_name'];?></td>
                        <td><?php echo $topscoredata['player_name'];?></td>
                        <td><?php echo $topscoredata['player_number'];?></td>
                        <td><?php echo $topscoredata['score'];?></td>
                        </tr>
                    <?php $a++;} } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
<?php
if($systemtechmet['competition_system']!=NULL||$systemtechmet['technical_meeting_date']!=NULL){
?>
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Team registered list | <a class="btn btn-primary" target="_blank" href="/system/core/print_registered_team.php?id_activity=<?php echo $id_activity; ?>"><i class="fa fa-fw fa-download"></i> Download</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Team name</th>
                  <th>Manager</th>
                  <th>Coach</th>
                  <th>Total player</th>
                  <th>Operation</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>Team name</th>
                  <th>Manager</th>
                  <th>Coach</th>
                  <th>Total player</th>
                  <th>Operation</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
                    $querryteamactivity="SELECT id_futsal_detail, participant.id_activity, futsal_team.id_team, account.id_account, account.account_name, futsal_team.team_name, futsal_team.team_logo FROM futsal_detail INNER JOIN participant ON participant.id_participant=futsal_detail.id_participant INNER JOIN futsal_team ON futsal_team.id_team=futsal_detail.id_team INNER JOIN account ON futsal_team.id_account=account.id_account WHERE id_activity='$id_activity'";
                    $activityteamdata=mysqli_query($mysqli, $querryteamactivity) or die(mysqli_error);
                    $a=1;
                    while($activityteam = mysqli_fetch_array($activityteamdata)){
                      $id_team=$activityteam['id_team'];
                      $querryteam="SELECT * FROM futsal_player WHERE id_team='$id_team'";
                      $totalplayer=mysqli_query($mysqli, $querryteam) or die(mysqli_error);
                      $querrycoachteam="SELECT * FROM futsal_coach WHERE id_team='$id_team'";
                      $coach=mysqli_query($mysqli, $querrycoachteam) or die(mysqli_error);
                      $coachdata = mysqli_fetch_array($coach);
                      if($coachdata!=NULL){
                        $coachname=$coachdata['coach_name'];
                    }else{
                        $coachname="Not Yet";
                    }
                      ?>
                    <tr>
                      <td><?php echo $a;?></td>
                      <td><?php echo $activityteam['team_name'];?></td>
                      <td><?php echo $activityteam['account_name'];?></td>
                      <td><?php echo $coachname;?></td>
                      <td><?php echo mysqli_num_rows($totalplayer)?></td>
                      <td style="text-align:center;"><a href="" data-toggle="modal" data-target="#deleteteamModal<?php echo $a;?>" data-tooltip="#remove"><i class="fa fa-fw fa-trash"></i></a></td>
                    </tr>
                <?php
                    $a++;}
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- Content Input Match -->
      <h4 style="text-align:center;">Input <?php echo ordinal($matchtotal);?> Match</h4>
      <form method="post" action="/system/core/add_match.php?id_activity_futsal_detail=<?php echo $futsaldetaildata['id_activity_futsal_detail'];?>&id_activity=<?php echo $id_activity;?>">
        <div class="form-group">
            <div class="form-row">
                <div class="col-md-6">
                    <label>Home team</label>
                    <select name="home" class="form-control" required>
                        <option value="">Select home team</option>
                        <?php
                        $teamhome=mysqli_query($mysqli, $querryteamactivity) or die(mysqli_error);
                        while($teamhomedata = mysqli_fetch_array($teamhome)){
                        ?>
                        <option value="<?php echo $teamhomedata['id_team']?>"><?php echo $teamhomedata['team_name']?></option>
                        <?php
                        }?>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Away team</label>
                    <select name="away" class="form-control" required>
                        <option value="">Select away team</option>
                        <?php
                        $teamaway=mysqli_query($mysqli, $querryteamactivity) or die(mysqli_error);
                        while($teamawaydata = mysqli_fetch_array($teamaway)){
                        ?>
                        <option value="<?php echo $teamawaydata['id_team']?>"><?php echo $teamawaydata['team_name']?></option>
                        <?php
                        }?>
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" style="margin-bottom:20px;color:white;" name="add-match" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Add Match</button>
      </form>
      <?php if($matchchecknull['id_match']!=NULL){ ?>
      <!-- Content Generate Match Time-->
      <h4 style="text-align:center;">Generate Match Time</h4>
      <form method="post" action="/system/core/generate_match.php?id_activity_futsal_detail=<?php echo $futsaldetaildata['id_activity_futsal_detail'];?>&id_activity=<?php echo $id_activity;?>">
      <div class="form-group">
        <div class="form-row">
            <div class="col-md-6">
            <label>Match date</label>
            <input class="form-control" min="<?php if($lastdate!=NULL){echo $lastdate;}else{echo $activity['activity_date'];}?>" type="date" name="date" required>
            </div>
            <div class="col-md-6">
            <label>Time range per match (Minute)</label>
            <input class="form-control" min="30" type="number" name="range" required>
            </div>
          </div>
      </div>
      <div class="form-group">
        <label>Total field</label>
        <input class="form-control" min="1" type="number" name="field" required>
      </div>
      <div class="form-group">
        <div class="form-row">
            <div class="col-md-6">
            <label>Start from</label>
            <input class="form-control" type="time" name="start" required>
            </div>
            <div class="col-md-6">
            <label>Until</label>
            <input class="form-control" type="time" name="end" required>
            </div>
          </div>
        </div>
        <button type="submit" style="margin-bottom:20px;color:white;" name="add-match" class="btn btn-primary btn-block"><i class="fa fa-wrench"></i> Generate</button>
      </form>
      <?php } ?>
      <!-- Content Match -->
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Competition schedule | <a class="btn btn-primary" target="_blank" href="/system/core/print_match_list.php?id_activity_futsal_detail=<?php echo $id_activity_futsal_detail;?>&id_activity=<?php echo $id_activity;?>"><i class="fa fa-fw fa-download"></i> Download</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr style="text-align:center;">
                 <th>No</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Home team</th>
                  <th>Score</th>
                  <th>Away team</th>
                  <th>Field</th>
                  <th>Operation</th>
                </tr>
              </thead>
              <tfoot>
                <tr style="text-align:center;">
                  <th>No</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Home team</th>
                  <th>Score</th>
                  <th>Away team</th>
                  <th>Field</th>
                  <th>Operation</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
                  if(is_array($matchcheck)==NULL){
                    ?>
                      <tr>
                          <td colspan="9" style="text-align:center;">There's no any match create yet.</td>
                      </tr>
                    <?php
                    }else{
                  $a=1;
                  while($match = mysqli_fetch_array($matchdata)){
                    $home=$match['Home'];
                    $away=$match['Away'];
                    $id_match=$match['id_match'];
                ?>
                    <tr>
                      <td><?php echo $a;?></td>
                      <td><?php if($match['match_time']!=NULL){echo $match['DAY(match_time)']." ".$month[$match['MONTH(match_time)']]." ".$match['YEAR(match_time)'];}else{echo "Not set";}?></td>
                      <td><?php if($match['match_time']!=NULL){echo date('H:i',strtotime($match['match_time']));}else{echo "Not set";}?></td>
                      <td style="text-align:right;"><?php echo cekteam($mysqli, $home);?> <img style="max-height:50px;" src="/img/team_logo/<?php echo cekteamimg($mysqli, $home)?>.png"></td>
                      <td style="text-align:center;font-size:20px;"><?php echo cekscore($mysqli, $home, $id_match)." - ".cekscore($mysqli, $away, $id_match);?></td>
                      <td style="text-align:left;"><img style="max-height:50px;" src="/img/team_logo/<?php echo cekteamimg($mysqli, $away)?>.png"> <?php echo cekteam($mysqli, $away);?></td>
                      <td><?php if($match['match_field']!=NULL){echo "On field ".$match['match_field'];}else{echo "Not set";}?></td>
                      <td style="text-align:center;"><a href="competition_match.php?id_match=<?php echo $match['id_match'];?>&id_activity=<?php echo $id_activity;?>" data-tooltip="#live"><i class="fa fa-fw fa-arrow-right"></i></a> |  <a href="" data-toggle="modal" data-target="#viewMatchModal<?php echo $a;?>" data-tooltip="#view"><i class="fa fa-fw fa-eye"></i></a> | <a href="" data-toggle="modal" data-target="#editmatchModal<?php echo $a;?>" data-tooltip="#edit"><i class="fa fa-fw fa-pencil"></i></a> |<a href="" data-toggle="modal" data-target="#deletematchModal<?php echo $a;?>" data-tooltip="#delete"><i class="fa fa-fw fa-ban"></i></a></td>
                    </tr>
                <?php
                    $a++;}
                    }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Match Detail Modal -->
  <?php
          $modalmatch=mysqli_query($mysqli, $querrymatch) or die(mysqli_error);
          $a=0;
            while($viewmodal = mysqli_fetch_array($modalmatch))
              {	$a++;
                $id_match=$viewmodal['id_match'];
        ?>
    <div style="padding-right:0px;" class="portfolio-modal modal fade" id="viewMatchModal<?php echo $a;?>" tabindex="-1" role="dialog" aria-hidden="true">
          <div style="max-width:1200px;" class="modal-dialog">
            <div style="text-align:center;" class="modal-content">
              <div class="container">
                <div style="display:unset;" class="row">
                  <div style="max-width:100%;padding:0px;" class="col-lg-8 mx-auto">
                    <div class="modal-body">
                      <!-- Project Details Go Here -->
                      <h2 class="text-uppercase"><?php echo $futsaldetaildata['activity_name'] ?></h2>
                      <table style="margin:auto;">
                        <tr>
                        <td style="text-align:center;"><?php echo cekteam($mysqli, $viewmodal['Home'])?></td>
                        <td></td>
                        <td style="text-align:center;"><?php echo cekteam($mysqli, $viewmodal['Away'])?></td>
                        </tr>
                        <tr>
                        <td><img style="max-height:100px" src="/img/team_logo/<?php echo cekteamimg($mysqli, $viewmodal['Home'])?>.png"></td>
                        <td>VS</td>
                        <td><img style="max-height:100px" src="/img/team_logo/<?php echo cekteamimg($mysqli, $viewmodal['Away'])?>.png"></td>
                        </tr>
                        <tr style="font-size:40px;">
                        <td style="text-align:center;"><?php echo cekscore($mysqli, $viewmodal['Home'], $id_match)?></td>
                        <td> - </td>
                        <td style="text-align:center;"><?php echo cekscore($mysqli, $viewmodal['Away'], $id_match)?></td>
                        </tr>
                      </table>
                      <ul class="list-inline">
                        <li>Referee 1 : <?php echo cekreferee($mysqli, $viewmodal['id_referee_1']);?></li>
                        <li>Referee 2 : <?php echo cekreferee($mysqli, $viewmodal['id_referee_2']);?></li>
                        <li>Date : <?php echo $viewmodal['DAY(match_time)']." ".$month[$viewmodal['MONTH(match_time)']]." ".$viewmodal['YEAR(match_time)']?></li>
                        <li>Start time : <?php echo date('H:i',strtotime($viewmodal['match_time']));?> WIB</li>
                      </ul>
                      <!-- Goal List -->
                      <div class="card mb-3">
                          <div class="card-header">
                            <i class="fa fa-table"></i> Goal list
                          </div>
                          <div class="card-body">
                            <div class="table-responsive">
                              <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Team name</th>
                                    <th>Player name</th>
                                    <th>Player number</th>
                                    <th>Player assist</th>
                                    <th>Player number</th>
                                    <th>Goal category</th>
                                    <th>Goal time</th>
                                  </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $querrygoal="SELECT id_match_goal, id_match, goal, assist, goal_category, goal_time FROM match_goal WHERE id_match='$id_match' ORDER BY goal_time ASC";
                                    $querrygoaldata=mysqli_query($mysqli, $querrygoal) or die(mysqli_error);
                                    $b=1;
                                    while($goaldata = mysqli_fetch_array($querrygoaldata)){
                                        $goal=$goaldata['goal'];
                                        $assist=$goaldata['assist'];
                                      $querryplayergoal="SELECT id_player, futsal_team.id_team, futsal_team.team_name, player_name, player_number FROM futsal_player INNER JOIN futsal_team ON futsal_team.id_team=futsal_player.id_team WHERE id_player='$goal'";
                                      $querryplayerassist="SELECT * FROM futsal_player WHERE id_player='$assist'";
                                      $playergoaldata=mysqli_query($mysqli, $querryplayergoal) or die(mysqli_error);
                                      $playergoal = mysqli_fetch_array($playergoaldata);
                                      $playerassistdata=mysqli_query($mysqli, $querryplayerassist) or die(mysqli_error);
                                      $playerassist = mysqli_fetch_array($playerassistdata);
                                      ?>
                                    <tr>
                                      <td><?php echo $b;?></td>
                                      <td><?php echo $playergoal['team_name'];?></td>
                                      <td><?php echo $playergoal['player_name'];?></td>
                                      <td><?php echo $playergoal['player_number'];?></td>
                                      <td><?php if($assist!=NULL){echo $playerassist['player_name'];}else{echo "None";}?></td>
                                      <td><?php if($assist!=NULL){echo $playerassist['player_number'];}else{echo "None";}?></td>
                                      <td><?php echo $goaldata['goal_category'];?></td>
                                      <td><?php echo $goaldata['goal_time'];?></td>
                                    </tr>
                                <?php
                                    $b++;}
                                ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>

                         <!-- Offense List -->
                        <div class="card mb-3">
                            <div class="card-header">
                              <i class="fa fa-table"></i> Offense list
                            </div>
                            <div class="card-body">
                              <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                  <thead>
                                    <tr>
                                      <th>No</th>
                                      <th>Team name</th>
                                      <th>Player name</th>
                                      <th>Player number</th>
                                      <th>Offense card</th>
                                      <th>Offense category</th>
                                      <th>Offense time</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                        $querryoffense="SELECT id_offense, id_match, futsal_player.id_player, futsal_player.id_team, futsal_team.team_name, futsal_player.player_name, futsal_player.player_number, offense_card, offense_category, offense_time FROM match_offense INNER JOIN futsal_player ON futsal_player.id_player=match_offense.id_player INNER JOIN futsal_team ON futsal_team.id_team=futsal_player.id_team WHERE id_match='$id_match' ORDER BY offense_time ASC";
                                        $querryoffensedata=mysqli_query($mysqli, $querryoffense) or die(mysqli_error);
                                        $c=1;
                                        while($offensedata = mysqli_fetch_array($querryoffensedata)){
                                          ?>
                                        <tr>
                                          <td><?php echo $c;?></td>
                                          <td><?php echo $offensedata['team_name'];?></td>
                                          <td><?php echo $offensedata['player_name'];?></td>
                                          <td><?php echo $offensedata['player_number'];?></td>
                                          <td><?php if($offensedata['offense_card']!=NULL){echo $offensedata['offense_card'];}else{echo "None";}?></td>
                                          <td><?php echo $offensedata['offense_category'];?></td>
                                          <td><?php echo $offensedata['offense_time'];?></td>
                                        </tr>
                                    <?php
                                        $c++;}
                                    ?>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                          <?php
                          $querypk="SELECT * FROM match_drawpk WHERE id_match='$id_match'";
                          $pkdraw=mysqli_query($mysqli, $querypk) or die(mysqli_error);
                          $pkdata=mysqli_fetch_array($pkdraw);
                          $extra=false;
                          if($pkdata['h4']!=0 || $pkdata['a4']!=0){
                            $extra=true;
                          }
                          ?>
                          <h5>PK - Draw</h5>
                          <table style="text-align:center;" class="table table-bordered" width="100%" cellspacing="0">
                            <tr>
                              <td style="text-align:left;"><?php echo cekteam($mysqli, $home)?></td>
                              <td><input type="radio" value="1" name="h1" <?php if($pkdata['h1']==1){echo 'checked';}else{echo 'disabled';};?>></td>
                              <td><input type="radio" value="1" name="h2" <?php if($pkdata['h2']==1){echo 'checked';}else{echo 'disabled';};?>></td>
                              <td><input type="radio" value="1" name="h3" <?php if($pkdata['h3']==1){echo 'checked';}else{echo 'disabled';};?>></td>
                              <?php if($extra==true){ ?>
                              <td><input type="radio" value="1" name="h4" <?php if($pkdata['h4']==1){echo 'checked';}else{echo 'disabled';};?>></td>
                              <?php } ?>
                            </tr>
                            <tr>
                              <td style="text-align:left;"><?php echo cekteam($mysqli, $away)?></td>
                              <td><input type="radio" value="1" name="a1" <?php if($pkdata['a1']==1){echo 'checked';}else{echo 'disabled';};?>></td>
                              <td><input type="radio" value="1" name="a2" <?php if($pkdata['a2']==1){echo 'checked';}else{echo 'disabled';};?>></td>
                              <td><input type="radio" value="1" name="a3" <?php if($pkdata['a3']==1){echo 'checked';}else{echo 'disabled';};?>></td>
                              <?php if($extra==true){ ?>
                              <td><input type="radio" value="1" name="a4" <?php if($pkdata['a4']==1){echo 'checked';}else{echo 'disabled';};?>></td>
                              <?php } ?>
                            </tr>
                          </table>
                          <a target="_blank" href="/system/core/print_match_report.php?id_match=<?php echo $id_match;?>" style="color:white;" class="btn btn-primary btn-block"><i class="fa fa-download"></i> Report</a>
                      <button class="btn btn-secondary btn-block" data-dismiss="modal" type="button"><i class="fa fa-times"></i> Cancel</button>
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

<!-- Edit Modal -->
<?php
      $matchmodaledit=mysqli_query($mysqli, $querrymatch) or die(mysqli_error);
      $a=0;
        while($modalmatchedit = mysqli_fetch_array($matchmodaledit))
          {	$a++;
?>
<div class="modal fade" id="editmatchModal<?php echo $a;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div style="max-width:700px;" class="modal-dialog">
      <div class="modal-content">
        <div class="container">
          <div class="card card-register mx-auto mt-5">
            <div class="card-header">Edit Match</div>
            <div class="card-body">
              <form method="POST" name="edit-activity" action="/system/core/update_match.php?id_activity_futsal_detail=<?php echo $modalmatchedit['id_activity_futsal_detail'];?>&id_match=<?php echo $modalmatchedit['id_match'];?>&id_activity=<?php echo $id_activity;?>">
              <div class="form-group">
                  <div class="form-row">
                      <div class="col-md-6">
                          <label>Home team</label>
                          <select name="home" class="form-control" required>
                              <option value="null">Select home team</option>
                              <?php
                              $teamhome=mysqli_query($mysqli, $querryteamactivity) or die(mysqli_error);
                              while($teamhomedata = mysqli_fetch_array($teamhome)){
                              ?>
                              <option value="<?php echo $teamhomedata['id_team']?>" <?php echo ($modalmatchedit['Home'] == $teamhomedata['id_team'])? 'selected="selected"':'';?>><?php echo $teamhomedata['team_name']?></option>
                              <?php
                              }?>
                          </select>
                      </div>
                      <div class="col-md-6">
                          <label>Away team</label>
                          <select name="away" class="form-control" required>
                              <option value="null">Select away team</option>
                              <?php
                              $teamaway=mysqli_query($mysqli, $querryteamactivity) or die(mysqli_error);
                              while($teamawaydata = mysqli_fetch_array($teamaway)){
                              ?>
                              <option value="<?php echo $teamawaydata['id_team']?>" <?php echo ($modalmatchedit['Away'] == $teamawaydata['id_team'])? 'selected="selected"':'';?>><?php echo $teamawaydata['team_name']?></option>
                              <?php
                              }?>
                          </select>
                      </div>
                  </div>
              </div>
              <div class="form-group">
                  <label>Match time</label>
                  <input value="<?php echo date('Y-m-d\TH:i', strtotime($modalmatchedit['match_time']));?>" class="form-control" type="datetime-local" name="time" required>
              </div>
              <button type="submit" name="update-match" class="btn btn-primary btn-block"><i class="fa fa-pencil"></i> Update Match</button>
              <button class="btn btn-secondary btn-block" data-dismiss="modal" type="button"><i class="fa fa-times"></i> Cancel</button>
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

<!-- Delete Team Modal -->
<?php
      $activityteammodaldelete=mysqli_query($mysqli, $querryteamactivity) or die(mysqli_error);
      $a=0;
        while($modalteamdelete = mysqli_fetch_array($activityteammodaldelete))
          {	$a++;
    ?>
<div class="modal fade" id="deleteteamModal<?php echo $a;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Remove <?php echo $modalteamdelete['team_name'];?> team from competition?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-footer">
          <a class="btn btn-primary" href="/system/core/remove_team.php?id_team=<?php echo $modalteamdelete['id_team'];?>&id_activity=<?php echo $modalteamdelete['id_activity'];?>">Delete</a>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
<?php
}
?>

<!-- Delete Match Modal -->
<?php
      $matchmodaldelete=mysqli_query($mysqli, $querrymatch) or die(mysqli_error);
      $a=0;
        while($modalmatchdelete = mysqli_fetch_array($matchmodaldelete))
          {	$a++;
            $home1=$modalmatchdelete['Home'];
            $away1=$modalmatchdelete['Away'];
    ?>
<div class="modal fade" id="deletematchModal<?php echo $a;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete <?php echo $modalmatchdelete['DAY(match_time)']." ".$month[$modalmatchdelete['MONTH(match_time)']]." ".$modalmatchdelete['YEAR(match_time)']?> - <?php echo date('H:i',strtotime($viewmodal['match_time']));?> WIB, <?php echo cekteam($mysqli, $home1);?> VS <?php echo cekteam($mysqli, $away1);?> match from competition?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-footer">
          <a class="btn btn-primary" href="/system/core/delete_match.php?id_match=<?php echo $modalmatchdelete['id_match'];?>&id_activity=<?php echo $id_activity;?>">Delete</a>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
<?php
  }
}
?>

<div style="position:absolute;display:none;background-color:lightblue;border-radius:2px;padding:3px;" id="remove">Remove</div>
<div style="width:75px;position:absolute;display:none;background-color:lightblue;border-radius:2px;padding:3px;" id="live">Go to match</div>
<div style="position:absolute;display:none;background-color:lightblue;border-radius:2px;padding:3px;" id="delete">Delete</div>
<div style="position:absolute;display:none;background-color:lightblue;border-radius:2px;padding:3px;" id="edit">Edit</div>
<div style="position:absolute;display:none;background-color:lightblue;border-radius:2px;padding:3px;" id="view">View</div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>All right reserved. Copyright &copy; Maharcorps 2018. Developed by <a href="#">Denis Yordan P</a></small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Bootstrap core JavaScript-->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="/vendor/chart.js/Chart.min.js"></script>
    <script src="/vendor/datatables/jquery.dataTables.js"></script>
    <script src="/vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="/js/sb-admin.min.js"></script>
    <!-- Custom scripts for this page-->
    <script src="/js/sb-admin-datatables.min.js"></script>
    <script src="/js/sb-admin-charts.min.js"></script>
  </div>
</body>

</html>
