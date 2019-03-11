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

  <!-- Content -->
  <div class="content-wrapper">
    <div class="container-fluid">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <p>Content</p>
        </li>
        <li class="breadcrumb-item active">Activity</li>
      </ol>
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Activity Data
        </div>
        <div class="card-body">
        <a style="margin-bottom:20px;color:white;" class="btn btn-primary btn-block" data-toggle="modal" data-target="#createModal"><i class="fa fa-fw fa-plus"></i> Create new activity</a>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Event name</th>
                  <th>Registration start</th>
                  <th>Registration end</th>
                  <th>Event date</th>
                  <th>Event status</th>
                  <th>Event type</th>
                  <th>Operation</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>Event name</th>
                  <th>Registration start</th>
                  <th>Registration end</th>
                  <th>Event date</th>
                  <th>Event status</th>
                  <th>Event type</th>
                  <th>Operation</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
                  $activity=mysqli_query($mysqli, $querryactivity) or die(mysqli_error);
                  $a=1;
                  while($activitydata1 = mysqli_fetch_array($activity)){
                ?>
                    <tr>
                      <td><?php echo $a;?></td>
                      <td><?php echo $activitydata1['activity_name'];?></td>
                      <td><?php echo $activitydata1['DAY(activity_registration_start)'], " ",$month[$activitydata1['MONTH(activity_registration_start)']]," ",$activitydata1['YEAR(activity_registration_start)']; ?></td>
                      <td><?php echo $activitydata1['DAY(activity_registration_end)'], " ",$month[$activitydata1['MONTH(activity_registration_end)']]," ",$activitydata1['YEAR(activity_registration_end)']; ?></td>
                      <td><?php echo $activitydata1['DAY(activity_date)'], " ",$month[$activitydata1['MONTH(activity_date)']]," ",$activitydata1['YEAR(activity_date)'];?></td>
                      <td><?php echo $activitydata1['activity_status'];?></p></td>
                      <td><?php echo $activitydata1['activity_type'];?></td>
                      <td style="text-align:center;"><a href="" data-toggle="modal" data-target="#viewModal<?php echo $a;?>" data-tooltip="#view"><i class="fa fa-fw fa-eye"></i></a>|<a href="" data-toggle="modal" data-target="#editModal<?php echo $a;?>" data-tooltip="#edit"><i class="fa fa-fw fa-pencil"></i></a>|<a href="" data-toggle="modal" data-target="#deleteModal<?php echo $a;?>" data-tooltip="#delete"><i class="fa fa-fw fa-ban"></i></a></td>
                    </tr>
                <?php
                    $a++;}
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Create Modal-->
  <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div style="max-width:700px;" class="modal-dialog">
      <div class="modal-content">
        <div class="container">
          <div class="card card-register mx-auto mt-5">
            <div class="card-header">Create new activity</div>
            <div class="card-body">
              <form method="POST" name="create-activity" enctype="multipart/form-data" action="/system/core/new_activity.php" onsubmit="return validateActivityForm()">
                <div class="form-group">
                  <label>Activity name</label>
                  <input class="form-control" type="text" name="name" maxlength="30" placeholder="Enter activity name">
                </div>
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" type="text" name="desc" placeholder="Activity description"></textarea>
                </div>
                <div class="form-group">
                  <label>Activity status</label>
                    <select name="status" class="form-control">
                      <option value="null">Select status</option>
                      <option value="Member Only">Member Only</option>
                      <option value="Public">Public</option>
                    </select>
                </div>
                <div class="form-group">
                  <label>Activity type</label>
                    <select id="createtype" name="type" class="form-control">
                      <option value="null">Select status</option>
                      <option value="General">General</option>
                      <option value="Futsal">Futsal</option>
                    </select>
                </div>
                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-6">
                      <label>Registration</label>
                      <label>Start</label>
                      <input class="form-control" type="date" min="<?php echo date('Y-m-d');?>" name="start" placeholder="Start date">
                    </div>
                    <div class="col-md-6">
                      <label>End</label>
                      <input class="form-control" type="date" min="<?php echo date('Y-m-d');?>" name="end" placeholder="End date">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Activity date</label>
                  <input class="form-control" type="date" min="<?php echo date('Y-m-d');?>" name="datestart" placeholder="Activity date">
                </div>
                <div id="generaltime1" class="form-group" style="display:none;">
                  <label>Activity end</label>
                  <input class="form-control" type="date" min="<?php echo date('Y-m-d');?>" name="dateend" placeholder="Activity date">
                </div>
                <div id="generaltime1" class="form-group" style="display:none;">
                  <div class="form-row">
                    <div class="col-md-6">
                      <label>Time</label>
                      <label>Start from</label>
                      <input class="form-control" type="time" name="timestart" value="<?php echo date('H:i:s',strtotime($modaledit['activity_date']));?>">
                    </div>
                    <div class="col-md-6">
                      <label>Until</label>
                      <input class="form-control" type="time" name="timeend" value="<?php echo date('H:i:s',strtotime($modaledit['activity_end']));?>">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label>Activity location</label>
                  <input class="form-control" type="text" name="location" placeholder="Enter location">
                </div>
                <div class="form-group">
                  <label>Registration fee</label>
                  <input class="form-control" type="number" name="fee" placeholder="Enter fee">
                </div>
                <div class="form-group">
                  <label>Activity pamphlet</label>
                  <label>Note : Very recommended for 1080x1080 image resolution</label>
                  <input class="form-control" type="file" name="activity-image" placeholder="Upload pamphlet">
                </div>
                <button type="submit" name="create-event" class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Create activity</button>
                <a type="submit" class="btn btn-secondary btn-block" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</a>
              </form>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>

<!-- View Modal -->
<?php
  $activitymodalview=mysqli_query($mysqli, $querryactivity) or die(mysqli_error);
  $a=0;
    while($modalview = mysqli_fetch_array($activitymodalview))
      {	$a++;
?>
<div class="modal fade" id="viewModal<?php echo $a;?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div style="max-width:1000px" class="modal-dialog">
      <div class="modal-content">
        <div class="container">
          <div style="max-width:100%" class="card card-register mx-auto mt-5">
            <div style="text-align:center;" class="card-header"><h2 class="text-uppercase"><?php echo $modalview['activity_name'];?></h2></div>
            <div class="card-body">
              <p class="item-intro text-muted"><h4>Event for <?php echo $modalview['DAY(activity_date)'], " ", $month[$modalview['MONTH(activity_date)']]," ", $modalview['YEAR(activity_date)'];?></h4></p>
              <img class="img-fluid d-block mx-auto" src="/img/activity/<?php echo $modalview['activity_img'];?>.jpg" alt="">
              <p><?php echo $modalview['activity_description'] ?></p>
              <ul class="list-inline">
                <li>Registration: <?php echo $modalview['DAY(activity_registration_start)'], " ", $month[$modalview['MONTH(activity_registration_start)']]," ", $modalview['YEAR(activity_registration_start)'];?> until <?php echo $modalview['DAY(activity_registration_end)'], " ", $month[$modalview['MONTH(activity_registration_end)']]," ", $modalview['YEAR(activity_registration_end)'];?></li>
                <?php if($modalview['activity_type']=="General"){ if(date('Y-m-d',strtotime($modalview['activity_date']))==date('Y-m-d',strtotime($modalview['activity_end']))){ ?>
                <li>Start from: <?php echo date('H:i',strtotime($modalview['activity_date']));?> until <?php echo date('H:i',strtotime($modalview['activity_end']));?></li>
                <?php }else{ ?>
                <li>Start from: <?php echo date('d F Y H:i',strtotime($modalview['activity_date']));?> WIB until <?php echo date('d F Y H:i',strtotime($modalview['activity_end']));?> WIB</li>
                <?php }} ?>
                <li>Location: <?php echo $modalview['activity_location'];?></li>
                <li>Status: <?php echo $modalview['activity_status'];?></li>
                <li>Type: <?php echo $modalview['activity_type'];?></li>
                <li>Registratin fee: <?php if($modalview['activity_fee']==0){ echo "Free";}else{echo rupiah($modalview['activity_fee']);} if($modalview['activity_type']=='Futsal'){echo "/Team";}?></li>
              </ul>
              <?php
              if($modalview['activity_type']=="Futsal"){
                ?>
                  <a class="btn btn-primary btn-block" href="competition.php?id_activity=<?php echo $modalview['id_activity'];?>"><i class="fa fa-eye"></i> See competition</a>
                  <a class="btn btn-primary btn-block" href="payment_status.php?id_activity=<?php echo $modalview['id_activity'];?>"><i class="fa fa-eye"></i> Payment status</a>
                <?php
              }else{
              ?>
                  <a class="btn btn-primary btn-block" href="participant.php?id_activity=<?php echo $modalview['id_activity'];?>"><i class="fa fa-users"></i> Participant</a>
              <?php
              }
              ?>
              <a class="btn btn-secondary btn-block" data-dismiss="modal"><i class="fa fa-times"></i> Close</a>
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
      $activitymodaledit=mysqli_query($mysqli, $querryactivity) or die(mysqli_error);
      $a=0;
        while($modaledit = mysqli_fetch_array($activitymodaledit))
          {	$a++;
?>
<div class="modal fade" id="editModal<?php echo $a;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div style="max-width:700px;" class="modal-dialog">
      <div class="modal-content">
        <div class="container">
          <div class="card card-register mx-auto mt-5">
            <div class="card-header">Edit activity</div>
            <div class="card-body">
              <form method="POST" name="edit-activity" enctype="multipart/form-data" action="/system/core/edit_activity.php?id_activity=<?php echo $modaledit['id_activity'];?>">
                <div class="form-group">
                  <label>Activity name</label>
                  <input class="form-control" type="text" name="name" value="<?php echo $modaledit['activity_name'];?>">
                </div>
                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-6">
                      <label>Registration</label>
                      <label>Start</label>
                      <input class="form-control" type="date" min="<?php echo date('Y-m-d');?>" name="start" value="<?php echo $modaledit['activity_registration_start'];?>">
                    </div>
                    <div class="col-md-6">
                      <label>End</label>
                      <input class="form-control" type="date" min="<?php echo date('Y-m-d');?>" name="end" value="<?php echo $modaledit['activity_registration_end'];?>">
                    </div>
                  </div>
                </div>
                <?php if($modaledit['activity_type']=="Futsal"){ ?>
                <div class="form-group">
                  <label>Activity date</label>
                  <input class="form-control" type="date" min="<?php echo date('Y-m-d');?>" name="datestart1" value="<?php echo date('Y-m-d',strtotime($modaledit['activity_date']));?>">
                </div>
                <?php }else{ ?>
                <div class="form-group">
                  <label>Activity date</label>
                  <input class="form-control" type="date" min="<?php echo date('Y-m-d');?>" name="datestart2" value="<?php echo date('Y-m-d',strtotime($modaledit['activity_date']));?>">
                </div>
                <div class="form-group">
                  <label>Activity end</label>
                  <input class="form-control" type="date" min="<?php echo date('Y-m-d');?>" name="dateend" value="<?php echo date('Y-m-d',strtotime($modaledit['activity_end']));?>">
                </div>
                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-6">
                      <label>Time</label>
                      <label>Start from</label>
                      <input class="form-control" type="time" name="timestart" value="<?php echo date('H:i:s',strtotime($modaledit['activity_date']));?>">
                    </div>
                    <div class="col-md-6">
                      <label>Until</label>
                      <input class="form-control" type="time" name="timeend" value="<?php echo date('H:i:s',strtotime($modaledit['activity_end']));?>">
                    </div>
                  </div>
                </div>
                <?php } ?>
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" type="text" name="desc"><?php echo $modaledit['activity_description'];?></textarea>
                </div>
                <div class="form-group">
                  <label>Activity status</label>
                    <select name="status" class="form-control">
                      <option value="null">Select status</option>
                      <option value="Member Only" <?php echo ($modaledit['activity_status'] == 'Member Only')? 'selected="selected"':'';?>>Member Only</option>
                      <option value="Public" <?php echo ($modaledit['activity_status'] == 'Public')? 'selected="selected"':'';?>>Public</option>
                    </select>
                </div>
                <div class="form-group">
                  <label>Activity type</label>
                    <select name="type" class="form-control">
                      <option value="null">Select status</option>
                      <option value="General" <?php echo ($modaledit['activity_type'] == 'General')? 'selected="selected"':'';?>>General</option>
                      <option value="Futsal" <?php echo ($modaledit['activity_type'] == 'Futsal')? 'selected="selected"':'';?>>Futsal</option>
                    </select>
                </div>
                <div class="form-group">
                  <label>Activity location</label>
                  <input class="form-control" type="text" name="location" value="<?php echo $modaledit['activity_location'];?>">
                </div>
                <div class="form-group">
                  <label>Registration fee</label>
                  <input class="form-control" type="text" name="fee" value="<?php echo $modaledit['activity_fee'];?>">
                </div>
                <button type="submit" name="edit-activity" class="btn btn-primary btn-block"><i class="fa fa-pencil"></i> Update activity</a>
                <button type="submit" class="btn btn-secondary btn-block" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</a>
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

<!-- Delete Modal -->
<?php
      $activitymodaldelete=mysqli_query($mysqli, $querryactivity) or die(mysqli_error);
      $a=0;
        while($modaldelete = mysqli_fetch_array($activitymodaldelete))
          {	$a++;
    ?>
<div class="modal fade" id="deleteModal<?php echo $a;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete <?php echo $modaldelete['activity_name'];?> activity?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="/system/core/delete_activity.php?id_activity=<?php echo $modaldelete['id_activity'];?>">Delete</a>
          </div>
        </div>
      </div>
    </div>
<?php
}
?>

<div style="position:absolute;display:none;background-color:lightblue;border-radius:2px;padding:3px;" id="view">View more</div>
<div style="position:absolute;display:none;background-color:lightblue;border-radius:2px;padding:3px;" id="edit">Edit</div>
<div style="position:absolute;display:none;background-color:lightblue;border-radius:2px;padding:3px;" id="delete">Delete</div>
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
    <script type="text/javascript" src="/vendor/jquery/jquery.min.js"></script>
		<script type="text/javascript">
			$(function(){
				$("#createtype").click(function(){
					$("#generaltime1, #generaltime2").hide()
					if($(this).val() == "General"){
						$("#generaltime1, #generaltime2").show();
					}else{
						$("#generaltime1, #generaltime2").hide();
					}
				});
			});
		</script>
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
