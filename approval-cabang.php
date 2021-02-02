<?php include 'koneksi.php'; ?>
<?php
$id = $_GET['id'];
$query = $conn->prepare("SELECT * FROM tb_lembur WHERE id_lembur = '$id'");
$query->execute();
$row = $query->fetch(PDO::FETCH_ASSOC);
if($_SESSION['role'] === 'Pimpinan Cabang'){
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
						<h1>Approve Lembur</h1>
						<div class="section-header-breadcrumb">
							<div class="breadcrumb-item active"><a href="beranda">Beranda</a></div>
							<div class="breadcrumb-item"><a href="produk">Lembur</a></div>
							<div class="breadcrumb-item">Approve Lembur</div>
						</div>
					</div>
					<div class="section-body">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-body">
										<form role="form" action="#" method="POST" enctype="multipart/form-data" id="data-form">
											<div class="row">
												<div class="col-md-6">
													<input type="hidden" value="<?= $row['id_lembur'] ?>" name="id">
													<div class="form-group">
														<label for="approval_cabang">Approve</label>
														<input type="file" class="form-control" value="<?= $row['approval_cabang'] ?>" name="approval_cabang" id="approval_cabang" accept="image/png">
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<a href="lembur" class="btn btn-danger">Kembali</a>
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
					url: "proses/approval-cabang.php",
					data: data,
					processData: false,
					contentType: false,
					success: function(response) {
						var dataresponse = JSON.parse(response);
						console.log(dataresponse);
						if(dataresponse.status == "1") {
							window.location.href='lembur'
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
} ?>