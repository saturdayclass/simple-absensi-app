<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'menu/head.php'; ?>
</head>
<body class="layout-3">
	<div id="app">
		<div class="main-wrapper container">
			<div class="navbar-bg"></div>
			<nav class="navbar navbar-expand-lg main-navbar">
				<?php include 'menu/nav-pertama.php';?>
			</nav>
			<nav class="navbar navbar-secondary navbar-expand-lg">
				<?php include 'menu/nav-kedua.php';?>
			</nav>
			<div class="main-content">
				<section class="section">
					<div class="section-header">
						<h1>Tambah Pembimbing</h1>
						<div class="section-header-breadcrumb">
							<div class="breadcrumb-item active"><a href="beranda">Beranda</a></div>
							<div class="breadcrumb-item"><a href="pembimbing">Pembimbing</a></div>
							<div class="breadcrumb-item">Tambah Pembimbing</div>
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
														<label for="nama_pembimbing">Nama Pembimbing</label>
														<input type="text" class="form-control" name="nama_pembimbing" id="nama_pembimbing" required="" autocomplete="off" placeholder="Masukkan Nama Pembimbing" maxlength="100" autofocus="">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="jenis_kelamin">Jenis Kelamin</label>
														<select class="form-control select2" name="jenis_kelamin" id="jenis_kelamin" required="">
															<option value="">Pilih Jenis Kelamin</option>
															<option value="Laki - Laki">Laki - Laki</option>
															<option value="Perempuan">Perempuan</option>
														</select>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="tanggal_lahir">Tanggal Lahir</label>
														<input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" required="" autocomplete="off" placeholder="Masukkan Tanggal Lahir">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="telepon">Telepon</label>
														<input type="text" class="form-control" name="telepon" id="telepon" required="" autocomplete="off" placeholder="Masukkan Telepon" minlength="11" maxlength="15" onkeypress="return hanyaAngka(event)">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="agama">Agama</label>
														<select class="form-control select2" name="agama" id="agama" required="">
															<option value="">Pilih Agama</option>
															<option value="Buddha">Buddha</option>
															<option value="Hindu">Hindu</option>
															<option value="Islam">Islam</option>
															<option value="Katolik">Katolik</option>
															<option value="Konghucu">Konghucu</option>
															<option value="Kristen">Kristen</option>
														</select>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="email">Email</label>
														<input type="email" class="form-control" name="email" id="email" required="" autocomplete="off" placeholder="Masukkan Email" maxlength="50">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label for="alamat">Alamat</label>
														<textarea class="form-control" name="alamat" id="alamat" required="" placeholder="Tuliskan Alamat" style="height: 150px;"></textarea>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<a href="pembimbing" class="btn btn-danger">Kembali</a>
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
				<?php include 'menu/footer.php';?>
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
					url: "proses/add-pembimbing.php",
					data: data,
					processData: false,
					contentType: false,
					success: function(response) {
						var dataresponse = JSON.parse(response);
						console.log(dataresponse);
						if(dataresponse.status == "1") {
							window.location.href='pembimbing'
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