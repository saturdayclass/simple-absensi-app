<?php
include '../koneksi.php';
date_default_timezone_set('Asia/Jakarta');

$nama = $_POST['nama'];

$query = $conn->prepare("INSERT INTO tb_posisi(nama_posisi, created, modified) VALUES('$nama', NOW(), NOW())");
$query->execute();
if($query) {
	echo json_encode(['message'=>'successfully saved data', 'status'=>'1']);
}else {
	echo json_encode(['message'=>'failed to save data', 'status'=>'0']);
}
?>