<?php
include '../koneksi.php';
date_default_timezone_set('Asia/Jakarta');

$fk_produk = $_POST['fk_produk'];
$harga = $_POST['harga'];
$jumlah = $_POST['jumlah'];
$stok = $_POST['stok'];
$total_harga = $harga * $jumlah;

if($jumlah > $stok) {
	echo json_encode(['message'=>'failed to save data', 'status'=>'2']);
}else {
	$query = $conn->prepare("INSERT INTO tb_keranjang(fk_produk, harga, jumlah, total_harga, created, modified) VALUES('$fk_produk', '$harga', '$jumlah', '$total_harga', NOW(), NOW())");
	$query->execute();
	if($query) {
		echo json_encode(['message'=>'successfully saved data', 'status'=>'1']);
	}else {
		echo json_encode(['message'=>'failed to save data', 'status'=>'0']);
	}
}
?>