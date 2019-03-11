<?php
	require('../../vendor/fpdf/fpdf.php');
    include('connection.php');
    include('../function.php');
	include('../session/admin_page_session.php');
    $id_activity = $_GET['id_activity'];
    $querryparticipant="SELECT id_participant, account.id_account, account.account_name, account.account_contact_number, activity.id_activity, activity.activity_name, DAY(activity.activity_date), MONTH(activity.activity_date), YEAR(activity.activity_date), activity.activity_location, participant_payment_status, DAY(participant_registration_date), MONTH(participant_registration_date), YEAR(participant_registration_date) FROM participant
    INNER JOIN activity ON activity.id_activity=participant.id_activity
    INNER JOIN account ON account.id_account=participant.id_account WHERE activity.id_activity = '$id_activity' ORDER by participant_registration_date ASC";
	$participantlist=mysqli_query($mysqli, $querryparticipant) or die(mysqli_error);
	$activitydata=mysqli_query($mysqli, $querryparticipant) or die(mysqli_error);
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
    $pdf->Cell(0,0,'PARTICIPANT LIST',0,0,'C');
	$pdf->Ln(0.5);
	$pdf->SetFont('Times','I',10);
    $pdf->Cell(0.5,0,'',0,0,'L');
    $pdf->Cell(1,0,'Date',0,0,'L');
    $pdf->Cell(0.5,0,'',0,0,'L');
    $pdf->Cell(3,0,':'.$hasil2['DAY(activity.activity_date)'].' '.$month[$hasil2['MONTH(activity.activity_date)']].' '.$hasil2['YEAR(activity.activity_date)'],0,0,'L');
    $pdf->Ln(0.5);
    $pdf->Cell(0.5,0,'',0,0,'L');
	$pdf->Cell(1,0,'Location',0,0,'L');
	$pdf->Cell(0.5,0,'',0,0,'L');
	$pdf->Cell(2,0,':'.$hasil2['activity_location'],0,0,'L');
    $pdf->Ln(0.5);
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(0.5,0,'',0,0,'C');
	$pdf->Cell(1,0.5,'No.',1,0,'C');
	$pdf->Cell(7,0.5,'Name',1,0,'C');
	$pdf->Cell(5,0.5,'Contact Number',1,0,'C');
	$pdf->Cell(2,0.5,'Payment',1,0,'C');
	$pdf->Cell(3,0.5,'Registration Date',1,0,'C');
	$pdf->Ln();
	$pdf->SetFont('Times','',10);
	$a=1;
	while($hasil = mysqli_fetch_array($participantlist))
	{
	$pdf->Cell(0.5,0,'',0,0,'C');
	$pdf->Cell(1,0.5,$a,1,0,'C');
	$pdf->Cell(7,0.5,$hasil['account_name'],1,0,'C');
	$pdf->Cell(5,0.5,$hasil['account_contact_number'],1,0,'C');
	if ($hasil['participant_payment_status'] == 1) {
		$status="Complete";
	}else{$status="Not Yet";}
	$pdf->Cell(2,0.5,$status,1,0,'C');
	$pdf->Cell(3,0.5,$hasil['DAY(participant_registration_date)'].' '.$month[$hasil['MONTH(participant_registration_date)']].' '.$hasil['YEAR(participant_registration_date)'],1,0,'C');
	$pdf->Ln();
	$a++;
	}
    $pdf->Output(strtolower($hasil2['activity_name']).'_participant_list.pdf','I');
?>