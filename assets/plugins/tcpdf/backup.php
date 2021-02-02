<?php
include '../../koneksi.php';
require_once('plugins/tcpdf.php');
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Jafar');
$pdf->SetTitle('Laporan Pengguna');
$pdf->SetSubject('Pengguna');
$pdf->SetKeywords('TCPDF, PDF, pengguna, laporan');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', 'B', 20);

// add a page
$pdf->AddPage();

$pdf->Write(0, 'Laporan Pengguna', '', 0, 'C', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);

// -----------------------------------------------------------------------------


// -----------------------------------------------------------------------------


// -----------------------------------------------------------------------------

// -----------------------------------------------------------------------------

function fetch_data() {
	include '../../koneksi.php';
	$output = '';
	$sql = "SELECT p.no_ktp, p.nama, p.telepon, m.username FROM tb_pengguna p INNER JOIN tb_masuk m ON p.id_pengguna = m.fk_pengguna ORDER BY p.nama ASC";
	$result = mysqli_query($conn, $sql);

    // output data of each row
	while($row = mysqli_fetch_array($result)) {   

		$output .= '<tr style="font-size:12px;">
		<td align="center">'.$row['no_ktp'].'</td>
		<td align="center">'.$row['nama'].'</td>
		<td align="center">'.$row['telepon'].'</td>
		<td align="center">'.$row['username'].'</td>
		</tr>';
	}
	return $output;
}
$content  = '';  
$content .= ' 
<br><br><table border="1">  
<tr style="background-color:#FFFF00;font-size:12px;">
<th align="center"><b>Nomor KTP</b></th>
<th align="center"><b>Nama</b></th>
<th align="center"><b>Telepon</b></th>
<th align="center"><b>Nama Pengguna</b></th>
</tr>';     

$content .= fetch_data(); 
$content .= '
</table>';

// Table with rowspans and THEAD
// $tbl = 
// '<br><br><table border="1">
// <thead>
//  <tr style="background-color:#FFFF00;font-size:12px;">
//   <td align="center"><b>Nomor KTP</b></td>
//   <td align="center"><b>Nama</b></td>
//   <td align="center"><b>Telepon</b></td>
//   <td align="center"><b>Nama Pengguna</b></td>
//  </tr>
// </thead>
// <tbody>
// <tr style="font-size:12px;">
//   <td align="center"><b>Nomor KTP</b></td>
//   <td align="center"><b>Nama</b></td>
//   <td align="center"><b>Telepon</b></td>
//   <td align="center"><b>Nama Pengguna</b></td>
// </tr>
// </tbdoy>
// </table>';

$pdf->writeHTML($content, true, false, false, false, '');

$tbl2 = '<br><br><table border="0px" cellpadding="2" cellspacing="0">
<tr style="text-align:center;" nobr="true">
<td style="width:60%;"></td>
<td style="width:40%;">
Martapura, '.date('d F Y').'<br><br><br><br><u><b>ADMIN</b></u>
</td>
</tr>
</table>';

$pdf->writeHTML($tbl2, true, false, false, false, '');
// -----------------------------------------------------------------------------

// NON-BREAKING TABLE (nobr="true")

//Close and output PDF document
$pdf->Output('example_048.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>