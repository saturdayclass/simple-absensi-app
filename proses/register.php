<?php
include '../koneksi.php';
date_default_timezone_set('Asia/Jakarta');

$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$telepon = $_POST['telepon'];
$alamat = $_POST['alamat'];
$level = "Pembeli";

$query = $conn->prepare("INSERT INTO tb_pengguna(nama, username, password, telepon, alamat, level, created, modified) VALUES('$nama', '$username', '$password', '$telepon', '$alamat', '$level', NOW(), NOW())");
$query->execute();
if($query) {
	echo json_encode(['message'=>'successfully saved data', 'status'=>'1']);
}else {
	echo json_encode(['message'=>'failed to save data', 'status'=>'0']);
}
?>