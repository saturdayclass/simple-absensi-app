<?php
include '../koneksi.php';
date_default_timezone_set('Asia/Jakarta');

$id = $_POST['id'];

$queryImage = $conn->prepare("SELECT * FROM tb_lembur WHERE id_lembur = '$id'");
$queryImage->execute();
$row = $queryImage->fetch(PDO::FETCH_ASSOC);

$nama = $_POST['nama'];
$tanggal_lembur = $_POST['tanggal_lembur'];
$jam_mulai = $_POST['jam_mulai'];
$jam_selesai = $_POST['jam_selesai'];
$aktivitas = $_POST['aktivitas'];
$tanda1_form = $row['approval_unit'];
$tanda2_form = $row['approval_cabang'];
$tanda3_form = $row['approval_final'];

$tipe1 = $_FILES['tanda1']['name'];
$tipe1 = pathinfo($tipe1, PATHINFO_EXTENSION);
$tanda1 = rand().".".$tipe1;
$lokasi = $_FILES['tanda1']['tmp_name'];
$folder="../assets/images/approval/";
move_uploaded_file($lokasi,$folder.$tanda1);

$tipe2 = $_FILES['tanda2']['name'];
$tipe2 = pathinfo($tipe2, PATHINFO_EXTENSION);
$tanda2 = rand().".".$tipe2;
$lokasi = $_FILES['tanda2']['tmp_name'];
$folder="../assets/images/approval/";
move_uploaded_file($lokasi,$folder.$tanda2);

$tipe3 = $_FILES['tanda3']['name'];
$tipe3 = pathinfo($tipe3, PATHINFO_EXTENSION);
$tanda3 = rand().".".$tipe3;
$lokasi = $_FILES['tanda3']['tmp_name'];
$folder="../assets/images/approval/";
move_uploaded_file($lokasi,$folder.$tanda3);

if($tipe1 === '' && $tipe2 === '' && $tipe3 === ''){
	$query = $conn->prepare("UPDATE tb_lembur SET nama = '$nama', tanggal = '$tanggal_lembur', jam_mulai = '$jam_mulai', jam_selesai = '$jam_selesai', aktivitas = '$aktivitas', approval_unit = '$tanda1_form', approval_cabang = '$tanda2_form', approval_final = '$tanda3_form', modified = NOW() WHERE id_lembur = '$id'");
} else if ($tipe1 === '' && $tipe2 === ''){
	if($tanda1_form === '' && $tanda2_form === ''){
		$query = $conn->prepare("UPDATE tb_lembur SET nama = '$nama', tanggal = '$tanggal_lembur', jam_mulai = '$jam_mulai', jam_selesai = '$jam_selesai', aktivitas = '$aktivitas', approval_final = '$tanda3', modified = NOW() WHERE id_lembur = '$id'");
		unlink($folder.$tanda3_form);
	} else {
		$query = $conn->prepare("UPDATE tb_lembur SET nama = '$nama', tanggal = '$tanggal_lembur', jam_mulai = '$jam_mulai', jam_selesai = '$jam_selesai', aktivitas = '$aktivitas', approval_unit = '$tanda1_form', approval_cabang = '$tanda2_form', approval_final = '$tanda3', modified = NOW() WHERE id_lembur = '$id'");
		unlink($folder.$tanda3_form);
	}
} else if ($tipe1 === '' && $tipe3 === ''){
	if($tanda1_form === '' && $tanda3_form === ''){
		$query = $conn->prepare("UPDATE tb_lembur SET nama = '$nama', tanggal = '$tanggal_lembur', jam_mulai = '$jam_mulai', jam_selesai = '$jam_selesai', aktivitas = '$aktivitas', approval_cabang = '$tanda2', modified = NOW() WHERE id_lembur = '$id'");
		unlink($folder.$tanda2_form);
	} else {
		$query = $conn->prepare("UPDATE tb_lembur SET nama = '$nama', tanggal = '$tanggal_lembur', jam_mulai = '$jam_mulai', jam_selesai = '$jam_selesai', aktivitas = '$aktivitas', approval_unit = '$tanda1_form', approval_cabang = '$tanda2', approval_final = '$tanda3_form', modified = NOW() WHERE id_lembur = '$id'");
		unlink($folder.$tanda2_form);
	}
} else if ($tipe2 === '' && $tipe3 === ''){
	if($tanda2_form === '' && $tanda3_form === ''){
		$query = $conn->prepare("UPDATE tb_lembur SET nama = '$nama', tanggal = '$tanggal_lembur', jam_mulai = '$jam_mulai', jam_selesai = '$jam_selesai', aktivitas = '$aktivitas', approval_unit = '$tanda1', modified = NOW() WHERE id_lembur = '$id'");
		unlink($folder.$tanda1_form);
	} else {
		$query = $conn->prepare("UPDATE tb_lembur SET nama = '$nama', tanggal = '$tanggal_lembur', jam_mulai = '$jam_mulai', jam_selesai = '$jam_selesai', aktivitas = '$aktivitas', approval_unit = '$tanda1', approval_cabang = '$tanda2_form', approval_final = '$tanda3_form', modified = NOW() WHERE id_lembur = '$id'");
		unlink($folder.$tanda1_form);
	}
} else {
	$query = $conn->prepare("UPDATE tb_lembur SET nama = '$nama', tanggal = '$tanggal_lembur', jam_mulai = '$jam_mulai', jam_selesai = '$jam_selesai', aktivitas = '$aktivitas', approval_unit = '$tanda1', approval_cabang = '$tanda2', approval_final = '$tanda3', modified = NOW() WHERE id_lembur = '$id'");
}
$query->execute();
if($query) {
	echo json_encode(['message'=> 'successfully updated data', 'tipe' => $tanda1_form, 'tipe2' => $tanda2_form, 'status'=>'1']);
}else {
	echo json_encode(['message'=>'failed to save data', 'status'=>'0']);
}
?>