<?php
date_default_timezone_set('Asia/Jakarta');
require_once('assets/plugins/tcpdf/tcpdf.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Otis');
$pdf->SetTitle('Form Lembur');
$pdf->SetSubject('Produ');
$pdf->SetKeywords('TCPDF, PDF, Form Lembur, laporan');
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

include 'koneksi.php';
$output = '';
$id = $_GET['id'];
$sql = "SELECT * FROM tb_lembur WHERE id_lembur = '$id' ORDER BY nama ASC";
$result = $conn->prepare($sql);
$result->execute();
$imageUnit = '';
$imageCabang = '';
$imageFinal = '';
$cekStaf = '';
$poisiImageCabang = 10;
$poisiImageFinal = 150;
$widthTanda = '80%';

while($row = $result->fetch(PDO::FETCH_ASSOC)) {   
	if($row['posisi'] === 'Staf - KAM'){
		$cekStaf = '
		<td style="width:33%;">
			<br><br><br><br><br><br><br><br><br><b>Approval Level 1</b>
		</td>';
		$poisiImageCabang = 70;
		$widthTanda = '33%';
		$poisiImageFinal = 130;
	}
	$imageUnit = $row['approval_unit'];
	$imageCabang = $row['approval_cabang'];
	$imageFinal = $row['approval_final'];
}

$kepada = '';
$dari = '';

if($_SESSION['role'] === 'Pimpinan Unit'){
	$dari = $_SESSION['nama'].' (Pimpinan Unit)';
}
if($_SESSION['role'] === 'Pimpinan Cabang'){
	$dari = $_SESSION['nama'].' (Pimpinan Cabang)';
}

$pdf->SetFont('helvetica', 'B', 20);
$pdf->AddPage();
$pdf->Image('assets/images/approval/'.$imageUnit, 15,116,40,25);
$pdf->Image('assets/images/approval/'.$imageCabang, $poisiImageCabang,116,40,25);
$pdf->Image('assets/images/approval/'.$imageFinal, $poisiImageFinal,116,40,25);
$pdf->Image('assets/images/logo-pnm.png',75,5,60,25);
$pdf->SetY(40);
$pdf->Write(0, 'Form Lembur', '', 0, 'C', true, 0, false, false, 0);
$pdf->SetFont('helvetica', '', 15);
$pdf->SetFont('helvetica', '', 10);

function fetch_data() {
	include 'koneksi.php';
	$output = '';
	$id= $_GET['id'];
	$sql = "SELECT * FROM tb_lembur WHERE id_lembur = '$id' ORDER BY nama ASC";
	$result = $conn->prepare($sql);
	$result->execute();
	while($row = $result->fetch(PDO::FETCH_ASSOC)) {   
		$output .= '<tr style="font-size:12px;">
		<td align="center">'.$row['nama'].'</td>
		<td align="center">'.$row['tanggal'].'</td>
		<td align="center">'.$row['jam_mulai'].'</td>
		<td align="center">'.$row['jam_selesai'].'</td>
		<td align="center">'.$row['aktivitas'].'</td>
		</tr>';
	}
	return $output;
}

if($_SESSION['role'] !== 'admin'){
	$content  = '<table>
	<tr>
		<td width="7%">Kepada</td>
		<td align="center" width="2%">:</td>
		<td align="left" style="width: 57%;"><b>Urusan SDM</b></td>
		<td align="right">Tanggal</td>
		<td align="center" style="width: 2%">:</td>
		<td align="left" style="width: 15%">'.date('d F Y').'</td>
	</tr>
	<br/>
	<tr>
		<td>Dari</td>
		<td align="center">:</td>
		<td>'.$dari.'</td>
	</tr>
	<br/>
	<br/>
	<tr>
		<td style="width: 100%">Sehubungan dengan adanya tugas-tuags yang harus diselesaikan dengan segera, maka kami menugaskan</td>
	</tr>
	<tr>
		<td style="width: 8%; font-weight: bold;">Kepada</td>
		<td>:</td>
	</tr>
</table>'; 
} else {
	$content  = '<table>
	<tr>
		<td width="7%"></td>
		<td align="center" width="2%"></td>
		<td align="left" style="width: 57%;"></td>
		<td align="right">Tanggal</td>
		<td align="center" style="width: 2%">:</td>
		<td align="left" style="width: 15%">'.date('d F Y').'</td>
	</tr>
	<br/>
	<br/>
	<br/>
	<br/>
	<tr>
		<td style="width: 100%">Sehubungan dengan adanya tugas-tuags yang harus diselesaikan dengan segera, maka kami menugaskan</td>
	</tr>
	<tr>
		<td style="width: 8%; font-weight: bold;">Kepada</td>
		<td>:</td>
	</tr>
</table>'; 
}

 
$content .= ' 
<br><br><table border="1">  
<tr style="background-color:#FFFF00;font-size:12px;">
<th align="center"><b>Nama</b></th>
<th align="center"><b>Tanggal</b></th>
<th align="center"><b>Jam Mulai</b></th>
<th align="center"><b>Jam Selesai</b></th>
<th align="center"><b>Aktivitas</b></th>
</tr>';     
$content .= fetch_data(); 
$content .= '
</table>
<p>Demikian disampaikan atas perhatiannya diucapkan terimakasih</p>
';

$pdf->writeHTML($content, true, false, false, false, '');

$tbl2 = '<br><br><table border="0px" cellpadding="2" cellspacing="0">
<tr nobr="true">
'.$cekStaf.'
<td style="width:'.$widthTanda.';">
<br><br><br><br><br><br><br><br><br><b>Approval Level 2</b>
</td>
<td style="width:'.$widthTanda.';">
<br><br><br><br><br><br><br><br><br><b>Pimpinan Final</b>
</td>
</tr>
</table>';

$pdf->writeHTML($tbl2, true, false, false, false, '');
ob_end_clean();
$pdf->Output('form_lembur-'.$_SESSION['username'].'.pdf', 'I');
?>