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
    <?php
        $id_activity = $_GET['id_activity'];
        $querryactivity="SELECT * FROM activity WHERE id_activity='$id_activity'";
        $activitydata=mysqli_query($mysqli, $querryactivity) or die(mysqli_error);
        $activity = mysqli_fetch_array($activitydata);
    ?>
  <!-- Content -->
  <div class="content-wrapper">
    <div class="container-fluid">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <p>Content</p>
        </li>
        <li class="breadcrumb-item active"><a style="text-decoration:none;" href="activity.php">Activity</a></li>
        <li class="breadcrumb-item active">Payment status</li>
      </ol>
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-users"></i> <?php echo $activity['activity_name'];?> Participant data
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Total team</th>
                  <th>Contact number</th>
                  <th>Upload payment</th>
                  <th>Payment</th>
                  <th>Registrationion date</th>
                  <th>Total payment</th>
                  <th>Operation</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                    <th>Name</th>
                  <th>Total team</th>
                  <th>Contact number</th>
                  <th>Upload payment</th>
                  <th>Payment</th>
                  <th>Registrationion date</th>
                  <th>Total payment</th>
                  <th>Operation</th>
                </tr>
              </tfoot>
              <tbody>
                <?php
                    $querryparticipant="SELECT id_participant, account.id_account, account.account_email, account.account_name, account.account_date_of_birth, account.account_contact_number, account.account_address, account.account_img, activity.id_activity, activity.activity_name, participant_payment_status, payment_status_img, DAY(participant_registration_date), MONTH(participant_registration_date), YEAR(participant_registration_date) FROM participant
                    INNER JOIN activity ON activity.id_activity=participant.id_activity
                    INNER JOIN account ON account.id_account=participant.id_account WHERE activity.id_activity = '$id_activity'";
                    $participant=mysqli_query($mysqli, $querryparticipant) or die(mysqli_error);
                    $a=0;
                    while($participantdata = mysqli_fetch_array($participant)){
                    $id_account=$participantdata['id_account'];
                    $queryteam="SELECT COUNT(id_futsal_detail) FROM futsal_detail INNER JOIN participant ON participant.id_participant=futsal_detail.id_participant INNER JOIN futsal_team ON futsal_team.id_team=futsal_detail.id_team WHERE futsal_team.id_account='$id_account' AND participant.id_activity='$id_activity'";
                    $totalteam=mysqli_query($mysqli, $queryteam) or die(mysqli_error);
                    $totreg=mysqli_fetch_array($totalteam);
                ?>
                    <tr>
                      <td><?php echo $participantdata['account_name'];?></td>
                      <td><?php echo $totreg['COUNT(id_futsal_detail)'];?></td>
                      <td><?php echo $participantdata['account_contact_number'];?></td>
                      <td><?php if($participantdata['payment_status_img']!=NULL){echo "Yes";}else{echo "No";}?></td>
                      <td><?php if($participantdata['participant_payment_status']==0){echo "Not yet";}elseif($participantdata['participant_payment_status']==1){echo "Complete";}?></td>
                      <td><?php echo $participantdata['DAY(participant_registration_date)'], " ",$month[$participantdata['MONTH(participant_registration_date)']]," ",$participantdata['YEAR(participant_registration_date)']; ?></td>
                      <td><?php echo rupiah($activity['activity_fee']*$totreg['COUNT(id_futsal_detail)']);?></td>
                      <td style="text-align:center;"><a href="" data-toggle="modal" data-target="#viewModal<?php echo $a+1;?>" data-tooltip="#view"><i class="fa fa-fw fa-eye"></i></a>|<a href="" data-toggle="modal" data-target="#deleteModal<?php echo $a+1;?>" data-tooltip="#delete"><i class="fa fa-fw fa-ban"></i></a>|<a href="" data-toggle="modal" data-target="#paymentModal<?php echo $a+1;?>" data-tooltip="#proof"><i class="fa fa-fw fa-money"></i></a></td>
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
      $participantdetail=mysqli_query($mysqli, $querryparticipant) or die(mysqli_error);
      $a=0;
        while($detail = mysqli_fetch_array($participantdetail))
          {	$a++;
    ?>
<div class="modal fade" id="viewModal<?php echo $a;?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="container">
          <div class="card card-register mx-auto mt-5">
            <div class="card-header"><h2 class="text-uppercase">participant detail</h2></div>
            <div class="card-body">
                <div class="form-group">
                    <div class="form-row">
                    <div class="col-md-6">
                        <img style="max-width:210px;" src="/img/account/<?php echo $detail['account_img'];?>.jpg">
                    </div>
                    <div class="col-md-6">
                        <label>Name</label>
                        <input class="form-control" type="text" value="<?php echo $detail['account_name'];?>" disabled>
                        <label>Birthdate</label>
                        <input class="form-control" type="text" value="<?php echo $detail['account_date_of_birth'];?>" disabled>
                        <label>Contact number</label>
                        <input class="form-control" type="text" value="<?php echo $detail['account_contact_number'];?>" disabled>
                    </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" type="text" value="<?php echo $detail['account_email'];?>" disabled>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input class="form-control" type="text" value="<?php echo $detail['account_address'];?>" disabled>
                </div>
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

<!-- Payment Modal -->
<?php
      $participantmodalpayment=mysqli_query($mysqli, $querryparticipant) or die(mysqli_error);
      $a=0;
        while($modalpayment = mysqli_fetch_array($participantmodalpayment))
          {	$a++;
    ?>
<div class="modal fade" id="paymentModal<?php echo $a;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div>
            <form action="/system/core/update_payment.php?id_participant=<?php echo $modalpayment['id_participant'];?>&id_activity=<?php echo $id_activity;?>&activity=<?php echo $modalpayment['activity_name'];?>&email=<?php echo $modalpayment['account_email'];?>&page=participant" style="text-align:center;" method="POST">
            <h5>Payment status?</h5>
            <?php if($modalpayment['payment_status_img'] == NULL || $modalpayment['payment_status_img'] == "Rejected"){ ?>
            <p>No data uploaded</p>
            <?php }else{ ?>
            <img style="max-width:100%;padding:5px;" src="/img/participant/<?php echo $modalpayment['payment_status_img'];?>.jpg">
            <?php } ?>
            <select style="max-width:200px;margin:auto;" name="payment" class="form-control">
              <option value="0" <?php echo ($modalpayment['participant_payment_status'] == '0')? 'selected="selected"':'';?>>Not yet</option>
              <option value="1" <?php echo ($modalpayment['participant_payment_status'] == '1')? 'selected="selected"':'';?>>Complete</option>
              <option value="Rejected" <?php echo ($modalpayment['payment_status_img'] == 'Rejected')? 'selected="selected"':'';?>>Reject</option>
            </select>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
            </form>
          </div>
        </div>
      </div>
    </div>
<?php
}
?>

<!-- Delete Modal -->
<?php
      $participantmodaldelete=mysqli_query($mysqli, $querryparticipant) or die(mysqli_error);
      $a=0;
        while($modaldelete = mysqli_fetch_array($participantmodaldelete))
          {	$a++;
    ?>
<div class="modal fade" id="deleteModal<?php echo $a;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete <?php echo $modaldelete['account_name'];?> participant, from <?php echo $modaldelete['activity_name'];?> activity?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="/system/core/delete_participant.php?id_participant=<?php echo $modaldelete['id_participant'];?>&id_activity=<?php echo $modaldelete['id_activity'];?>&id_account=<?php echo $modaldelete['id_account'];?>">Delete</a>
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
