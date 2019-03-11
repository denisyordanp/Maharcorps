<?php
  include('connection.php');
  include('../function.php');

  if(isset($_POST['profil-img-btn'])){
    $id_account=$_GET['id_account'];
    $file=$_GET['img'];
    $size = $_FILES['imgfile']['size'];
    $filetype = strtolower(pathinfo($_FILES['imgfile']['name'], PATHINFO_EXTENSION));
    updateimg('jpg', $size, $filetype);
      $target_dir = "../../img/account/";
      $imageFileType = strtolower(pathinfo($_FILES['imgfile']['name'], PATHINFO_EXTENSION));
      $name = "account_".$id_account.".".$imageFileType;
      $tmpname = $_FILES["imgfile"]["tmp_name"];
      $filepath = $target_dir.$name;
      $dbname="account_".$id_account;
      if (resizeimg($tmpname, $filepath, 100, 'profil')==true){
        $imgupdate=mysqli_query($mysqli,"UPDATE account SET account_img='$dbname' WHERE id_account='$id_account'");
        if($imgupdate){
            echo "<script>alert('Update photo success.')</script>";
            echo "<script>window.location='/account/public/index.php'</script>";
            exit();
        }else{
            echo "<script>alert('Error while save to database, please contact administrator.')</script>";
            echo "<script>window.location='/account/public/index.php'</script>";
            exit();
        }
      } else {
        echo "<script>alert('Error while updload image, please contact administrator.')</script>";
        echo "<script>window.location='/account/public/index.php'</script>";
        exit();
      }
    }
?>

      
      