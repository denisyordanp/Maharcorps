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
    <style>#clockdiv{font-family: sans-serif;color: #fff;display: inline-block;font-weight: 100;text-align: center;font-size: 20px;}#clockdiv > div{padding: 10px;border-radius: 3px;background: #f8f9fa!important;display: inline-block;line-height: 25px;max-width: 55px;}#clockdiv div > span{padding: 5px;border-radius: 3px;background: #00816A;display: inline-block;}.smalltext{padding-top: 5px;font-size: 10px;color:#00816A;}</style>

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
              <a class="nav-link js-scroll-trigger" href="/competition-team.php?id_activity=<?php echo $id_activity;?>">Team</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#topscore">Top Score</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#matchlist">Match</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
<?php
$querryactivitydetail="SELECT id_activity_futsal_detail, activity.id_activity, activity.activity_name, competition_system, DAY(technical_meeting_date), MONTH(technical_meeting_date), YEAR(technical_meeting_date) FROM activity_futsal_detail INNER JOIN activity ON activity.id_activity=activity_futsal_detail.id_activity WHERE activity.id_activity='$id_activity'";
$detaildata=mysqli_query($mysqli, $querryactivitydetail) or die(mysqli_error);
$futsaldetaildata=mysqli_fetch_array($detaildata);
$id_activity_futsal_detail=$futsaldetaildata['id_activity_futsal_detail'];
$datenow = date('Y-m-d H:i:s');

$querrycountdown="SELECT id_match, id_activity_futsal_detail, Home, Away, match_time, DAY(match_time),  MONTH(match_time),  YEAR(match_time) FROM futsal_match WHERE id_activity_futsal_detail='$id_activity_futsal_detail' AND match_time>'$datenow' LIMIT 1";
$count=mysqli_query($mysqli, $querrycountdown) or die(mysqli_error);
$countdata=mysqli_fetch_array($count);
$hour=date('H:i', strtotime($countdata['match_time']));
$time=date($countdata['match_time']);

$querrynow="SELECT * FROM futsal_match WHERE id_activity_futsal_detail='$id_activity_futsal_detail' AND match_time<'$datenow' ORDER BY match_time DESC LIMIT 1 ";
$nowtime=mysqli_query($mysqli, $querrynow) or die(mysqli_error);
$nowdata=mysqli_fetch_array($nowtime);
$now=strtotime(date('Y-m-d H:i:s'));

$rangenow=$now-strtotime($nowdata['match_time']);
$rangenext=strtotime($time)-$now;
?>
    <!-- Header -->
    <header class="masthead">
      <div class="container">
        <div style="padding-top:150px;" class="intro-text">
        <div class="intro-lead-in"><?php echo $futsaldetaildata['activity_name']?></div>
              <?php
            if(cekactivitydetail($mysqli, $id_activity)==true){
            if($countdata!=NULL){
            ?>
            <div style="font-size:20px;margin-bottom:0px;" class="intro-lead-in">Next match</div>
            <div style="font-size:20px;margin-bottom:0px;" class="intro-lead-in"><?php echo $countdata['DAY(match_time)']." ".$month[$countdata['MONTH(match_time)']]." ".$countdata['YEAR(match_time)']." ".$hour." WIB"?></div>
            <div style="font-size:20px;" class="intro-lead-in">
             <table style="margin:auto;">
                <tr>
                <td style="text-align:center;"><?php echo cekteam($mysqli, $countdata['Home'])?></td>
                <td></td>
                <td style="text-align:center;"><?php echo cekteam($mysqli, $countdata['Away'])?></td>
                </tr>
                <tr>
                <td><img style="max-height:100px" src="/img/team_logo/<?php echo cekteamimg($mysqli, $countdata['Home'])?>.png"></td>
                <td>VS</td>
                <td><img style="max-height:100px" src="/img/team_logo/<?php echo cekteamimg($mysqli, $countdata['Away'])?>.png"></td>
                </tr>
              </table>
            </div>
            <div style="font-size:20px;" class="intro-lead-in">
                <div id="clockdiv">
                    <div><span class="days"></span><div class="smalltext">Days</div></div>
                    <div><span class="hours"></span><div class="smalltext">Hours</div></div>
                    <div><span class="minutes"></span><div class="smalltext">Minutes</div></div>
                    <div><span class="seconds"></span><div class="smalltext">Seconds</div></div>
                </div>
            </div>
            <?php } } ?>
        </div>
      </div>
    </header>
<?php
if(cekactivitydetail($mysqli, $id_activity)==true){
  ?>

        <!-- TOP SCORE -->
        <section class="bg-light"  id="topscore">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">TOP SCORE</h2>
            <h3 class="section-subheading text-muted">Here's the 5 top scorer player.</h3>
          </div>
        </div>
          <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-table"></i> Player top score
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                  <tr style="text-align:center;">
                  <th>No</th>
                  <th>Team name</th>
                  <th>Player Name</th>
                  <th>Player Number</th>
                  <th>Total Goal</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                    $querrytopscore="SELECT futsal_team.team_name, futsal_player.player_name, futsal_player.player_number, COUNT(*) AS score FROM match_goal INNER JOIN futsal_player ON futsal_player.id_player=match_goal.goal INNER JOIN futsal_team ON futsal_team.id_team=futsal_player.id_team INNER JOIN futsal_match ON futsal_match.id_match=match_goal.id_match WHERE futsal_match.id_activity_futsal_detail='$id_activity_futsal_detail' GROUP BY goal HAVING COUNT(goal) >0 LIMIT 5";
                    $topscore=mysqli_query($mysqli, $querrytopscore) or die(mysqli_error);
                    $cekscore=mysqli_query($mysqli, $querrytopscore) or die(mysqli_error);
                    $cekscoredata=mysqli_fetch_array($cekscore);
                    $a=1;
                    if($cekscoredata==NULL){ ?>
                        <td colspan="5" align="center">There's no any goal yet.</td>
                    <?php
                    }else{
                        while($topscoredata=mysqli_fetch_array($topscore)){ ?>
                        <tr align="center">
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
        </div>
      </div>
    </section>
    
    <!-- Match List -->
    <section class="bg-light" id="matchlist">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">Match</h2>
            <h3 class="section-subheading text-muted">Competition match list</h3>
          </div>
        </div>
          <div class="card mb-3">
          <div class="card-header">
            <i class="fa fa-table"></i>Match schedule | <a class="btn btn-primary" target="_blank" href="/system/core/print_match_list.php?id_activity_futsal_detail=<?php echo $id_activity_futsal_detail;?>&id_activity=<?php echo $id_activity;?>"><i class="fa fa-fw fa-download"></i> Download</a>
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
                    $id_activity_futsal_detail=
                     $querrymatch="SELECT id_match, id_activity_futsal_detail, Home, Away, id_referee_1, id_referee_2, match_time, DAY(match_time), MONTH(match_time), YEAR(match_time), match_field FROM futsal_match WHERE id_activity_futsal_detail='$id_activity_futsal_detail' ORDER BY match_time ASC";
                     $matchdata=mysqli_query($mysqli, $querrymatch) or die(mysqli_error);
                     $ceckmatch=mysqli_query($mysqli, $querrymatch) or die(mysqli_error);
                     $matchcheck = mysqli_fetch_array($ceckmatch);
                     if(is_array($matchcheck)==NULL){
                        ?>
                          <tr>
                              <td colspan="9" style="text-align:center;">There's no any match yet.</td>
                          </tr>
                        <?php
                        }else{
                      $a=1;
                      while($match = mysqli_fetch_array($matchdata)){
                        $id_match=$match['id_match'];
                        $home=$match['Home'];
                        $away=$match['Away'];
                    ?>
                    <tr>
                    <td><?php echo $a;?></td>
                      <td><?php echo $match['DAY(match_time)']." ".$month[$match['MONTH(match_time)']]." ".$match['YEAR(match_time)']?></td>
                      <td><?php echo date('H:i',strtotime($match['match_time']));?></td>
                      <td style="text-align:right;"><?php echo cekteam($mysqli, $home);?> <a href="/team_detail.php?id_team=<?php echo $home?>&id_activity=<?php echo $id_activity;?>&page=Match"><img style="max-height:50px;" src="/img/team_logo/<?php echo cekteamimg($mysqli, $home)?>.png"></a></td>
                      <td style="text-align:center;font-size:20px;"><?php echo cekscore($mysqli, $home, $id_match)." - ".cekscore($mysqli, $away, $id_match);?></td>
                      <td style="text-align:left;"><a href="/team_detail.php?id_team=<?php echo $away?>&id_activity=<?php echo $id_activity;?>&page=Match"><img style="max-height:50px;" src="/img/team_logo/<?php echo cekteamimg($mysqli, $away)?>.png"></a> <?php echo cekteam($mysqli, $away);?></td>
                      <td><?php if($match['match_field']!=NULL){echo "On field ".$match['match_field'];}else{echo "Not set";}?></td>
                      <td style="text-align:center;"><a href="" data-toggle="modal" data-target="#matchViewModal<?php echo $a;?>" data-tooltip="#view"><i class="fa fa-fw fa-eye"></i></a> | <a href="" data-toggle="modal" data-target="#matchLive<?php echo $a;?>" data-tooltip="#live"><i class="fa fa-fw fa-arrow-right"></i></a></td>
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

    <!-- Match Detail Modal -->
    <?php
          $modalmatch=mysqli_query($mysqli, $querrymatch) or die(mysqli_error);
          $a=0;
            while($viewmodal = mysqli_fetch_array($modalmatch))
              {	$a++;
                $id_match=$viewmodal['id_match'];
        ?>
    <div class="portfolio-modal modal fade" id="matchViewModal<?php echo $a;?>" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                  <div class="rl"></div>
                </div>
              </div>
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
                        <li>Date : <?php echo $viewmodal['DAY(match_time)']." ".$month[$viewmodal['MONTH(match_time)']]." ".$viewmodal['YEAR(match_time)']?></li>
                        <li>Start time : <?php echo date('H:i',strtotime($viewmodal['match_time']));?> WIB</li>
                      </ul>
                      <img style="max-height:220px" src="/img/referee/referee_photo_<?php echo $viewmodal['id_referee_1']?>.jpg">
                      <ul class="list-inline">
                        <li>Referee 1 : <?php echo cekreferee($mysqli, $viewmodal['id_referee_1']);?></li>
                        <li>Age : <?php echo cekreferee($mysqli, $viewmodal['id_referee_2']);?></li>
                      </ul>
                      <img style="max-height:220px" src="/img/referee/referee_photo_<?php echo $viewmodal['id_referee_2']?>.jpg">
                      <ul class="list-inline">
                        <li>Referee 1 : <?php echo cekreferee($mysqli, $viewmodal['id_referee_1']);?></li>
                        <li>Age : <?php echo cekreferee($mysqli, $viewmodal['id_referee_2']);?></li>
                      </ul>
                      <!-- Goal List -->
                      <div class="card mb-3">
                          <div class="card-header">
                            <i class="fa fa-table"></i> Goals list
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
                                      $querryplayergoal="SELECT id_player, futsal_team.id_team, futsal_team.team_name, player_name, player_number FROM futsal_player INNER JOIN futsal_team ON futsal_team.id_team=futsal_player.id_team WHERE id_player='$goal'";
                                      $playergoaldata=mysqli_query($mysqli, $querryplayergoal) or die(mysqli_error);
                                      $playergoal = mysqli_fetch_array($playergoaldata);
                                      ?>
                                    <tr>
                                      <td><?php echo $b;?></td>
                                      <td><?php echo $playergoal['team_name'];?></td>
                                      <td><?php echo $playergoal['player_name'];?></td>
                                      <td><?php echo $playergoal['player_number'];?></td>
                                      <td><?php echo $goaldata['goal_category'];?></td>
                                      <td><?php echo $goaldata['goal_time'];?>'</td>
                                    </tr>
                                <?php
                                    $b++;}
                                ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>

                         <!-- Fouls List -->
                        <div class="card mb-3">
                            <div class="card-header">
                              <i class="fa fa-table"></i> Fouls list
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
                                          <td><?php echo $offensedata['offense_time'];?>'</td>
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
                            $querypkhome="SELECT id_match_goal, id_match, futsal_player.id_player, futsal_player.id_team, goal_category FROM match_goal INNER JOIN futsal_player ON futsal_player.id_player=match_goal.goal WHERE id_match='$id_match' AND futsal_player.id_team='$home' AND goal_category='PK-Draw'";
                            $querypkaway="SELECT id_match_goal, id_match, futsal_player.id_player, futsal_player.id_team, goal_category FROM match_goal INNER JOIN futsal_player ON futsal_player.id_player=match_goal.goal WHERE id_match='$id_match' AND futsal_player.id_team='$away' AND goal_category='PK-Draw'";
                            $pkdrawhome=mysqli_query($mysqli, $querypkhome) or die(mysqli_error);
                            $pkdrawaway=mysqli_query($mysqli, $querypkaway) or die(mysqli_error);
                          ?>
                          <h5>PK - Draw</h5>
                          <table class="table table-bordered" width="100%" cellspacing="0">
                                  <tr>
                                  <td><?php echo cekteam($mysqli, $home)?></td>
                                  <?php $h=0;
                                  while($drawpk1=mysqli_fetch_array($pkdrawhome)){
                                    ?>
                                  <td><div style="width:15px;height:15px;background-color:black;border-radius:50%;margin:auto;"></div></td>
                                  <?php $h++; }
                                  for($pk1=$h;$pk1<5;$pk1++){ ?>
                                  <td></td>
                                  <?php  } ?>
                                  </tr>
                                  <tr>
                                  <td><?php echo cekteam($mysqli, $away)?></td>
                                  <?php $i=0;
                                  while($drawpk2=mysqli_fetch_array($pkdrawaway)){
                                    ?>
                                  <td><div style="width:15px;height:15px;background-color:black;border-radius:50%;margin:auto;"></div></td>
                                  <?php $i++; }
                                  for($pk2=$i;$pk2<5;$pk2++){ ?>
                                  <td></td>
                                  <?php  } ?>
                                  </tr>
                        </table>
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

    <div style="position:absolute;display:none;background-color:lightblue;border-radius:2px;padding:3px;" id="view">View detail</div>
    <div style="position:absolute;display:none;background-color:lightblue;border-radius:2px;padding:3px;" id="live">Live report</div>
    <script type="text/javascript">
        var deadline = '<?php echo $countdata['match_time']?>';
        function time_remaining(endtime){
            var t = Date.parse(endtime) - Date.parse(new Date());
            var seconds = Math.floor( (t/1000) % 60 );
            var minutes = Math.floor( (t/1000/60) % 60 );
            var hours = Math.floor( (t/(1000*60*60)) % 24 );
            var days = Math.floor( t/(1000*60*60*24) );
            return {'total':t, 'days':days, 'hours':hours, 'minutes':minutes, 'seconds':seconds};
        }
        function run_clock(id,endtime){
            var clock = document.getElementById(id);
            
            // get spans where our clock numbers are held
            var days_span = clock.querySelector('.days');
            var hours_span = clock.querySelector('.hours');
            var minutes_span = clock.querySelector('.minutes');
            var seconds_span = clock.querySelector('.seconds');

            function update_clock(){
                var t = time_remaining(endtime);
                
                // update the numbers in each part of the clock
                days_span.innerHTML = t.days;
                hours_span.innerHTML = ('0' + t.hours).slice(-2);
                minutes_span.innerHTML = ('0' + t.minutes).slice(-2);
                seconds_span.innerHTML = ('0' + t.seconds).slice(-2);
                
                if(t.total<=0){ clearInterval(timeinterval); }
            }
            update_clock();
            var timeinterval = setInterval(update_clock,1000);
        }
        run_clock('clockdiv',deadline);
            </script>
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
