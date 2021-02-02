<?php
include '../koneksi.php';
date_default_timezone_set('Asia/Jakarta');

$id = $_POST['id'];
$nama  = $_POST['nama'];
$telepon = $_POST['telepon'];
$alamat = $_POST['alamat'];

$query = $conn->prepare("UPDATE tb_pengguna SET nama = '$nama', telepon = '$telepon', alamat = '$alamat', modified = NOW() WHERE id_pengguna = '$id'");
$query->execute();
if($query) {
	echo json_encode(['message'=>'successfully saved data', 'status'=>'1']);
}else {
	echo json_encode(['message'=>'failed to save data', 'status'=>'0']);
}
?>