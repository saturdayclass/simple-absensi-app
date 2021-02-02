<?php
include '../koneksi.php';
date_default_timezone_set('Asia/Jakarta');

$kode = $_POST['kode'];

$query = $conn->prepare("INSERT INTO tb_outlet(kode_outlet, created, modified) VALUES('$kode', NOW(), NOW())");
$query->execute();
if($query) {
	echo json_encode(['message'=>'successfully saved data', 'status'=>'1']);
}else {
	echo json_encode(['message'=>'failed to save data', 'status'=>'0']);
}
?>