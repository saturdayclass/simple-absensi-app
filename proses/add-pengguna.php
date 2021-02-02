<?php
include '../koneksi.php';
date_default_timezone_set('Asia/Jakarta');

$nama = $_POST['nama'];
$nip = $_POST['nip'];
$kode_outlet = $_POST['kode'];
$posisi = $_POST['posisi'];
$unit_kerja = $_POST['unit_kerja'];
$username = $_POST['username'];
$password = $_POST['password'];
$level = $_POST['level'];

$query = $conn->prepare("INSERT INTO tb_user(nama, nip, kode_outlet, posisi, unit_kerja, username, password, role, created, modified) VALUES('$nama', '$nip', '$kode_outlet', '$posisi', '$unit_kerja', '$username', '$password', '$level', NOW(), NOW())");
$query->execute();
if($query) {
	echo json_encode(['message'=>'successfully saved data', 'status'=>'1']);
}else {
	echo json_encode(['message'=>'failed to save data', 'status'=>'0']);
}
?>