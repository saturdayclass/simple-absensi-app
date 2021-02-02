<?php include 'koneksi.php'; ?>
<?php

if($_SESSION['role'] === 'Super Admin'){
$id = $_GET['id'];
$query = $conn->prepare("SELECT * FROM tb_outlet WHERE id_outlet = '$id'");
$query->execute();
$row = $query->fetch(PDO::FETCH_ASSOC);
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
						<h1>Update Outlet</h1>
						<div class="section-header-breadcrumb">
							<div class="breadcrumb-item active"><a href="beranda">Beranda</a></div>
							<div class="breadcrumb-item"><a href="pengguna">Outlet</a></div>
							<div class="breadcrumb-item">Update Outlet</div>
						</div>
					</div>
					<div class="section-body">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-body">
										<form role="form" action="#" method="POST" enctype="multipart/form-data" id="data-form">
											<input type="hidden" name="id" value="<?= $row['id_outlet'] ?>">
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label for="nama">Kode Outlet</label>
														<input type="text" class="form-control" name="kode" id="kode" required="" autocomplete="off" value="<?= $row['kode_outlet'] ?>" maxlength="100" autofocus="">
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
					url: "proses/update-outlet.php",
					data: data,
					processData: false,
					contentType: false,
					success: function(response) {
						var dataresponse = JSON.parse(response);
						if(dataresponse.status == "1") {
							window.location.href='outlet'
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

<?php } else {
	header("Location: beranda");
}?>