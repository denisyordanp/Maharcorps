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
          <p>Data</p>
        </li>
        <li class="breadcrumb-item active">Futsal</li>
        <li class="breadcrumb-item active">Team</li>
      </ol>
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-table"></i> Team Data
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
                  <th>Operation</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>No</th>
                  <th>Team name</th>
                  <th>Manager</th>
                  <th>Coach</th>
                  <th>Operation</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
                  $team=mysqli_query($mysqli, $querryallteam) or die(mysqli_error);
                  $a=1;
                  while($teamdata = mysqli_fetch_array($team)){
                    $id_team=$teamdata['id_team'];
                ?>
                    <tr>
                      <td><?php echo $a;?></td>
                      <td><?php echo $teamdata['team_name'];?></td>
                      <td><?php echo $teamdata['account_name']; ?></td>
                      <td><?php echo cekcoach($mysqli, $id_team);?></td>
                      <td style="text-align:center;"><a href="" data-toggle="modal" data-target="#viewModal<?php echo $a;?>" data-tooltip="#view"><i class="fa fa-fw fa-eye"></i></a>|<a href="" data-toggle="modal" data-target="#deleteModal<?php echo $a;?>" data-tooltip="#delete"><i class="fa fa-fw fa-ban"></i></a></td>
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

<!-- View Modal -->
<?php
  $teammodalview=mysqli_query($mysqli, $querryallteam) or die(mysqli_error);
  $a=0;
    while($modalview = mysqli_fetch_array($teammodalview))
      {	$a++;
        $coach1=mysqli_query($mysqli, $querrycoach) or die(mysqli_error);
        $coach2=mysqli_query($mysqli, $querrycoach) or die(mysqli_error);
?>
<div class="modal fade" id="viewModal<?php echo $a;?>" tabindex="-1" role="dialog" aria-hidden="true">
  <div style="max-width:1000px" class="modal-dialog">
      <div style="max-width:700px;margin:auto;" class="modal-content">
        <div class="container">
          <div style="max-width:100%" class="card card-register mx-auto mt-5">
            <div style="text-align:center;" class="card-header"><h2 class="text-uppercase"><?php echo $modalview['team_name'];?></h2></div>
            <div class="card-body">
              <img class="img-fluid d-block mx-auto" src="/img/team_logo/<?php echo $modalview['team_logo'];?>.png">
              <div class="form-group">
              <div class="form-row">
                <div class="col-md-6">
                    <label>Manager</label>
                    <input class="form-control" type="text" value="<?php echo $modalview['account_name'];?>" disabled>
                </div>
                <div class="col-md-6">
                    <label>Manager age</label>
                    <input class="form-control" type="number" value="<?php echo age($modalview['account_date_of_birth'])?>" disabled>
                </div>
                </div>
              </div>
              <div class="form-group">
                <div class="form-row">
                <div class="col-md-6">
                    <label>Coach</label>
                    <input class="form-control" type="text" value="<?php while($coachdata1 = mysqli_fetch_array($coach1)){if($modalview['id_team']==$coachdata1['id_team']){echo $coachdata1['coach_name'];}}?>" disabled>
                </div>
                <div class="col-md-6">
                    <label>Coach age</label>
                    <input class="form-control"type="number" value="<?php while($coachdata2 = mysqli_fetch_array($coach2)){if($modalview['id_team']==$coachdata2['id_team']){echo age($coachdata2['coach_date_of_birth']);}}?>" disabled>
                </div>
                </div>
              </div>
              <a class="btn btn-secondary btn-block" data-dismiss="modal"><i class="fa fa-times"></i> Close</a>
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

<!-- Delete Modal -->
<?php
      $teammodaldelete=mysqli_query($mysqli, $querryallteam) or die(mysqli_error);
      $a=0;
        while($modaldelete = mysqli_fetch_array($teammodaldelete))
          {	$a++;
    ?>
<div class="modal fade" id="deleteModal<?php echo $a;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete <?php echo $modaldelete['team_name'];?> team?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="/system/core/delete_team.php?id_team=<?php echo $modaldelete['id_team'];?>">Delete</a>
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
