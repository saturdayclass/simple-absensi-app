<?php
include '../koneksi.php';
date_default_timezone_set('Asia/Jakarta');

$id = $_POST['id'];
$nama = $_POST['nama'];

$query = $conn->prepare("UPDATE tb_cabang SET nama_cabang = '$nama', modified = NOW() WHERE id_cabang = '$id'");
$query->execute();
if($query) {
	echo json_encode(['message'=>'successfully saved data', 'status'=>'1']);
}else {
	echo json_encode(['message'=>'failed to save data', 'status'=>'0']);
}
?>