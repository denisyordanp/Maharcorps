<?php
  include('connection.php');
  include('../function.php');
  $id_participant=$_GET['id_participant'];
  $activity_name=$_GET['activity'];
  if(isset($_POST['payment_upload'])){
    $file=$_GET['img'];
    $size = $_FILES['payment_img']['size'];
    $filetype = $_FILES['payment_img']['type'];
    if(updateimg('image/jpeg', $size, $filetype)==true){
      $imgpath="../../img/participant/".$file.".jpg";
      if(file_exists($imgpath)){
        if(!unlink($imgpath)){
          echo "<script>alert('Error on delete file, please contact administrator.')</script>";
          echo "<script>window.location='/account/public/my_activity.php'</script>";
          exit();
        }
      }
      $delimg="UPDATE participant SET payment_status_img=NULL WHERE id_participant='$id_participant'";
      mysqli_query($mysqli, $delimg);
      $target_dir = "../../img/participant/";
      $imageFileType = strtolower(pathinfo($_FILES['payment_img']['name'], PATHINFO_EXTENSION));
      $name = "payment_".$id_participant.".".$imageFileType;
      $tmpname = $_FILES["payment_img"]["tmp_name"];
      $filepath = $target_dir.$name;
      if (resizeimg($tmpname, $filepath, 50, 'pay')==true) {
        $nameimg="payment_".$id_participant;
        $dataimg="UPDATE participant SET payment_status_img='$nameimg' WHERE id_participant='$id_participant'";
        mysqli_query($mysqli,$dataimg);
      } else {
        echo "<script>alert('Error while updload image, please contact administrator.')</script>";
        echo "<script>window.location='/account/public/my_activity.php'</script>";
        exit();
      }
      mail("service@maharcorps.org","Payment upload","New payment upload by participant id ".$id_participant." on ".$activity_name." activity");
      echo "<script>alert('Upload photo success.')</script>";
      echo "<script>window.location='/account/public/my_activity.php'</script>";
      exit();
    }
  }
?>

      
      