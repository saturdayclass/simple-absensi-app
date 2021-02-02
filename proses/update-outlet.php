<?php
include '../koneksi.php';
date_default_timezone_set('Asia/Jakarta');

$id = $_POST['id'];
$kode = $_POST['kode'];

$query = $conn->prepare("UPDATE tb_outlet SET kode_outlet = '$kode', modified = NOW() WHERE id_outlet = '$id'");
$query->execute();
if($query) {
	echo json_encode(['message'=>'successfully saved data', 'status'=>'1']);
}else {
	echo json_encode(['message'=>'failed to save data', 'status'=>'0']);
}
?>