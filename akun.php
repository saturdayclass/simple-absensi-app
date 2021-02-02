<?php include 'koneksi.php'; ?>
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
						<h1>Akun</h1>
						<div class="section-header-breadcrumb">
							<div class="breadcrumb-item active"><a href="beranda">Beranda</a></div>
							<div class="breadcrumb-item">Akun</div>
						</div>
					</div>
					<div class="section-body">
						<div class="row">
							<div class="col-12 col-md-12 col-lg-12">
								<div class="card">
									<form method="POST" action="#" id="data-form">
										<div class="card-body">
											<div class="row">
												<div class="form-group col-md-6 col-12">
													<label>Nama</label>
													<input type="text" class="form-control" name="nama" id="nama" required="" autocomplete="off" placeholder="Nama" value="<?php echo $online['nama'];?>" <?php if($_SESSION['role'] !== 'Super Admin') {echo "disabled"; }?>>
													<input type="hidden" name="id" value="<?php echo $online['id_user'];?>">
												</div>
												<div class="form-group col-md-6 col-12">
													<label>Nip</label>
													<input type="text" class="form-control" <?php if($_SESSION['role'] !== 'Super Admin') {echo "disabled"; }?> name="telepon" id="telepon" required="" onkeypress="return hanyaAngka(event)" autocomplete="off" placeholder="Telepon" value="<?php echo $online['nip'];?>">
												</div>
											</div>
											<div class="row">
												<div class="form-group col-12">
													<label>Role</label>
													<input class="form-control" <?php if($_SESSION['role'] !== 'Super Admin') {echo "disabled"; }?> name="posisi" value="<?php echo $_SESSION['role'];?>" id="posisi" required=""></input>
												</div>
											</div>
										</div>
										<?php if($_SESSION['role'] === 'Super Admin'): ?>
											<div class="card-footer text-right">
												<input type="submit" name="submit" class="btn btn-primary" value="Simpan Perubahan">
											</div>
										<?php endif;?>
									</form>
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
					url: "proses/update-akun.php",
					data: data,
					processData: false,
					contentType: false,
					success: function(response) {
						var dataresponse = JSON.parse(response);
						console.log(dataresponse);
						if(dataresponse.status == "1") {
							window.location.href='akun'
						}else {
							swal('Peringatan', 'Kesalahan dalam sebuah query', 'error');
						}
					}
				});
				return false;
			});
		});
	</script>
</body>
</html>