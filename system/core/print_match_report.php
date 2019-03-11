<?php
	require('../../vendor/fpdf/fpdf.php');
    include('connection.php');
    include('../function.php');
    include('../session/admin_page_session.php');
    $id_match=$_GET['id_match'];
    $querrymatch="SELECT id_match, activity_futsal_detail.id_activity_futsal_detail, activity.id_activity, activity.activity_name, activity.activity_location, Home, Away, id_referee_1, id_referee_2, match_time, DAY(match_time), MONTH(match_time), YEAR(match_time) FROM futsal_match INNER JOIN activity_futsal_detail ON activity_futsal_detail.id_activity_futsal_detail=futsal_match.id_activity_futsal_detail INNER JOIN activity ON activity.id_activity=activity_futsal_detail.id_activity WHERE id_match='$id_match'";
	$matchdata=mysqli_query($mysqli, $querrymatch) or die(mysqli_error);
	$hasil2 = mysqli_fetch_array($matchdata);
	$home=$hasil2['Home'];
	$away=$hasil2['Away'];
    $date=date('d');
    $m=date('m');
	$year=date('Y');
	$homeimg="../../img/team_logo/".cekteamimg($mysqli, $hasil2['Home']).".png";
	$awayimg="../../img/team_logo/".cekteamimg($mysqli, $hasil2['Away']).".png";
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
	}
	$pdf = new PDF('P','cm','Legal');
	$pdf->AddPage();
	$pdf->Image($homeimg,13.75,5,2);
	$pdf->Image($awayimg,18,5,2);
    $pdf->SetFont('Times','B',14);
    $pdf->Cell(0,0,strtoupper($hasil2['activity_name']),0,0,'C');
	$pdf->Ln(0.5);
	$pdf->SetFont('Times','B',12);
    $pdf->Cell(0,0,'MATCH REPORT',0,0,'C');
	$pdf->Ln(0.5);
    $pdf->SetFont('Times','I',10);
    $pdf->Cell(0.5,0,'',0,0,'L');
    $pdf->Cell(1,0,'Date',0,0,'L');
    $pdf->Cell(0.5,0,'',0,0,'L');
    $pdf->Cell(3,0,':'.$date.' '.$month[(int)$m].' '.$year,0,0,'L');
    $pdf->Ln(0.5);
    $pdf->Cell(0.5,0,'',0,0,'L');
	$pdf->Cell(1,0,'Location',0,0,'L');
	$pdf->Cell(0.5,0,'',0,0,'L');
	$pdf->Cell(2,0,':'.$hasil2['activity_location'],0,0,'L');
	$pdf->Ln(0.5);
	$pdf->Cell(0.5,0,'',0,0,'L');
	$pdf->Cell(1,0,'Referee 1',0,0,'L');
	$pdf->Cell(0.5,0,'',0,0,'L');
	$pdf->Cell(2,0,':'.cekreferee($mysqli, $hasil2['id_referee_1']),0,0,'L');
	$pdf->Cell(8,0,'',0,0,'L');
	$pdf->SetFont('Times','I',24);
	$pdf->Cell(0,0,cekscore($mysqli, $home, $id_match).' - '.cekscore($mysqli, $away, $id_match),0,0,'C');
	$pdf->Ln(0.5);
	$pdf->SetFont('Times','I',10);
	$pdf->Cell(0.5,0,'',0,0,'L');
	$pdf->Cell(1,0,'Referee 2',0,0,'L');
	$pdf->Cell(0.5,0,'',0,0,'L');
	$pdf->Cell(2,0,':'.cekreferee($mysqli, $hasil2['id_referee_2']),0,0,'L');
	$pdf->Ln(1);
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(0,0,cekteam($mysqli,$home),0,0,'C');
	$pdf->Ln(0.5);
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(3.25,0,'',0,0,'C');
	$pdf->Cell(1,1,'No.',1,0,'C');
	$pdf->Cell(1.5,1,'Number',1,0,'C');
	$pdf->Cell(5,1,'Name',1,0,'C');
	$pdf->Cell(1.5,1,'Goal',1,0,'C');
	$pdf->Cell(1.5,1,'Assist',1,0,'C');
	$pdf->Cell(2.5,0.5,'Card',1,0,'C');
	$pdf->Ln();
	$pdf->Cell(13.75,0.5,'',0,0,'C');
	$pdf->Cell(1.25,0.5,'Yellow',1,0,'C');
	$pdf->Cell(1.25,0.5,'Red',1,0,'C');
	$pdf->Ln();
	$pdf->SetFont('Times','',10);
	$a=1;
	$yellow=0;
	$red=0;
	$homeplayer="SELECT * FROM futsal_player WHERE id_team='$home' ORDER BY player_number ASC";
    $playerhome=mysqli_query($mysqli, $homeplayer) or die(mysqli_error);
	while($playerdata1 = mysqli_fetch_array($playerhome)){
		$id=$playerdata1['id_player'];
		$pdf->Cell(3.25,0,'',0,0,'C');
		$pdf->Cell(1,0.5,$a,1,0,'C');
		$pdf->Cell(1.5,0.5,$playerdata1['player_number'],1,0,'C');
		$pdf->Cell(5,0.5,$playerdata1['player_name'],1,0,'C');
		$pdf->Cell(1.5,0.5,cekgoal($mysqli, $id_match, $id),1,0,'C');
		$pdf->Cell(1.5,0.5,cekassist($mysqli, $id_match, $id),1,0,'C');
		$pdf->Cell(1.25,0.5,cekyellow($mysqli,$id_match,$id),1,0,'C');
		$pdf->Cell(1.25,0.5,cekred($mysqli,$id_match,$id),1,0,'C');
		$pdf->Ln();
		$yellow=$yellow+cekyellow($mysqli,$id_match,$id);
		$red=$red+cekred($mysqli,$id_match,$id);
		$a++;
	}
	$pdf->Cell(12.25,0.5,'',0,0,'C');
	$pdf->Cell(1.5,0.5,'Total',1,0,'C');
	$pdf->Cell(1.25,0.5,$yellow,1,0,'C');
	$pdf->Cell(1.25,0.5,$red,1,0,'C');
	$pdf->Ln(1);
	
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(0,0,cekteam($mysqli,$away),0,0,'C');
	$pdf->Ln(0.5);
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(3.25,0,'',0,0,'C');
	$pdf->Cell(1,1,'No.',1,0,'C');
	$pdf->Cell(1.5,1,'Number',1,0,'C');
	$pdf->Cell(5,1,'Name',1,0,'C');
	$pdf->Cell(1.5,1,'Goal',1,0,'C');
	$pdf->Cell(1.5,1,'Assist',1,0,'C');
	$pdf->Cell(2.5,0.5,'Card',1,0,'C');
	$pdf->Ln();
	$pdf->Cell(13.75,0.5,'',0,0,'C');
	$pdf->Cell(1.25,0.5,'Yellow',1,0,'C');
	$pdf->Cell(1.25,0.5,'Red',1,0,'C');
	$pdf->Ln();
	$pdf->SetFont('Times','',10);
	$a=1;
	$yellow=0;
	$red=0;
	$awayplayer="SELECT * FROM futsal_player WHERE id_team='$away' ORDER BY player_number ASC";
    $playeraway=mysqli_query($mysqli, $awayplayer) or die(mysqli_error);
	while($playerdata2 = mysqli_fetch_array($playeraway)){
		$id=$playerdata2['id_player'];
		$pdf->Cell(3.25,0,'',0,0,'C');
		$pdf->Cell(1,0.5,$a,1,0,'C');
		$pdf->Cell(1.5,0.5,$playerdata2['player_number'],1,0,'C');
		$pdf->Cell(5,0.5,$playerdata2['player_name'],1,0,'C');
		$pdf->Cell(1.5,0.5,cekgoal($mysqli, $id_match, $id),1,0,'C');
		$pdf->Cell(1.5,0.5,cekassist($mysqli, $id_match, $id),1,0,'C');
		$pdf->Cell(1.25,0.5,cekyellow($mysqli,$id_match,$id),1,0,'C');
		$pdf->Cell(1.25,0.5,cekred($mysqli,$id_match,$id),1,0,'C');
		$pdf->Ln();
		$yellow=$yellow+cekyellow($mysqli,$id_match,$id);
		$red=$red+cekred($mysqli,$id_match,$id);
		$a++;
	}
	$pdf->Cell(12.25,0.5,'',0,0,'C');
	$pdf->Cell(1.5,0.5,'Total',1,0,'C');
	$pdf->Cell(1.25,0.5,$yellow,1,0,'C');
	$pdf->Cell(1.25,0.5,$red,1,0,'C');
    $querypk="SELECT * FROM match_drawpk WHERE id_match='$id_match'";
    $pkdraw=mysqli_query($mysqli, $querypk) or die(mysqli_error);
    $pkdata=mysqli_fetch_array($pkdraw);
    $extra=false;
    if($pkdata['h4']!=0 || $pkdata['a4']!=0){
      $extra=true;
    }
	$pdf->Ln(1);
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(0,0,'PK-DRAW',0,0,'C');
	$pdf->SetFont('Times','B',10);
    $pdf->Ln(0.5);
    
	$pdf->Cell(6,1,'',0,0,'C');
	$pdf->Cell(3.25,0.5,cekteam($mysqli,$home),1,0,'C');
    $pdf->Cell(1,0.5,cekpk($pkdata['h1']),1,0,'C');
    $pdf->Cell(1,0.5,cekpk($pkdata['h2']),1,0,'C');
    $pdf->Cell(1,0.5,cekpk($pkdata['h3']),1,0,'C');
    if($extra==true){
        $pdf->Cell(1,0.5,cekpk($pkdata['h4']),1,0,'C');
    }
    $pdf->Ln();
    
	$pdf->Cell(6,1,'',0,0,'C');
	$pdf->Cell(3.25,0.5,cekteam($mysqli,$away),1,0,'C');
    $pdf->Cell(1,0.5,cekpk($pkdata['a1']),1,0,'C');
    $pdf->Cell(1,0.5,cekpk($pkdata['a2']),1,0,'C');
    $pdf->Cell(1,0.5,cekpk($pkdata['a3']),1,0,'C');
    if($extra==true){
        $pdf->Cell(1,0.5,cekpk($pkdata['a4']),1,0,'C');
    }
	$pdf->Ln(2);
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(2,0.5,'',0,0,'C');
	$pdf->Cell(5,0.5,cekteam($mysqli,$home),0,0,'C');
	$pdf->Cell(5,0.5,cekteam($mysqli,$away),0,0,'C');
	$pdf->Cell(5,0.5,'REFEREE',0,0,'C');
	$pdf->Ln(2);
	$pdf->SetFont('Times','IU',12);
	$pdf->Cell(2,0.5,'',0,0,'C');
	$pdf->Cell(5,0.5,cekmanager($mysqli,$home),0,0,'C');
	$pdf->Cell(5,0.5,cekmanager($mysqli,$away),0,0,'C');
	$pdf->Cell(5,0.5,cekreferee($mysqli, $hasil2['id_referee_1']),0,0,'C');
	$pdf->Ln(0.4);
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(2,0.5,'',0,0,'C');
	$pdf->Cell(5,0.5,'Manager',0,0,'C');
	$pdf->Cell(5,0.5,'Manager',0,0,'C');
	$pdf->Cell(5,0.5,'Referee 1',0,0,'C');
    $pdf->Output(strtolower($hasil2['activity_name']).'_'.cekteam($mysqli, $hasil2['Home']).'_vs_'.cekteam($mysqli, $hasil2['Away']).'_match_report.pdf','I');
?>