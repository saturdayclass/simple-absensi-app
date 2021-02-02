<?php include 'koneksi.php'; ?>
<?php 
	if($_SESSION['role'] === 'Super Admin'){
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'menu/head.php'; ?>
</head>
<body>
	<div id="app">
		<div class="main-wrapper">
			<div class="navbar-bg"></div>
			<nav class="navbar navbar-expand-lg main-navbar">
				<?php include 'menu/nav.php'; ?>
			</nav>
			<div class="main-sidebar">
				<aside id="sidebar-wrapper">
					<?php include 'menu/aside.php'; ?>
				</aside>
			</div>
			<div class="main-content">
				<section class="section">
					<div class="section-header">
						<h1>Tambah Pengguna</h1>
						<div class="section-header-breadcrumb">
							<div class="breadcrumb-item active"><a href="beranda">Beranda</a></div>
							<div class="breadcrumb-item"><a href="pengguna">Pengguna</a></div>
							<div class="breadcrumb-item">Tambah Pengguna</div>
						</div>
					</div>
					<div class="section-body">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-body">
										<form role="form" action="#" method="POST" enctype="multipart/form-data" id="data-form">
											<div class="row">
												<div class="col-md-4">
													<div class="form-group">
														<label for="nama">Nama Lengkap</label>
														<input type="text" class="form-control" name="nama" id="nama" required="" autocomplete="off" placeholder="Masukkan Nama Lengkap" maxlength="100" autofocus="">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="nip">Nip</label>
														<input type="text" class="form-control" name="nip" id="nip" required="" autocomplete="off" placeholder="Masukkan Nip" maxlength="100" autofocus="">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="kode">Kode Outlet</label>
														<select class="form-control select2" name="kode" id="kode" required="">
															<option value="">Pilih Kode Outlet</option>
															<?php
																$kode = $conn->prepare("SELECT kode_outlet FROM tb_outlet");
																$kode->execute();
																while($data = $kode->fetch(PDO::FETCH_ASSOC)){
															?>
																<option value="<?= $data['kode_outlet'] ?>"><?= $data['kode_outlet'] ?></option>
															<?php } ?>
														</select>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="posisi">Posisi</label>
														<select class="form-control select2" name="posisi" id="posisi" required="">
															<option value="">Pilih Posisi</option>
															<?php
																$posisi = $conn->prepare("SELECT nama_posisi FROM tb_posisi");
																$posisi->execute();
																while($data = $posisi->fetch(PDO::FETCH_ASSOC)){
															?>
																<option value="<?= $data['nama_posisi'] ?>"><?= $data['nama_posisi'] ?></option>
															<?php } ?>
														</select>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="unit_kerja">Unit Kerja</label>
														<select class="form-control select2" name="unit_kerja" id="unit_kerja" required="">
															<option value="">Pilih Unit Kerja</option>
															<?php
																$posisi = $conn->prepare("SELECT nama_cabang FROM tb_cabang");
																$posisi->execute();
																while($data = $posisi->fetch(PDO::FETCH_ASSOC)){
															?>
																<option value="<?= $data['nama_cabang'] ?>"><?= $data['nama_cabang'] ?></option>
															<?php } ?>
														</select>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="username">Nama Pengguna</label>
														<input type="text" class="form-control" name="username" id="username" required="" autocomplete="off" placeholder="Masukkan Nama Pengguna (username)" minlength="2" maxlength="20" autofocus="">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="password">Kata Sandi</label>
														<input type="password" class="form-control" name="password" id="password" required="" autocomplete="off" placeholder="Masukkan Kata Sandi" minlength="5" maxlength="20" autofocus="">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="level">Role</label>
														<select class="form-control select2" name="level" id="level" required="">
															<option value="">Pilih Level</option>
															<option value="Staf/Non Staf">STAF/NON STAF</option>
															<option value="Pimpinan Unit">Pimpinan Unit</option>
															<option value="Pimpinan Cabang">Pimpinan Cabang</option>
															<option value="Pimpinan Final">Pimpinan Final</option>
															<option value="admin">Administrator</option>
															<option value="Super Admin">Super Administrator</option>
														</select>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<a href="pengguna" class="btn btn-danger">Kembali</a>
													<button type="submit" class="btn btn-primary float-right">Simpan</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
			<footer class="main-footer">
				<?php include 'menu/footer.php'; ?>
			</footer>
		</div>
	</div>
	<?php include 'menu/script.php'; ?>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#data-form").submit(function(e) {
				e.preventDefault();
				var data = new FormData(this);
				$.ajax({
					type: "POST",
					url: "proses/add-pengguna.php",
					data: data,
					processData: false,
					contentType: false,
					success: function(response) {
						var dataresponse = JSON.parse(response);
						console.log(dataresponse);
						if(dataresponse.status == "1") {
							window.location.href='pengguna'
						}else {
							swal('Peringatan', 'Gagal menambah data', 'error');
						}
					}
				});
				return false;
			});
		});
	</script>
</body>
</html>
	<?php } else {
		header("Location: beranda");
	}?>