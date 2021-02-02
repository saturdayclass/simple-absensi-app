<?php
  include "../koneksi.php";

  $id = $_POST['id_lembur'];
  if($_SESSION['role'] === 'Pimpinan Final'){
    $query = $conn->prepare("UPDATE tb_lembur SET approval_final = 'Tidak di setujui' WHERE id_lembur = '$id' ");
    $query->execute();
    if($query){
    	echo json_encode(['message'=>'successfully reject data', 'status'=>'1']);
    } else {
    	echo json_encode(['message'=>'failed reject data', 'status'=>'0']);
    }
  } else if($_SESSION['role'] === 'Pimpinan Cabang'){
    $query = $conn->prepare("UPDATE tb_lembur SET approval_cabang = 'Tidak di setujui' WHERE id_lembur = '$id' ");
    $query->execute();
    if($query){
    	echo json_encode(['message'=>'successfully reject data', 'status'=>'1']);
    } else {
    	echo json_encode(['message'=>'failed reject data', 'status'=>'0']);
    }
  } else {
    $query = $conn->prepare("UPDATE tb_lembur SET approval_unit = 'Tidak di setujui' WHERE id_lembur = '$id' ");
    $query->execute();
    if($query){
    	echo json_encode(['message'=>'successfully reject data', 'status'=>'1']);
    } else {
    	echo json_encode(['message'=>'failed reject data', 'status'=>'0']);
    }
  }

?>