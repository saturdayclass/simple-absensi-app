<?php
include '../koneksi.php';
date_default_timezone_set('Asia/Jakarta');

$nama = $_POST['nama'];
$nip = $_POST['nip'];
$tanggal_lembur = $_POST['tanggal_lembur'];
$jam_mulai = $_POST['jam_mulai'];
$jam_selesai = $_POST['jam_selesai'];
$aktivitas = $_POST['aktivitas'];

$tanda1 = 'Belum di approve';
$tanda2 = 'Belum di approve';
$tanda3 = 'Belum di approve';
if($_FILES['tanda1']['size'] !== 0){
	$tipe = $_FILES['tanda1']['name'];
	$tipe = pathinfo($tipe, PATHINFO_EXTENSION);
	$tanda1 = rand().".".$tipe;
	$lokasi = $_FILES['tanda1']['tmp_name'];
	$folder="../assets/images/approval/";
	move_uploaded_file($lokasi,$folder.$tanda1);
} 

if($_FILES['tanda2']['size'] !== 0){
	$tipe = $_FILES['tanda2']['name'];
	$tipe = pathinfo($tipe, PATHINFO_EXTENSION);
	$tanda2 = rand().".".$tipe;
	$lokasi = $_FILES['tanda2']['tmp_name'];
	$folder="../assets/images/approval/";
	move_uploaded_file($lokasi,$folder.$tanda2);
} 

if($_FILES['tanda3']['size'] !== 0){
	$tipe = $_FILES['tanda3']['name'];
	$tipe = pathinfo($tipe, PATHINFO_EXTENSION);
	$tanda3 = rand().".".$tipe;
	$lokasi = $_FILES['tanda3']['tmp_name'];
	$folder="../assets/images/approval/";
	move_uploaded_file($lokasi,$folder.$tanda3);
} 


$query = $conn->prepare("INSERT INTO tb_lembur(nama, nip, tanggal, jam_mulai, jam_selesai, aktivitas, approval_unit, approval_cabang, approval_final, created, modified) VALUES('$nama', '$nip', '$tanggal_lembur', '$jam_mulai', '$jam_selesai', '$aktivitas', '$tanda1', '$tanda2', '$tanda3', NOW(), NOW())");
$query->execute();
if($query) {
	echo json_encode(['message'=>'successfully saved data', 'status'=>'1']);
}else {
	echo json_encode(['message'=>'failed to save data', 'status'=>'0']);
}
?>