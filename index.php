<?php include 'koneksi.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<meta name="author" content="Toko Zizah">
	<meta name="description" content="Toko Zizah adalah aplikasi pemesanan baju">
	<meta name="keywords" content="toko zizah, smkbisa, malang">
	<title>Otis</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<link rel="stylesheet" href="assets/plugins/bootstrap-social/bootstrap-social.css">
	<link rel="stylesheet" type="text/css" href="assets/dist/css/style.css">
	<link rel="stylesheet" href="assets/dist/css/components.css">
	<style type="text/css">
		body {
			margin-top: 7px;
		}
	</style>
</head>
<body>
	<div id="app">
		<section class="section">
			<div class="d-flex flex-wrap align-items-stretch">
				<div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
					<div class="p-4 m-3">
						<h4 class="text-dark font-weight-normal">Login <span class="font-weight-bold">Otis</span></h4>
						<p class="text-muted">Sebelum Anda memulai, Anda harus login terlebih dahulu</p>
						<form method="POST" action="#" id="login" role="form">
							<div class="form-group">
								<label for="username">Nama Pengguna</label>
								<input type="text" name="username" id="username" class="form-control" tabindex="1" required="" autofocus="" placeholder="Masukan username" autocomplete="off" maxlength="20" minlength="2">
							</div>
							<div class="form-group">
								<div class="d-block">
									<label for="password" class="control-label">Kata Sandi</label>
								</div>
								<input type="password" name="password" id="password" class="form-control" tabindex="2" required="" autocomplete="off" maxlength="20" minlength="5" placeholder="Masukan kata sandi">
							</div>
							<div class="form-group text-right">
								<button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
									Masuk
								</button>
							</div>
							<!-- <div class="mt-5 text-center">
								Belum mempunyai akun? <a href="daftar">Daftar Sekarang</a>
							</div> -->
						</form>
						<div class="text-center mt-5 text-small">
							Hak Cipta &copy; 2021 Otis
						</div>
					</div>
				</div>
				<div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" style="padding: 0 !important">
					<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
							<li data-target="#carouselExampleIndicators" data-slide-to="6"></li>
						</ol>
						<div class="carousel-inner">
							<div class="carousel-item active">
								<img class="d-block w-100" style="height: 100vh;" src="assets/images/slider/1.jpg" alt="First slide">
							</div>
							<div class="carousel-item">
								<img class="d-block w-100" style="height: 100vh;" src="assets/images/slider/2.jpg" alt="Second slide">
							</div>
							<div class="carousel-item">
								<img class="d-block w-100" style="height: 100vh;" src="assets/images/slider/3.jpg" alt="Third slide">
							</div>
							<div class="carousel-item">
								<img class="d-block w-100" style="height: 100vh;" src="assets/images/slider/4.jpg" alt="Four slide">
							</div>
							<div class="carousel-item">
								<img class="d-block w-100" style="height: 100vh;" src="assets/images/slider/5.jpg" alt="Five slide">
							</div>
							<div class="carousel-item">
								<img class="d-block w-100" style="height: 100vh;" src="assets/images/slider/6.jpg" alt="Six slide">
							</div>
							<div class="carousel-item">
								<img class="d-block w-100" style="height: 100vh;" src="assets/images/slider/7.jpg" alt="Seven slide">
							</div>
						</div>
					</div>
					<div class="absolute-bottom-left index-2">
						<div class="text-light p-5 pb-2">
							<div class="mb-5 pb-3">
								<h1 class="mb-2 display-4 font-weight-bold" style="text-shadow: 0 0 5px #000">Selamat Datang</h1>
								<h5 class="font-weight-normal text-muted-transparent" style="text-shadow: 0 0 5px #000">Aplikasi Sistem Otis</h5>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
	<script src="assets/plugins/sweetalert/docs/assets/sweetalert/sweetalert.min.js"></script>
	<script src="assets/dist/js/stisla.js"></script>
	<script src="assets/dist/js/scripts.js"></script>
	<script src="assets/dist/js/custom.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#login").submit(function(e) {
				e.preventDefault();
				var data = $(this).serialize();
				$.ajax({
					type: "POST",
					url: "proses/login.php",
					data: data,
					success: function(response) {
						var dataresponse = JSON.parse(response);
						console.log(dataresponse);
						if(dataresponse.status == "0") {
							swal('Peringatan', 'Maaf, Kami tidak dapat menemukan akun Anda', 'error');
						}else if(dataresponse.status == "1") {
							window.location.href='beranda'
						}else {
							swal('Peringatan', 'Maaf, Kami tidak dapat menemukan akun Anda', 'error');
						}
					}
				});
				return false;
			});
		});
	</script>
</body>
</body>
</html>