<?php
include '../koneksi.php';
date_default_timezone_set('Asia/Jakarta');

$nama = $_POST['nama'];
$nip = $_POST['nip'];
$kode = $_POST['kode'];
$posisi = $_POST['posisi'];
$tanggal_lembur = $_POST['tanggal_lembur'];
$jam_mulai = $_POST['jam_mulai'];
$jam_selesai = $_POST['jam_selesai'];
$aktivitas = $_POST['aktivitas'];

if($posisi !== 'Staf - KAM'){
	$query = $conn->prepare("INSERT INTO tb_lembur(nama, nip, kode_outlet, posisi, tanggal, jam_mulai, jam_selesai, aktivitas, approval_unit, approval_cabang, approval_final, created, modified) VALUES('$nama','$nip', '$kode', '$posisi', '$tanggal_lembur', '$jam_mulai', '$jam_selesai', '$aktivitas', 'Tidak perlu approval unit', 'Belum di approve', 'Belum di approve', NOW(), NOW())");
} else {
	$query = $conn->prepare("INSERT INTO tb_lembur(nama, nip, kode_outlet, posisi, tanggal, jam_mulai, jam_selesai, aktivitas, approval_unit, approval_cabang, approval_final, created, modified) VALUES('$nama','$nip', '$kode', '$posisi', '$tanggal_lembur', '$jam_mulai', '$jam_selesai', '$aktivitas', 'Belum di approve', 'Belum di approve', 'Belum di approve', NOW(), NOW())");
}
$query->execute();
if($query) {
	echo json_encode(['message'=>'successfully saved data', 'status'=>'1']);
}else {
	echo json_encode(['message'=>'failed to save data', 'status'=>'0']);
}
?>