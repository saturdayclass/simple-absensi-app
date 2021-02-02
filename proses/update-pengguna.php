<?php
include '../koneksi.php';
date_default_timezone_set('Asia/Jakarta');

$id = $_POST['id'];
$nama = $_POST['nama'];
$nip = $_POST['nip'];
$kode_outlet = $_POST['kode'];
$posisi = $_POST['posisi'];
$unit_kerja = $_POST['unit_kerja'];
$username = $_POST['username'];
$password = $_POST['password'];
$level = $_POST['level'];

$query = $conn->prepare("UPDATE tb_user SET nama = '$nama', nip = '$nip', kode_outlet = '$kode_outlet', posisi = '$posisi', unit_kerja = '$unit_kerja', role = '$level', username = '$username', password = '$password', modified = NOW() WHERE id_user = '$id'");
$query->execute();
if($query) {
	echo json_encode(['message'=>'successfully saved data', 'status'=>'1']);
}else {
	echo json_encode(['message'=>'failed to save data', 'status'=>'0']);
}
?>