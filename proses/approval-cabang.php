<?php
include "../koneksi.php";
$id = $_POST['id'];

$tipe = $_FILES['approval_cabang']['name'];
$tipe = pathinfo($tipe, PATHINFO_EXTENSION);
$approval_cabang = rand().".".$tipe;
$lokasi = $_FILES['approval_cabang']['tmp_name'];
$folder="../assets/images/approval/";
move_uploaded_file($lokasi,$folder.$approval_cabang);

$query = $conn->prepare("UPDATE tb_lembur SET approval_cabang = '$approval_cabang' WHERE id_lembur = '$id' ");
$query->execute();
if($query) {
	echo json_encode(['message'=>'successfully saved data', 'status'=>'1']);
}else {
	echo json_encode(['message'=>'failed to save data', 'status'=>'0']);
}

?>