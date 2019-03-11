<?php
	require('../../vendor/fpdf/fpdf.php');
    include('connection.php');
    include('../function.php');
    include('../querry/querry_all.php');
    $id_activity_futsal_detail = $_GET['id_activity_futsal_detail'];
    $id_activity = $_GET['id_activity'];
    $querrymatch="SELECT id_match, id_activity_futsal_detail, Home, Away, id_referee_1, id_referee_2, match_time, DAY(match_time), MONTH(match_time), YEAR(match_time), match_field FROM futsal_match WHERE id_activity_futsal_detail='$id_activity_futsal_detail' ORDER BY match_time ASC";
    $querryoneactivity="SELECT id_activity, activity_name, activity_registration_start, activity_registration_end, activity_date, DAY(activity_registration_start), MONTH(activity_registration_start), YEAR(activity_registration_start), DAY(activity_registration_end), MONTH(activity_registration_end), YEAR(activity_registration_end), DAY(activity_date), MONTH(activity_date), YEAR(activity_date), activity_description, activity_status, activity_type, activity_location, activity_fee, activity_img FROM activity WHERE id_activity='$id_activity'";
    $matchdata=mysqli_query($mysqli, $querrymatch) or die(mysqli_error);
    $activitydata=mysqli_query($mysqli, $querryoneactivity) or die(mysqli_error);
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
    $pdf->Cell(0,0,'COMPETITION SCHEDULE',0,0,'C');
	$pdf->Ln(0.5);
	$pdf->SetFont('Times','I',10);
    $pdf->Cell(0.5,0,'',0,0,'L');
    $pdf->Cell(1,0,'Start date',0,0,'L');
    $pdf->Cell(0.5,0,'',0,0,'L');
    $pdf->Cell(3,0,':'.$hasil2['DAY(activity_date)'].' '.$month[$hasil2['MONTH(activity_date)']].' '.$hasil2['YEAR(activity_date)'],0,0,'L');
    $pdf->Ln(0.5);
    $pdf->Cell(0.5,0,'',0,0,'L');
	$pdf->Cell(1,0,'Location',0,0,'L');
	$pdf->Cell(0.5,0,'',0,0,'L');
	$pdf->Cell(2,0,':'.$hasil2['activity_location'],0,0,'L');
    $pdf->Ln(0.5);
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(0.5,0.5,'',0,0,'C');
	$pdf->Cell(1,0.5,'No.',1,0,'C');
	$pdf->Cell(3,0.5,'Date',1,0,'C');
	$pdf->Cell(2,0.5,'Time',1,0,'C');
	$pdf->Cell(4.5,0.5,'Home Team',1,0,'C');
	$pdf->Cell(1,0.5,'VS',1,0,'C');
    $pdf->Cell(4.5,0.5,'Away Team',1,0,'C');
    $pdf->Cell(2,0.5,'Field',1,0,'C');
	$pdf->Ln();
	$pdf->SetFont('Times','',10);
	$a=1;
	while($hasil = mysqli_fetch_array($matchdata))
	{
        $home=$hasil['Home'];
        $away=$hasil['Away'];
        $referee1=$hasil['id_referee_1'];
		$referee2=$hasil['id_referee_2'];
		$homeimg="../../img/team_logo/".cekteamimg($mysqli, $home).".png";
		$awayimg="../../img/team_logo/".cekteamimg($mysqli, $away).".png";
	$pdf->Cell(0.5,1.25,'',0,0,'C');
	$pdf->Cell(1,1.25,$a,1,0,'C');
	$pdf->Cell(3,1.25,$hasil['DAY(match_time)']." ".$month[$hasil['MONTH(match_time)']]." ".$hasil['YEAR(match_time)'],1,0,'C');
	$pdf->Cell(2,1.25,date('H:i',strtotime($hasil['match_time'])).' WIB',1,0,'C');
	$pdf->Cell(3.5,1.25,cekteam($mysqli, $home),1,0,'C');
	$pdf->Cell(1,1.25,$pdf->Image($homeimg,$pdf->GetX(), $pdf->GetY(),1),1,0,'R');
	$pdf->Cell(1,1.25,'vs',1,0,'C');
	$pdf->Cell(1,1.25,$pdf->Image($awayimg,$pdf->GetX(), $pdf->GetY(),1),1,0,'R');
    $pdf->Cell(3.5,1.25,cekteam($mysqli, $away),1,0,'C');
    $pdf->Cell(2,1.25,"On field ".$hasil['match_field'],1,0,'C');
	$pdf->Ln();
	$a++;
	}
    $pdf->Output(strtolower($hasil2['activity_name']).'_match_list.pdf','I');
?>