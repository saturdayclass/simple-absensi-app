<?php
include '../koneksi.php';

$username = trim($_POST['username']);
$password = trim($_POST['password']);

if($username !== '' && $password !== ''){
	try {
		$query = "SELECT * from `tb_user` where `username`=:username and `password`=:password";
		$stmt = $conn->prepare($query);
		$stmt->bindParam('username', $username, PDO::PARAM_STR);
		$stmt->bindValue('password', $password, PDO::PARAM_STR);
		$stmt->execute();
		$cek = $stmt->rowCount();
		
		if($cek > 0) {
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$_SESSION['username'] = $row['username'];
			$_SESSION['role'] = $row['role'];
			$_SESSION['nama'] = $row['nama'];
			$_SESSION['kode_outlet'] = $row['kode_outlet'];
			$_SESSION['posisi'] = $row['posisi'];
			echo json_encode(['message'=>'successfully logged in as admin', 'status'=>'1', 'username'=>$row['username']]);
		}else {
			echo json_encode(['message'=>'login failed, account not found', 'status'=>'0']);
		}
	} catch (PDOException $e) {
    echo "Error : ".$e->getMessage();
  }

}
?>