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
  $id_match = $_GET['id_match'];
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
        $querrymatchreport="SELECT id_match, activity_futsal_detail.id_activity_futsal_detail, activity.id_activity, activity.activity_name, competition_system, Home, Away, id_referee_1, id_referee_2, match_time,  DAY(match_time), MONTH(match_time), YEAR(match_time), match_field FROM futsal_match INNER JOIN activity_futsal_detail ON activity_futsal_detail.id_activity_futsal_detail=futsal_match.id_activity_futsal_detail INNER JOIN activity ON activity.id_activity=activity_futsal_detail.id_activity WHERE id_match='$id_match'";
        $matchdetail=mysqli_query($mysqli, $querrymatchreport) or die(mysqli_error);
        $matchdetaildata=mysqli_fetch_array($matchdetail);
        $home=$matchdetaildata['Home'];
        $away=$matchdetaildata['Away'];
        if(cekdate($mysqli, $id_match)==true){
            if($matchdetaildata['match_time']==NULL){
              echo "<script>alert('You need to set match time first.')</script>";
              echo "<script>window.location='/account/admin/competition.php?id_activity=$id_activity'</script>";
            }
        }else{
            echo "<script>alert('This match already done.')</script>";
            echo "<script>window.location='/account/admin/competition.php?id_activity=$id_activity'</script>";
        }
        $querryplayer="SELECT id_player, player_name, player_number, futsal_team.id_team, futsal_team.team_name FROM futsal_player INNER JOIN futsal_team ON futsal_team.id_team=futsal_player.id_team WHERE futsal_team.id_team='$home' OR futsal_team.id_team='$away' ORDER BY futsal_team.id_team ASC";
    ?>
  <!-- Content -->
  <div class="content-wrapper">
    <div class="container-fluid">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <p>Content</p>
        </li>
        <li class="breadcrumb-item active"><a style="text-decoration:none;" href="activity.php">Activity</a></li>
        <li class="breadcrumb-item active"><a style="text-decoration:none;" href="competition.php?id_activity=<?php echo $id_activity;?>">Competition</a></li>
        <li class="breadcrumb-item active">Competition match</li>
      </ol>
      <h2 style="text-align:center;"><?php echo $matchdetaildata['activity_name']?></h2>
        <label>Match : <?php echo cekteam($mysqli, $matchdetaildata['Home']);?> <img style="max-height:50px;" src="/img/team_logo/<?php echo cekteamimg($mysqli, $home)?>.png"> VS <img style="max-height:50px;" src="/img/team_logo/<?php echo cekteamimg($mysqli, $away)?>.png"> <?php echo cekteam($mysqli, $matchdetaildata['Away']);?></label><br>
        <label>Score : <?php echo cekscore($mysqli, $home, $matchdetaildata['id_match'])." - ".cekscore($mysqli, $away, $matchdetaildata['id_match']);?></label><br>
        <label>On field : <?php echo $matchdetaildata['match_field'];?></label><br>
        <label>Competition system : <?php echo $matchdetaildata['competition_system']?></label><br>
        <label>Date : <?php echo $matchdetaildata['DAY(match_time)']." ".$month[$matchdetaildata['MONTH(match_time)']]." ".$matchdetaildata['YEAR(match_time)']?></label><br>
        <label>Start time : <?php echo date('H:i',strtotime($matchdetaildata['match_time'])); if(date('H',strtotime($matchdetaildata['match_time']))<=12){echo " AM";}else{echo " PM";};?></label><br>
        <label><?php echo cekteam($mysqli, $matchdetaildata['Home']);?> uniform: <?php echo cekuniform($mysqli, $matchdetaildata['Home'])?></label><br>
        <label><?php echo cekteam($mysqli, $matchdetaildata['Away']);?> uniform: <?php echo cekuniform($mysqli, $matchdetaildata['Away'])?></label><br>
        <?php
            $refereecheck=mysqli_query($mysqli, $querrymatchreport) or die(mysqli_error);
            $refereedata=mysqli_fetch_array($refereecheck);
            if($refereedata['id_referee_1']==NULL||$refereedata['id_referee_2']==NULL){
                ?>

        <!-- Add Referee -->
        <h4 style="text-align:center;">Add referee first</h4>
        <form method="post" action="/system/core/update_match.php?id_match=<?php echo $id_match;?>&id_activity=<?php echo $id_activity;?>">
            <div class="form-group">
                <label>Referee 1</label>
                <select name="referee1" class="form-control" required>
                    <option value="">Select referee</option>
                    <?php
                    $referee=mysqli_query($mysqli, $querryreferee) or die(mysqli_error);
                    while($refereedata1 = mysqli_fetch_array($referee)){
                    ?>
                    <option value="<?php echo $refereedata1['id_referee']?>"><?php echo $refereedata1['referee_name']?></option>
                    <?php
                    }?>
                </select>
            </div>
            <div class="form-group">
                <label>Referee 2</label>
                <select name="referee2" class="form-control" required>
                    <option value="">Select referee</option>
                    <?php
                    $referee=mysqli_query($mysqli, $querryreferee) or die(mysqli_error);
                    while($refereedata1 = mysqli_fetch_array($referee)){
                    ?>
                    <option value="<?php echo $refereedata1['id_referee']?>"><?php echo $refereedata1['referee_name']?></option>
                    <?php
                    }?>
                </select>
            </div>
            <button type="submit" style="margin-bottom:20px;color:white;" name="update-referee" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Add referee</button>
        </form>
                <?php
            }

if($refereedata['id_referee_1']!=NULL||$refereedata['id_referee_2']!=NULL){
?>
        <!-- Update Referee -->
        <h4 style="text-align:center;">Edit referee</h4>
        <form method="post" action="/system/core/update_match.php?id_match=<?php echo $id_match;?>&id_activity=<?php echo $id_activity;?>">
            <div class="form-group">
                <label>Referee 1</label>
                <select name="referee1" class="form-control" required>
                    <option value="">Select referee</option>
                    <?php
                    $referee=mysqli_query($mysqli, $querryreferee) or die(mysqli_error);
                    while($refereedata2 = mysqli_fetch_array($referee)){
                    ?>
                    <option value="<?php echo $refereedata2['id_referee']?>" <?php echo ($refereedata2['id_referee'] == $refereedata['id_referee_1'])? 'selected="selected"':'';?>><?php echo $refereedata2['referee_name']?></option>
                    <?php
                    }?>
                </select>
            </div>
            <div class="form-group">
                <label>Referee 2</label>
                <select name="referee2" class="form-control" required>
                    <option value="">Select referee</option>
                    <?php
                    $referee=mysqli_query($mysqli, $querryreferee) or die(mysqli_error);
                    while($refereedata2 = mysqli_fetch_array($referee)){
                    ?>
                    <option value="<?php echo $refereedata2['id_referee']?>" <?php echo ($refereedata2['id_referee'] == $refereedata['id_referee_2'])? 'selected="selected"':'';?>><?php echo $refereedata2['referee_name']?></option>
                    <?php
                    }?>
                </select>
            </div>
            <button type="submit" style="margin-bottom:20px;color:white;" name="update-referee" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Update referee</button>
        </form>
        <!-- Add Goal -->
        <h4 style="text-align:center;">Add goal</h4>
        <form method="post" action="/system/core/add_goal.php?id_match=<?php echo $id_match;?>&id_activity=<?php echo $id_activity;?>">
            <div class="form-group">
                <label>Goal</label>
                <select name="goal" class="form-control" required>
                    <option value="">Select player</option>
                    <?php
                    $goal=mysqli_query($mysqli, $querryplayer) or die(mysqli_error);
                    while($goaldata = mysqli_fetch_array($goal)){
                    ?>
                    <option value="<?php echo $goaldata['id_player']?>"><?php echo $goaldata['team_name']." - ".$goaldata['player_name']." - ".$goaldata['player_number']?></option>
                    <?php
                    }?>
                </select>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-6">
                        <label>Time</label>
                        <input class="form-control" type="number" name="time" placeholder="Enter goal minute" required>
                    </div>
                    <div class="col-md-6">
                    <label>Category</label>
                        <select name="category" class="form-control" required>
                            <option value="">Select category</option>
                            <option value="Penalty kick">Penalty kick</option>
                            <option value="Shot on target">Shot on target</option>
                            <option value="Free kick">Free kick</option>
                            <option value="Headed">Headed</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" style="margin-bottom:20px;color:white;" name="add-goal" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Add goal</button>
        </form>
                <?php
            // }
        ?>

        <!-- Add Offense -->
        <h4 style="text-align:center;">Add offense</h4>
        <form method="post" action="/system/core/add_offense.php?id_match=<?php echo $id_match;?>&id_activity=<?php echo $id_activity;?>">
        <div class="form-group">
                <div class="form-row">
                    <div class="col-md-6">
                        <label>Offense</label>
                        <select name="offense" class="form-control" required>
                            <option value="">Select player</option>
                            <?php
                            $offense=mysqli_query($mysqli, $querryplayer) or die(mysqli_error);
                            while($offensedata = mysqli_fetch_array($offense)){
                            ?>
                            <option value="<?php echo $offensedata['id_player']?>"><?php echo $offensedata['team_name']."-".$offensedata['player_name']." - ".$offensedata['player_number']?></option>
                            <?php
                            }?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Card</label>
                        <select name="card" class="form-control">
                            <option value="">None</option>
                            <option value="Red">Red</option>
                            <option value="Yellow">Yellow</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <div class="col-md-6">
                        <label>Time</label>
                        <input class="form-control" type="number" name="time" placeholder="Enter effense minute" required>
                    </div>
                    <div class="col-md-6">
                    <label>Category</label>
                        <select name="category" class="form-control" required>
                            <option value="">Select category</option>
                            <option value="Tackle">Tackle</option>
                            <option value="Violence">Violence</option>
                            <option value="Timing">Timing</option>
                            <option value="Hands">Hands</option>
                            <option value="Attitude">Attitude</option>
                            <option value="Equipment">Equipment</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" style="margin-bottom:20px;color:white;" name="add-offense" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Add offense</button>
        </form>
                <?php
            // }
        ?>

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
                  <th>Goal category</th>
                  <th>Goal time</th>
                  <th>Operation</th>
                </tr>
              </thead>
              <tbody>
                <?php
                    $querrygoal="SELECT id_match_goal, id_match, goal, assist, goal_category, goal_time FROM match_goal WHERE id_match='$id_match' AND goal_category!='PK-Draw' ORDER BY goal_time ASC";
                    $querrygoaldata=mysqli_query($mysqli, $querrygoal) or die(mysqli_error);
                    $a=1;
                    while($goaldata = mysqli_fetch_array($querrygoaldata)){
                        $goal=$goaldata['goal'];
                        $querryplayergoal="SELECT id_player, futsal_team.id_team, futsal_team.team_name, player_name, player_number FROM futsal_player INNER JOIN futsal_team ON futsal_team.id_team=futsal_player.id_team WHERE id_player='$goal'";
                        $playergoaldata=mysqli_query($mysqli, $querryplayergoal) or die(mysqli_error);
                        $playergoal = mysqli_fetch_array($playergoaldata);
                      ?>
                    <tr>
                      <td><?php echo $a;?></td>
                      <td><?php echo $playergoal['team_name'];?></td>
                      <td><?php echo $playergoal['player_name'];?></td>
                      <td><?php echo $playergoal['player_number'];?></td>
                      <td><?php echo $goaldata['goal_category'];?></td>
                      <td><?php echo $goaldata['goal_time'];?></td>
                      <td style="text-align:center;"><a href="" data-toggle="modal" data-target="#removegoalmodal<?php echo $a;?>" data-tooltip="#remove"><i class="fa fa-fw fa-trash"></i></a></td>
                    </tr>
                <?php
                    $a++;}
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
                  <th>Operation</th>
                </tr>
              </thead>
              <tbody>
                <?php
                    $querryoffense="SELECT id_offense, id_match, futsal_player.id_player, futsal_player.id_team, futsal_team.team_name, futsal_player.player_name, futsal_player.player_number, offense_card, offense_category, offense_time FROM match_offense INNER JOIN futsal_player ON futsal_player.id_player=match_offense.id_player INNER JOIN futsal_team ON futsal_team.id_team=futsal_player.id_team WHERE id_match='$id_match' ORDER BY offense_time ASC";
                    $querryoffensedata=mysqli_query($mysqli, $querryoffense) or die(mysqli_error);
                    $a=1;
                    while($offensedata = mysqli_fetch_array($querryoffensedata)){
                      ?>
                    <tr>
                      <td><?php echo $a;?></td>
                      <td><?php echo $offensedata['team_name'];?></td>
                      <td><?php echo $offensedata['player_name'];?></td>
                      <td><?php echo $offensedata['player_number'];?></td>
                      <td><?php if($offensedata['offense_card']!=NULL){echo $offensedata['offense_card'];}else{echo "None";}?></td>
                      <td><?php echo $offensedata['offense_category'];?></td>
                      <td><?php echo $offensedata['offense_time'];?></td>
                      <td style="text-align:center;"><a href="" data-toggle="modal" data-target="#removeoffensemodal<?php echo $a;?>" data-tooltip="#remove"><i class="fa fa-fw fa-trash"></i></a></td>
                    </tr>
                <?php
                    $a++;}
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Remove Goal Modal -->
<?php
      $goalmodal=mysqli_query($mysqli, $querrygoal) or die(mysqli_error);
      $a=0;
      while($goaldata2 = mysqli_fetch_array($goalmodal)){
        $a++;
        $goal=$goaldata2['goal'];
        $queryplayergoalmodal="SELECT id_player, futsal_team.id_team, futsal_team.team_name, player_name, player_number FROM futsal_player INNER JOIN futsal_team ON futsal_team.id_team=futsal_player.id_team WHERE id_player='$goal'";
        $playergoalmodal=mysqli_query($mysqli, $queryplayergoalmodal) or die(mysqli_error);
        $playergoalmodal = mysqli_fetch_array($playergoalmodal);
    ?>
<div class="modal fade" id="removegoalmodal<?php echo $a;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Remove <?php echo $playergoalmodal['player_name'];?> goal from match?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-footer">
          <a class="btn btn-primary" href="/system/core/remove_goal.php?id_match_goal=<?php echo $goaldata2['id_match_goal'];?>&id_match=<?php echo $id_match;?>&id_activity=<?php echo $id_activity;?>">Delete</a>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
<?php
}
?>

<!-- Remove Offense Modal -->
<?php
      $offensemodal=mysqli_query($mysqli, $querryoffense) or die(mysqli_error);
      $a=0;
      while($offensedatamodal = mysqli_fetch_array($offensemodal)){
        $a++;
    ?>
<div class="modal fade" id="removeoffensemodal<?php echo $a;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Remove <?php echo $offensedatamodal['player_name'];?> offense from match?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-footer">
          <a class="btn btn-primary" href="/system/core/remove_offense.php?id_offense=<?php echo $offensedatamodal['id_offense'];?>&id_match=<?php echo $id_match;?>&id_activity=<?php echo $id_activity;?>">Delete</a>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
<?php }
$querypk="SELECT * FROM match_drawpk WHERE id_match='$id_match'";
$pkdraw=mysqli_query($mysqli, $querypk) or die(mysqli_error);
$pkdata=mysqli_fetch_array($pkdraw);
?>
<h5>PK - Draw</h5>
<form action="/system/core/update_drawpk.php?id_match=<?php echo $id_match;?>&id_activity=<?php echo $id_activity;?>" method="POST">
  <table style="text-align:center;" class="table table-bordered" width="100%" cellspacing="0">
    <tr>
      <td style="text-align:left;"><?php echo cekteam($mysqli, $home)?></td>
      <td><input type="hidden" name="h1" value="0"><input type="checkbox" value="1" name="h1" <?php if($pkdata['h1']==1){echo 'checked';};?>></td>
      <td><input type="hidden" name="h2" value="0"><input type="checkbox" value="1" name="h2" <?php if($pkdata['h2']==1){echo 'checked';};?>></td>
      <td><input type="hidden" name="h3" value="0"><input type="checkbox" value="1" name="h3" <?php if($pkdata['h3']==1){echo 'checked';};?>></td>
      <td><input type="hidden" name="h4" value="0"><input type="checkbox" value="1" name="h4" <?php if($pkdata['h4']==1){echo 'checked';};?>></td>
    </tr>
    <tr>
      <td style="text-align:left;"><?php echo cekteam($mysqli, $away)?></td>
      <td><input type="hidden" name="a1" value="0"><input type="checkbox" value="1" name="a1" <?php if($pkdata['a1']==1){echo 'checked';};?>></td>
      <td><input type="hidden" name="a2" value="0"><input type="checkbox" value="1" name="a2" <?php if($pkdata['a2']==1){echo 'checked';};?>></td>
      <td><input type="hidden" name="a3" value="0"><input type="checkbox" value="1" name="a3" <?php if($pkdata['a3']==1){echo 'checked';};?>></td>
      <td><input type="hidden" name="a4" value="0"><input type="checkbox" value="1" name="a4" <?php if($pkdata['a4']==1){echo 'checked';};?>></td>
    </tr>
  </table>
  <button style="margin-bottom:20px;color:white;" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Save draw-PK</button>
</form>

<!-- Reset PK-Draw Modal -->

<div class="modal fade" id="resetpkmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Reset PK-Draw data from match?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-footer">
          <a class="btn btn-primary" href="/system/core/reset_pk.php?id_match=<?php echo $id_match?>&id_activity=<?php echo $id_activity?>&home=<?php echo $home?>&away=<?php echo $away?>">Reset</a>
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
<?php }?>

<div style="position:absolute;display:none;background-color:lightblue;border-radius:2px;padding:3px;" id="remove">Remove</div>
<div style="width:75px;position:absolute;display:none;background-color:lightblue;border-radius:2px;padding:3px;" id="live">Go to live report</div>
<div style="position:absolute;display:none;background-color:lightblue;border-radius:2px;padding:3px;" id="delete">Delete</div>
<div style="position:absolute;display:none;background-color:lightblue;border-radius:2px;padding:3px;" id="edit">Edit</div>
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
