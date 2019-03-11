<?php
    include('system/core/connection.php');
    $code=$_GET['code'];
    $id=$_GET['id'];
    $query="SELECT * FROM account WHERE id_account='$id'";
    $get=mysqli_query($mysqli, $query);
    $data=mysqli_fetch_array($get);
    $name=$data['account_name'];
    if($data['id_account']==NULL){
        echo"<script>alert('Error link, please login and try send verification again.')</script>";
        echo"<script>window.location='account.php'</script>";
        exit();
    }elseif($data['account_verification']==1){
        echo"<script>alert('Hey $name your account already active.')</script>";
        echo"<script>window.location='account.php'</script>";
        exit();
    }else{
        if($data['account_code']==$code){
            $confirm="UPDATE account SET account_verification=1 WHERE id_account='$id'";
            $update=mysqli_query($mysqli, $confirm);
            if($update){
                echo"<script>alert('Congratulation $name your account are activated, please continue to login page.')</script>";
                echo"<script>window.location='account.php'</script>";
                exit();
            }else{
                echo"<script>alert('Error on update, please contact to administrator.')</script>";
                echo"<script>window.location='index.php'</script>";
                exit();
            }
        }else{
            echo"<script>alert('Error code, please login and try send verification again or contact to administrator.')</script>";
            echo"<script>window.location='index.php'</script>";
            exit();
        }
    }
// // Import PHPMailer classes into the global namespace
// // These must be at the top of your script, not inside a function
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// //Load Composer's autoloader
// require('vendor/autoload.php');

// $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
// try {
//     //Server settings
//     $mail->SMTPDebug = 2;                                 // Enable verbose debug output
//     $mail->isSMTP();                                      // Set mailer to use SMTP
//     $mail->Host = 'mail.maharcorps.org';  // Specify main and backup SMTP servers
//     $mail->SMTPAuth = true;                               // Enable SMTP authentication
//     $mail->Username = 'service@maharcorps.org';                 // SMTP username
//     $mail->Password = 'Martanegara119';                           // SMTP password
//     $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
//     $mail->Port = 465;                                    // TCP port to connect to

//     //Recipients
//     $mail->setFrom('service@maharcorps.org', 'Mahar Service');
//     $mail->addAddress('kaboa.store@gmail.com');     // Add a recipient
//     $mail->addReplyTo('contact@maharcorps.org', 'Mahar Information');
//     // $mail->addCC('cc@example.com');
//     // $mail->addBCC('bcc@example.com');

//     //Attachments
//     // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//     // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

//     //Content
//     $mail->isHTML(true);                                  // Set email format to HTML
//     $mail->Subject = 'Testing';
//     $mail->Body    = 'Testing ajah';
//     // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

//     $mail->send();
//     return true;
// } catch (Exception $e) {
//     return "Message could not be sent. Mailer Error: ', $mail->ErrorInfo";
// }
?>