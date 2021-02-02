<?php
include '../koneksi.php';
$id = $_POST['id'];
$query = $conn->prepare("DELETE FROM tb_lembur WHERE id_lembur = '$id'");
$query->execute();
if($query) {
	echo json_encode(['message'=>'successfully deleted data', 'status'=>'1']);
}else {
	echo json_encode(['message'=>'failed to delete data', 'status'=>'0']);
}
?>