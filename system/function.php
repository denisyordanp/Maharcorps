<?php
    // use vendor\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\Exception;
	$month = array(
		'1' => 'January',
		'2' => 'February',
		'3' => 'March',
		'4' => 'April',
		'5' => 'May',
		'6' => 'June',
		'7' => 'July',
		'8' => 'August',
		'9' => 'September',
		'10' => 'October',
		'11' => 'November',
		'12' => 'December'
    );
    function cekpk($data){
        if($data==0){
            return " ";
        }else{
            return "*";
        }
    }
	function cekfutsaldate($mysqli,$id){
		$cekactivity="SELECT participant.id_activity, activity.activity_date, id_team FROM futsal_detail INNER JOIN participant ON participant.id_participant=futsal_detail.id_participant INNER JOIN activity ON activity.id_activity=participant.id_activity WHERE id_team='$id'";
		$cek=mysqli_query($mysqli, $cekactivity);
		$data=mysqli_fetch_array($cek);
		$now=date('Y-m-d');
		if($now>$data['activity_date']){
			return 1;
		}elseif($now<$data['activity_date']){
			return 2;
		}else{
			return true;
		}
	}
	function matchadd($matchtime,$range){
		$date = date_create($matchtime);
		date_add($date, date_interval_create_from_date_string($range.' minutes'));
		$newdate=date_format($date, 'Y-m-d H:i:s');
		return $newdate;
	}
	function idaccount($mysqli){
		$date=date('Y-m-d');
		$getlast="SELECT id_account FROM account WHERE account_register='$date' ORDER BY id_account DESC LIMIT 1";
		$result=mysqli_query($mysqli,$getlast) or die(mysqli_error);
		$id=mysqli_fetch_array($result);
		if($id==NULL){
			$newid=substr(date('Y'),2).date('md').'0101';
			return $newid;
		}else{
			return $id['id_account']+1;
		}
	}
	function idactivity($mysqli){
		$date=date('Y');
		$getlast="SELECT id_activity FROM activity WHERE YEAR(activity_register)='$date' ORDER BY id_activity DESC LIMIT 1";
		$result=mysqli_query($mysqli,$getlast) or die(mysqli_error);
		$id=mysqli_fetch_array($result);
		if($id==NULL){
			$newid=substr(date('Y'),2).'0201';
			return $newid;
		}else{
			return $id['id_activity']+1;
		}
	}
	function idactivityfutsaldetail($mysqli){
		$date=date('Y');
		$getlast="SELECT id_activity_futsal_detail FROM activity_futsal_detail WHERE YEAR(activity_futsal_detail_register)='$date' ORDER BY activity_futsal_detail_register DESC LIMIT 1";
		$result=mysqli_query($mysqli,$getlast) or die(mysqli_error);
		$id=mysqli_fetch_array($result);
		if($id==NULL){
			$newid=substr(date('Y'),2).'0301';
			return $newid;
		}else{
			return $id['id_activity_futsal_detail']+1;
		}
	}
	function idparticipant($mysqli){
		$date=date('Y-m-d');
		$getlast="SELECT id_participant FROM participant WHERE participant_registration_date='$date' ORDER BY id_participant DESC LIMIT 1";
		$result=mysqli_query($mysqli,$getlast) or die(mysqli_error);
		$id=mysqli_fetch_array($result);
		if($id==NULL){
			$newid=substr(date('Y'),2).date('md').'1201';
			return $newid;
		}else{
			return $id['id_participant']+1;
		}
	}
	function idteam($mysqli){
		$date=date('Y');
		$getlast="SELECT id_team FROM futsal_team WHERE YEAR(team_register)='$date' ORDER BY id_team DESC LIMIT 1";
		$result=mysqli_query($mysqli,$getlast) or die(mysqli_error);
		$id=mysqli_fetch_array($result);
		if($id==NULL){
			$newid=substr(date('Y'),2).'09001';
			return $newid;
		}else{
			return $id['id_team']+1;
		}
	}
	function idcoach($mysqli){
		$date=date('Y');
		$getlast="SELECT id_coach FROM futsal_coach WHERE YEAR(coach_register)='$date' ORDER BY id_coach DESC LIMIT 1";
		$result=mysqli_query($mysqli,$getlast) or die(mysqli_error);
		$id=mysqli_fetch_array($result);
		if($id==NULL){
			$newid=substr(date('Y'),2).'04001';
			return $newid;
		}else{
			return $id['id_coach']+1;
		}
	}
	function idplayer($mysqli){
		$date=date('Y-m-d');
		$getlast="SELECT id_player FROM futsal_player WHERE player_register='$date' ORDER BY id_player DESC LIMIT 1";
		$result=mysqli_query($mysqli,$getlast) or die(mysqli_error);
		$id=mysqli_fetch_array($result);
		if($id==NULL){
			$newid=substr(date('Y'),2).date('md').'0701';
			return $newid;
		}else{
			return $id['id_player']+1;
		}
	}
	function idfutsaldetail($mysqli){
		$date=date('Y');
		$getlast="SELECT id_futsal_detail FROM futsal_detail WHERE YEAR(futsal_detail_register)='$date' ORDER BY id_futsal_detail DESC LIMIT 1";
		$result=mysqli_query($mysqli,$getlast) or die(mysqli_error);
		$id=mysqli_fetch_array($result);
		if($id==NULL){
			$newid=substr(date('Y'),2).'05001';
			return $newid;
		}else{
			return $id['id_futsal_detail']+1;
		}
	}
	function idmatch($mysqli){
		$date=date('Y');
		$getlast="SELECT id_match FROM futsal_match WHERE YEAR(match_register)='$date' ORDER BY id_match DESC LIMIT 1";
		$result=mysqli_query($mysqli,$getlast) or die(mysqli_error);
		$id=mysqli_fetch_array($result);
		if($id==NULL){
			$newid=substr(date('Y'),2).'060001';
			return $newid;
		}else{
			return $id['id_match']+1;
		}
	}
	function idreferee($mysqli){
		$date=date('Y');
		$getlast="SELECT id_referee FROM futsal_referee WHERE YEAR(referee_register)='$date' ORDER BY id_referee DESC LIMIT 1";
		$result=mysqli_query($mysqli,$getlast) or die(mysqli_error);
		$id=mysqli_fetch_array($result);
		if($id==NULL){
			$newid=substr(date('Y'),2).'08001';
			return $newid;
		}else{
			return $id['id_referee']+1;
		}
	}
	function idgoal($mysqli){
		$year=date('Y');
		$month=date('m');
		$getlast="SELECT id_match_goal FROM match_goal WHERE YEAR(goal_register)='$year' AND MONTH(goal_register)='$month' ORDER BY id_match_goal DESC LIMIT 1";
		$result=mysqli_query($mysqli,$getlast) or die(mysqli_error);
		$id=mysqli_fetch_array($result);
		if($id==NULL){
			$newid=substr(date('Y'),2).date('m').'10001';
			return $newid;
		}else{
			return $id['id_match_goal']+1;
		}
	}
	function idoffense($mysqli){
		$year=date('Y');
		$month=date('m');
		$getlast="SELECT id_offense FROM match_offense WHERE YEAR(offense_register)='$year' AND MONTH(offense_register)='$month' ORDER BY id_offense DESC LIMIT 1";
		$result=mysqli_query($mysqli,$getlast) or die(mysqli_error);
		$id=mysqli_fetch_array($result);
		if($id==NULL){
			$newid=substr(date('Y'),2).date('m').'11001';
			return $newid;
		}else{
			return $id['id_offense']+1;
		}
    }
    function cek_team($mysqli, $id_team){
		$cekteam="SELECT COUNT(id_team) FROM futsal_player WHERE id_team='$id_team'";
        $teamdata = mysqli_query($mysqli, $cekteam) or die(mysqli_error);
        $team=mysqli_fetch_array($teamdata);
		if($team['COUNT(id_team)'] < 9){
            return true;
		}else{
			return false;
		}
    }
    function cek_number($mysqli, $id_team, $number){
        $querrynumber="SELECT COUNT(player_number) FROM futsal_player WHERE id_team='$id_team' AND player_number='$number'";
        $check_number = mysqli_query($mysqli, $querrynumber) or die(mysql_error);
        $number=mysqli_fetch_array($check_number);
        if($number['COUNT(player_number)'] == 0){
            return true;
		}else{
			return false;
		}
    }
	function cek_join($mysqli,$id_account,$id_activity){
		$joincheck="SELECT * FROM participant WHERE id_account='$id_account' AND id_activity='$id_activity'";
		$cekaccount="SELECT * FROM account WHERE id_account='$id_account'";
		$cekactivity="SELECT * FROM activity WHERE id_activity='$id_activity'";
		$account=mysqli_query($mysqli,$cekaccount) or die(mysqli_error);
		$accounttype=mysqli_fetch_array($account);
		$activity=mysqli_query($mysqli,$cekactivity);
		$activitystatus=mysqli_fetch_array($activity);
		$result=mysqli_query($mysqli,$joincheck);
		if(mysqli_num_rows($result)>=1){
			?>
			<script>alert('You are already joined');</script>
			<script>window.location='/account/public/my_activity.php'</script>;
			<?php
		}else{
			if($activitystatus['activity_status']=='Member Only'){
				if($accounttype['account_user_type']=='Member' || $accounttype['account_user_type']=='Admin'){
					return true;
				}else{
					?>
						<script>alert('Sorry this event just for member of Maharcorps only.');</script>
						<script>window.location='/account/public/my_activity.php'</script>;
					<?php
				}
			}else{
				return true;
			}
		}
    }
    function cek_join_team($mysqli, $id_participant, $id_team){
		$cekteam="SELECT * FROM futsal_detail WHERE id_participant='$id_participant' AND id_team='$id_team'";
		$teamdata = mysqli_query($mysqli, $cekteam) or die(mysqli_error);
		if(mysqli_num_rows($teamdata) == 0){
            return true;
		}else{
			return false;
		}
    }
    function cek_total_player($mysqli, $id_team){
        $cekplayer="SELECT id_player, id_team FROM futsal_player WHERE id_team='$id_team'";
        $playerdata=mysqli_query($mysqli, $cekplayer) or die(mysqli_error);
        if(mysqli_num_rows($playerdata) < 3){
            return false;
		}else{
			return true;
		}
    }
	function cek_email($mysqli,$email){
		$emailcheck="SELECT account_email FROM account WHERE account_email='$email'";
		$result=mysqli_query($mysqli,$emailcheck);
		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			if(mysqli_num_rows($result) == 1){
				echo "<script>alert('Sorry, this email already exist. Please use another email or if you forgot your email, please kindly contact our administrator. Thank you.')</script>";
				echo "<script>window.location='/account.php'</script>";
			}else{
				return true;
			}
		}else{
			echo "<script>alert('Please enter a valid email address and try again. Thank you.')</script>";
			echo "<script>window.location='/account.php'</script>";
		}
	}

	if(isset($_POST['update-profil'])){
		session_start();
		$id_account = $_SESSION['id_account'];
		$name = $_POST['name'];
		$newname = filter_var($name, FILTER_SANITIZE_STRING);
		$email = $_POST['email'];
		$birth = $_POST['birthday'];
		$contact = $_POST['contact'];
		$address = $_POST['address'];
		$pass = $_POST['pass'];
		$re_pass = $_POST['re-pass'];
		$message="Profil updated";
		if (strlen($newname) > 15) {
			echo "<script>alert('Sorry, please use under 15 character of name. Thank you.')</script>";
			echo "<script>window.location='/account/public/index.php'</script>";
			exit();
		}else{
			$checkupdatecontact = "SELECT id_account, account_contact_number FROM account WHERE account_contact_number='$contact' AND id_account!='$id_account'";
			$checkupdateemail = "SELECT id_account, account_email FROM account WHERE account_email='$email' AND id_account!='$id_account'";
			$newpass=$_SESSION['password_login'];
			$emaildata = mysqli_query($mysqli,$checkupdateemail);
			$contactdata = mysqli_query($mysqli,$checkupdatecontact);
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				if(mysqli_num_rows($emaildata) >= 1){
					echo "<script>alert('Sorry, this email is used by another account. Please use another email.')</script>";
					echo "<script>window.location='/account/public/index.php'</script>";
					exit();
				}elseif(mysqli_num_rows($contactdata) >= 1){
					echo "<script>alert('Sorry, this contact number is used by another account. Please use another contact number.')</script>";
					echo "<script>window.location='/account/public/index.php'</script>";
					exit();
				}else{
					if($pass!=NULL){
						if($re_pass!=NULL){
							if($pass!=$re_pass){
								echo "<script>alert('Your password and repeat password not match.')</script>";
								echo "<script>window.location='/account/public/index.php'</script>";
								exit();
							}else{
								$newpass=md5($pass);
								$message="Password and profil updated";
							}
						}else{
							echo "<script>alert('Please fill repeat password to change your password.')</script>";
							echo "<script>window.location='/account/public/index.php'</script>";
							exit();
						}
					}
					$updateprofil="UPDATE account SET account_name='$name', account_email='$email', account_date_of_birth='$birth', account_contact_number='$contact', account_address='$address', account_password='$newpass' WHERE id_account='$id_account'";
					$done =mysqli_query($mysqli, $updateprofil) or die(mysql_error);
					if ($done) {
						$_SESSION['password_login']=$newpass;
						echo"<script>alert('$message')</script>";
						echo"<script>window.location='/account/public/index.php'</script>";
						exit();
					}
				}
			}else{
				echo "<script>alert('Please enter a valid email address and try again. Thank you.')</script>";
				exit();
			}
		}
    }
	
	function login($email, $pass, $mysqli){
		if($stmt = $mysqli->prepare("SELECT id_account, account_password, account_user_type, account_verification FROM account WHERE account_email = ?")){
			$stmt->bind_param('s', $email);
			$stmt->execute();
			$stmt->store_result();
			$stmt->bind_result($id, $dbpassword, $user_type, $verification);
			$stmt->fetch();
	
			if($stmt->num_rows == 1){
				if($dbpassword == md5($pass)){
                    $_SESSION['id_account'] = $id;
					$_SESSION['password_login'] = md5($pass);
					$_SESSION['akses'] = $user_type;
                    $_SESSION['verification'] = $verification;
					return true;
				}else{
					return false;   
				}
			}else{
				return false;   
			}
		}
	}
	
	function cek_login($mysqli){
		if(isset($_SESSION['id_account'], $_SESSION['password_login'])){
			$id_account = $_SESSION['id_account'];
			$password_login = $_SESSION['password_login'];
				
			if($stmt = $mysqli->prepare("SELECT account_password FROM account WHERE id_account = ? LIMIT 1")){
				$stmt->bind_param('i', $id_account);
				$stmt->execute();
				$stmt->store_result();
				
				if($stmt->num_rows == 1){
					$stmt->bind_result($password);
					$stmt->fetch();
					
					if($password_login == $password){
						return true;    
					}else{
						return false;   
					}
				}else{
					return false;   
				}
			}else{
				return false;   
			}
		}else{
			return false;   
		}
	}

	function rupiah($fee){	
		$result_rupiah = "Rp. " . number_format($fee,0,',','.');
		return $result_rupiah;
	}
	function ordinal($num){
		if(!in_array(($num%100),array(11,12,13))){
			switch($num % 100){
				case 1: return $num.'st';
				case 2: return $num.'nd';
				case 3: return $num.'rd';
			}
		}
		return $num.'th';
	}
	function age($birthday){
		$today = date("Y-m-d");
		$diff = date_diff(date_create($birthday), date_create($today));
		$result = $diff->format('%y');
		return $result;
	}
	if(isset($_POST['announcement-update'])){
		$paragraph1 = $_POST['paragraph1'];
		$paragraph2 = $_POST['paragraph2'];
		$updateannouncement="UPDATE announcement SET announcement1='$paragraph1', announcement2='$paragraph2'";
		$done = mysqli_query($mysqli, $updateannouncement) or die(mysql_error);
		if($done){
			echo "<script>alert('Announcement updated.')</script>";
            echo "<script>window.location='/account/admin/announcement.php'</script>";
		}else{
			echo "<script>alert('Error while saving to database, please contact developer.')</script>";
            echo "<script>window.location='/account/admin/announcement.php'</script>";
		}
	}
	if(isset($_POST['about-update'])){
		$paragraph1 = $_POST['paragraph1'];
		$paragraph2 = $_POST['paragraph2'];
		$paragraph3 = $_POST['paragraph3'];
		$updateabout="UPDATE about SET paragraph1='$paragraph1', paragraph2='$paragraph2', paragraph3='$paragraph3'";
		$done = mysqli_query($mysqli, $updateabout) or die(mysql_error);
		if($done){
			echo "<script>alert('About updated.')</script>";
            echo "<script>window.location='/account/admin/announcement.php'</script>";
		}else{
			echo "<script>alert('Error while saving to database, please contact developer.')</script>";
            echo "<script>window.location='/account/admin/announcement.php'</script>";
		}
	}
	function random(){
		$karakter = '';
		$karakter .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
		$karakter .= '1234567890';
		
		$string = '';
		for ($i=0; $i < 10; $i++){ 
			$pos = rand(0, strlen($karakter)-1);
			$string .= $karakter{$pos};
		}
		return $string;
	}
	function cekcoach($mysqli, $id_team){
		$cekcoach="SELECT * FROM futsal_coach WHERE id_team='$id_team'";
		$data=mysqli_query($mysqli, $cekcoach) or die(mysqli_error);
		$coachdata = mysqli_fetch_array($data);
		  if($coachdata!=NULL){
			return $coachdata['coach_name'];
		  }else{
			return "Not yet";
		  }
	  }
	  function cekteam($mysqli, $id_team){
		$cekteam="SELECT * FROM futsal_team WHERE id_team='$id_team'";
		$data=mysqli_query($mysqli, $cekteam) or die(mysqli_error);
		$teamdata = mysqli_fetch_array($data);
		return $teamdata['team_name'];
	  }
	  function cekmanager($mysqli, $id_team){
		$cekmanager="SELECT account.id_account, account.account_name FROM futsal_team INNER JOIN account ON account.id_account=futsal_team.id_account WHERE id_team='$id_team'";
		$data=mysqli_query($mysqli, $cekmanager) or die(mysqli_error);
		$managerdata = mysqli_fetch_array($data);
		return $managerdata['account_name'];
	  }
	  function cekuniform($mysqli, $id_team){
		$cekteam="SELECT * FROM futsal_team WHERE id_team='$id_team'";
		$data=mysqli_query($mysqli, $cekteam) or die(mysqli_error);
		$teamdata = mysqli_fetch_array($data);
		return $teamdata['team_uniform'];
	  }
	  function cekreferee($mysqli, $id_referee){
		$cekreferee="SELECT * FROM futsal_referee WHERE id_referee='$id_referee'";
		$data=mysqli_query($mysqli, $cekreferee) or die(mysqli_error);
		$refereedata = mysqli_fetch_array($data);
		  if($refereedata!=NULL){
			return $refereedata['referee_name'];
		  }else{
			return "Not yet";
		  }
	  }
	  function cekscore($mysqli, $team, $match){
		  $scorequerry="SELECT COUNT(id_match_goal), id_match, futsal_player.id_player, futsal_player.id_team FROM match_goal INNER JOIN futsal_player ON futsal_player.id_player=match_goal.goal WHERE futsal_player.id_team='$team' AND id_match='$match' AND goal_category!='PK-Draw'";
		  $data=mysqli_query($mysqli, $scorequerry) or die(mysqli_error);
		  $scoredata = mysqli_fetch_array($data);
		  return $scoredata['COUNT(id_match_goal)'];
	  }
	  function cekgoal($mysqli, $match, $id){
		$querrygoal="SELECT COUNT(goal) FROM match_goal WHERE id_match='$match' AND goal='$id'";
		$goal=mysqli_query($mysqli, $querrygoal) or die(mysqli_error);
		$goaldata = mysqli_fetch_array($goal);
		return $goaldata['COUNT(goal)'];
	  }
	  function cekassist($mysqli, $match, $id){
		$querryassist="SELECT COUNT(assist) FROM match_goal WHERE id_match='$match' AND assist='$id'";
		$assist=mysqli_query($mysqli, $querryassist) or die(mysqli_error);
		$assistdata = mysqli_fetch_array($assist);
		return $assistdata['COUNT(assist)'];
	  }
	  function cekyellow($mysqli, $match, $id){
		$querryellow="SELECT COUNT(offense_card) FROM match_offense WHERE id_match='$match' AND id_player='$id' AND offense_card='Yellow'";
		$yellow=mysqli_query($mysqli, $querryellow) or die(mysqli_error);
		$yellowdata = mysqli_fetch_array($yellow);
		return $yellowdata['COUNT(offense_card)'];
	  }
	  function cekred($mysqli, $match, $id){
		$querrred="SELECT COUNT(offense_card) FROM match_offense WHERE id_match='$match' AND id_player='$id' AND offense_card='Red'";
		$red=mysqli_query($mysqli, $querrred) or die(mysqli_error);
		$reddata = mysqli_fetch_array($red);
		return $reddata['COUNT(offense_card)'];
	  }
	function cekdate($mysqli, $match){
		$querrytime="SELECT match_time FROM futsal_match WHERE id_match='$match'";
		$data=mysqli_query($mysqli, $querrytime) or die(mysqli_error);
		$match = mysqli_fetch_array($data);
		$matchtime=new DateTime($match['match_time']);
		$matchadd=date_add($matchtime, date_interval_create_from_date_string('1 hours'));
		$date = new DateTime();
		if($matchadd<$date){
			return false;
		}else{
			return true;
		}
	}
	function cekactivitydate($mysqli, $activity){
		$querrytime="SELECT activity_date FROM activity WHERE id_activity='$activity'";
		$data=mysqli_query($mysqli, $querrytime) or die(mysqli_error);
		$activity = mysqli_fetch_array($data);
		$activitytime=new DateTime($activity['activity_date']);
		$activityadd=date_add($activitytime, date_interval_create_from_date_string('1 days'));
		$date = new DateTime();
		if($activityadd<$date){
			return false;
		}else{
			return true;
		}
	}
	function cekteamimg($mysqli, $team){
		$querrylogo="SELECT team_logo FROM futsal_team WHERE id_team='$team'";
		$data=mysqli_query($mysqli, $querrylogo) or die(mysqli_error);
		$logo = mysqli_fetch_array($data);
		if($logo==NULL){
			return false;
		}else{
			return $logo['team_logo'];
		}
	}
	function cekactivitydetail($mysqli, $activity){
		$querryactivity="SELECT * FROM activity_futsal_detail WHERE id_activity='$activity'";
		$data=mysqli_query($mysqli, $querryactivity) or die(mysqli_error);
		$activity = mysqli_fetch_array($data);
		if($activity==NULL){
			return false;
		}else{
			return true;
		}
	}
	function ceknullimg($image){
		if($image==NULL){
			return "null";
		}else{
			return $image;
		}
	}
	function cek_name($mysqli, $name, $id_team){
        $querryName = "SELECT id_team, team_name FROM futsal_team WHERE team_name='$name' AND id_team!='$id_team'";
        $check_name = mysqli_query($mysqli, $querryName) or die(mysql_error);
        if(mysqli_num_rows($check_name) == 0){
            return true;
		}else{
			return false;
		}
	}
	function updateimg($type, $size, $filetype){
		if ($size > 1000000) {
		 echo "<script>alert('File is to large.')</script>";
		 echo "<script>window.location='/account/public/index.php'</script>";
		 exit();
	   }elseif($filetype!=$type){
		 echo "<script>alert('Please use .jpg file type for profile photo. or .png file for team logo.')</script>";
		 echo "<script>window.location='/account/public/index.php'</script>";
		 exit();
	   }else{
         return true;
         exit();
	   }
	 }
	 function resizeimg($tmpName, $filePath, $quality, $stat){
	   $result = move_uploaded_file($tmpName, $filePath);
	   $orig_image = imagecreatefromjpeg($filePath);
	   $image_info = getimagesize($filePath); 
	   $width_orig  = $image_info[0];
	   $height_orig = $image_info[1];
	   if($stat=='pay'){
			$width = $width_orig;
			$height = $height_orig;
	   }elseif($stat=='profil'){
			$width = 500;
			$height = 500;
	   }
	   $destination_image = imagecreatetruecolor($width, $height);
		imagecopyresampled($destination_image, $orig_image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
		imagejpeg($destination_image, $filePath, $quality);
       return true;
       exit();
	 }
	 function cekclosed($mysqli, $end, $date, $type){
		 $dateadd = date_create($date);
		 date_add($dateadd, date_interval_create_from_date_string('1 day'));
		 $newdate=date_format($dateadd, 'Y-m-d');
		 $now=date('Y-m-d');
		 if($type == 'Futsal' && $end >= $now){
			 return true;
		 }elseif($newdate > $now && $type == 'General'){
			 return true;
		 }else{
			 return false;
		 }
	 }
	 function getaccdata($mysqli, $m){
		$current=date('Y');
		$accquery="SELECT COUNT(id_account) FROM account WHERE YEAR(account_register)='$current' AND MONTH(account_register)='$m'";
		$data=mysqli_query($mysqli, $accquery);
		$accdata=mysqli_fetch_array($data);
		return $accdata['COUNT(id_account)'];
     }
     function cekmaxteam($mysqli, $id_activity){
         $cekactivity="SELECT * FROM activity_futsal_detail WHERE id_activity='$id_activity'";
         $activity=mysqli_query($mysqli, $cekactivity);
         $max=mysqli_fetch_array($activity);
         $cekteam="SELECT COUNT(id_futsal_detail), participant.participant_payment_status, participant.id_activity, id_team FROM futsal_detail INNER JOIN participant ON participant.id_participant=futsal_detail.id_participant WHERE participant.participant_payment_status=1 AND participant.id_activity='$id_activity'";
         $team=mysqli_query($mysqli, $cekteam);
         $count=mysqli_fetch_array($team);
         if($count['COUNT(id_futsal_detail)']<$max['competition_maxteam']){
             return true;
         }else{
             return false;
         }
     }
    //  function sendmail($to, $sub, $msg){
    //     require('../vendor/PHPMailer/Exception.php');
    //     require('../vendor/PHPMailer/PHPMailer.php');
    //     require('../vendor/PHPMailer/SMTP.php');
    //     $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    //     try {
    //         //Server settings
    //         $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    //         $mail->isSMTP();                                      // Set mailer to use SMTP
    //         $mail->Host = 'mail.maharcorps.org';  // Specify main and backup SMTP servers
    //         $mail->SMTPAuth = true;                               // Enable SMTP authentication
    //         $mail->Username = 'service@maharcorps.org';                 // SMTP username
    //         $mail->Password = 'Martanegara119';                           // SMTP password
    //         $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    //         $mail->Port = 465;                                    // TCP port to connect to

    //         //Recipients
    //         $mail->setFrom('service@maharcorps.org', 'Mahar Service');
    //         $mail->addAddress($to);     // Add a recipient
    //         $mail->addReplyTo('contact@maharcorps.org', 'Mahar Information');
    //         // $mail->addCC('cc@example.com');
    //         // $mail->addBCC('bcc@example.com');

    //         //Attachments
    //         // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //         // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    //         //Content
    //         $mail->isHTML(true);                                  // Set email format to HTML
    //         $mail->Subject = $sub;
    //         $mail->Body    = $msg;
    //         // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    //         $mail->send();
    //         return true;
    //     } catch (Exception $e) {
    //         return "Message could not be sent. Mailer Error: ', $mail->ErrorInfo";
    //     }
    //  }
?>