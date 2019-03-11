<?php
	require('../../vendor/fpdf/fpdf.php');
    include('connection.php');
    include('../function.php');
    include('../querry/querry_all.php');
	include('../session/admin_page_session.php');
    $id_activity = $_GET['id_activity'];
    $querryteamactivity="SELECT id_futsal_detail, participant.id_activity, futsal_team.id_team, account.id_account, account.account_name, futsal_team.team_name, futsal_team.team_logo FROM futsal_detail INNER JOIN participant ON participant.id_participant=futsal_detail.id_participant INNER JOIN futsal_team ON futsal_team.id_team=futsal_detail.id_team INNER JOIN account ON futsal_team.id_account=account.id_account WHERE id_activity='$id_activity'";
    $activityteamdata=mysqli_query($mysqli, $querryteamactivity) or die(mysqli_error);
    $activitydata=mysqli_query($mysqli, $querryactivity) or die(mysqli_error);
	$hasil2 = mysqli_fetch_array($activitydata);
	// Instanciation of inherited class

	class PDF extends FPDF
	{
	// Page header
	function Header()
	{
	    // Logo
	    $this->Image('../../img/logo-print.png',1,1,0);
	    // Arial bold 15
	    $this->SetFont('Times','B',18);
	    // Move to the right
	    // Title
	    $this->Cell(0,1,'MAHAR CORPS',0,0,'C');
	    $this->SetFont('Times','B',10);
	    $this->Ln(0);
	    $this->Cell(0,2,'Jl. Mahar Martanegara No. 119, Leuwigajah, Cimahi Selatan, Kota Cimahi',0,0,'C');
	    $this->SetFont('Times','I',10);
	    $this->Ln(0);
	    $this->Cell(0,3,'phone : -, email : contact@maharcorps.org',0,0,'C');
	    // Line break
	    $this->Line(17,3,4,3);
	    $this->Ln(3);
	}

	// Page footer
	function Footer()
	{
	    // Position at 1.5 cm from bottom
	    $this->SetY(-7);
	    // Arial italic 8
	    $this->SetFont('Arial','I',8);
	    // Page number
	    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
	}
	}
	$pdf = new PDF('P','cm','A4');
    $pdf->AddPage();
    $pdf->SetFont('Times','B',14);
    $pdf->Cell(0,0,strtoupper($hasil2['activity_name']),0,0,'C');
	$pdf->Ln(0.5);
	$pdf->SetFont('Times','B',12);
    $pdf->Cell(0,0,'TEAM REGISTERED LIST',0,0,'C');
	$pdf->Ln(0.5);
	$pdf->SetFont('Times','I',10);
    $pdf->Cell(0.5,0,'',0,0,'L');
    $pdf->Cell(1,0,'Date',0,0,'L');
    $pdf->Cell(0.5,0,'',0,0,'L');
    $pdf->Cell(3,0,':'.$hasil2['DAY(activity_date)'].' '.$month[$hasil2['MONTH(activity_date)']].' '.$hasil2['YEAR(activity_date)'],0,0,'L');
    $pdf->Ln(0.5);
    $pdf->Cell(0.5,0,'',0,0,'L');
	$pdf->Cell(1,0,'Location',0,0,'L');
	$pdf->Cell(0.5,0,'',0,0,'L');
	$pdf->Cell(2,0,':'.$hasil2['activity_location'],0,0,'L');
    $pdf->Ln(0.5);
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(0.5,0,'',0,0,'C');
	$pdf->Cell(1,0.5,'No.',1,0,'C');
	$pdf->Cell(6,0.5,'Team',1,0,'C');
	$pdf->Cell(4.5,0.5,'Manager Name',1,0,'C');
	$pdf->Cell(4.5,0.5,'Coach Name',1,0,'C');
	$pdf->Cell(2,0.5,'Total Player',1,0,'C');
	$pdf->Ln();
	$pdf->SetFont('Times','',10);
	$a=1;
	while($hasil = mysqli_fetch_array($activityteamdata))
	{
        $id_team=$hasil['id_team'];
        $querryteam="SELECT * FROM futsal_player WHERE id_team='$id_team'";
        $totalplayer=mysqli_query($mysqli, $querryteam) or die(mysqli_error);
        $querrycoachteam="SELECT * FROM futsal_coach WHERE id_team='$id_team'";
        $coach=mysqli_query($mysqli, $querrycoachteam) or die(mysqli_error);
		$coachdata = mysqli_fetch_array($coach);
		$img="../../img/team_logo/".cekteamimg($mysqli, $id_team).".png";
		$pdf->Cell(0.5,0,'',0,0,'C');
		$pdf->Cell(1,1.25,$a,1,0,'C');
		$pdf->Cell(1,1.25,$pdf->Image($img,$pdf->GetX(), $pdf->GetY(),1),1,0,'R');
		$pdf->Cell(5,1.25,$hasil['team_name'],1,0,'C');
		$pdf->Cell(4.5,1.25,$hasil['account_name'],1,0,'C');
		if($coachdata!=NULL){
			$coachname=$coachdata['coach_name'];
		}else{
			$coachname="Not Yet";
		}
		$pdf->Cell(4.5,1.25,$coachname,1,0,'C');
		$pdf->Cell(2,1.25,mysqli_num_rows($totalplayer),1,0,'C');
		$pdf->Ln();
		$a++;
	}
    $pdf->Output(strtolower($hasil2['activity_name']).'_registered_team_list.pdf','I');
?>