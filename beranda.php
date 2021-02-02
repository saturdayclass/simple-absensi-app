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
			<?php if($_SESSION['role'] !== 'Staf/Non Staf'){ ?>
			<div class="main-content">
				<section class="section">
					<div class="section-header">
						<h1>Beranda</h1>
						<div class="section-header-breadcrumb">
							<div class="breadcrumb-item active"><a href="beranda">Beranda</a></div>
						</div>
					</div>
					<?php if($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'Pimpinan Final' || $_SESSION['role'] === 'Pimpinan Unit' || $_SESSION['role'] === 'Pimpinan Cabang' ) : ?>
						<div class="row">
							<div class="col-lg-12 col-md-6 col-sm-6 col-12">
								<a href="lembur">
									<div class="card card-statistic-1">
										<div class="card-icon bg-danger">
											<i class="far fa-newspaper"></i>
										</div>
										<div class="card-wrap">
											<div class="card-header">
												<h4>Data Lembur</h4>
											</div>
											<div class="card-body">
												<?php
												if($_SESSION['role'] === 'Pimpinan Cabang'){
													$kode = $_SESSION['kode_outlet'];
													if($_SESSION['posisi'] === 'Manajer Bisnis ULaMM'){
															$sql2 = $conn->prepare("SELECT COUNT(*) AS lembur FROM tb_lembur WHERE posisi = 'Staf - KAM' AND approval_unit != 'Belum di approve' ");
														} else {
															$sql2 = $conn->prepare("SELECT COUNT(*) AS lembur FROM tb_lembur WHERE kode_outlet = '$kode' ");
														}
												} else if($_SESSION['role'] === 'Pimpinan Final'){
													$sql2 = $conn->prepare("SELECT COUNT(*) AS lembur FROM tb_lembur WHERE approval_cabang != 'Belum di approve'");
												} else if($_SESSION['role'] === 'Pimpinan Unit'){
													$kode = $_SESSION['kode_outlet'];
													$sql2 = $conn->prepare("SELECT COUNT(*) AS lembur FROM tb_lembur WHERE approval_unit = 'Belum di approve' AND kode_outlet = '$kode' ");
												} else {
													$sql2 = $conn->prepare("SELECT COUNT(*) AS lembur FROM tb_lembur WHERE approval_final != 'Tidak di setujui' AND approval_unit != 'Belum di approve' AND approval_cabang != 'Belum di approve' ");
												}
												$sql2->execute();
												$data = $sql2->fetch(PDO::FETCH_ASSOC);
												echo $data['lembur'];
												?>
											</div>
										</div>
									</div>
								</a>
							</div>
						</div>
					<?php endif; ?>
					<?php if($_SESSION['role'] === 'Super Admin') : ?>
					<div class="row">
						<div class="col-lg-4 col-md-6 col-sm-6 col-12">
							<a href="pengguna">
								<div class="card card-statistic-1">
									<div class="card-icon bg-warning">
										<i class="far fa-user"></i>
									</div>
									<div class="card-wrap">
										<div class="card-header">
											<h4>Pengguna</h4>
										</div>
										<div class="card-body">
											<?php
											$sql = $conn->prepare("SELECT COUNT(*) AS pengguna FROM tb_user");
											$sql->execute();
											$data = $sql->fetch(PDO::FETCH_ASSOC);
											echo $data['pengguna'];
											?>
										</div>
									</div>
								</div>
							</a>
						</div>
						
						<div class="col-lg-4 col-md-6 col-sm-6 col-12">
							<a href="cabang">
								<div class="card card-statistic-1">
									<div class="card-icon bg-danger">
										<i class="far fa-newspaper"></i>
									</div>
									<div class="card-wrap">
										<div class="card-header">
											<h4>Data Unit</h4>
										</div>
										<div class="card-body">
											<?php
											$sql2 = $conn->prepare("SELECT COUNT(*) AS unit FROM tb_cabang");
											$sql2->execute();
											$data = $sql2->fetch(PDO::FETCH_ASSOC);
											echo $data['unit'];
											?>
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="col-lg-4 col-md-6 col-sm-6 col-12">
							<a href="level">
								<div class="card card-statistic-1">
									<div class="card-icon bg-danger">
										<i class="far fa-newspaper"></i>
									</div>
									<div class="card-wrap">
										<div class="card-header">
											<h4>Data Level</h4>
										</div>
										<div class="card-body">
											<?php
											$sql2 = $conn->prepare("SELECT COUNT(*) AS posisi FROM tb_posisi");
											$sql2->execute();
											$data = $sql2->fetch(PDO::FETCH_ASSOC);
											echo $data['posisi'];
											?>
										</div>
									</div>
								</div>
							</a>
						</div>
						</div>
					</div>
					<?php endif;?>
				</section>
			</div>
			<?php } else { ?>
					<div class="main-content">
						<section class="section">
							<div class="section-header">
								<h1>Absensi</h1>
								<div class="section-header-breadcrumb">
									<div class="breadcrumb-item active"><a href="beranda">Absensi</a></div>
								</div>
							</div>
							<div class="row">
								<div class="col-12">
									<div class="card">
										<div class="card-body">
											<?php 
												$nip = $online['nip'];
												$queryLembur = $conn->prepare("SELECT * FROM tb_lembur WHERE nip = '$nip' ");
												$queryLembur->execute();
												$fetchLembur = $queryLembur->fetch(PDO::FETCH_ASSOC);
												$tglCreate = $fetchLembur['created'];
												$tglNow = date("Y-m-d");

												// if($tglNow > $tglCreate){
											?>
											<form role="form" action="#" method="POST" id="data-form">
												<div class="row">
													<div class="col-md-6">
														<input type="hidden" value="<?= $online['nama'] ?>" name="nama">
														<input type="hidden" value="<?= $online['nip'] ?>" name="nip">
														<input type="hidden" value="<?= $online['kode_outlet'] ?>" name="kode">
														<input type="hidden" value="<?= $online['posisi'] ?>" name="posisi">
														<div class="form-group">
															<label for="nama">Nama</label>
															<input type="text" class="form-control" name="nama" id="nama" required="" value="<?= $online['nama'] ?>" autocomplete="off" disabled>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="nip">Nip</label>
															<input type="text" class="form-control" name="nip" id="nip" required="" value="<?= $online['nip'] ?>" autocomplete="off" disabled>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="kode">Kode Outlet</label>
															<input type="text" class="form-control" name="kode" id="kode" required="" value="<?= $online['kode_outlet'] ?>" autocomplete="off" disabled>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="tanggal_lembur">Tanggal Lembur</label>
															<input type="date" class="form-control" name="tanggal_lembur" id="tanggal_lembur" required="" autocomplete="off" maxlength="100" autofocus="">
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="jam_mulai">Jam Mulai</label>
															<input type="time" class="form-control" name="jam_mulai" id="jam_mulai" required="" autocomplete="off" >
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group">
															<label for="jam_selesai">Jam Selesai</label>
															<input type="time" class="form-control" name="jam_selesai" id="jam_selesai" required="" autocomplete="off" placeholder="Masukkan Harga">
														</div>
													</div>
													<div class="col-md-12">
														<div class="form-group">
															<label for="aktivitas">Aktivitas</label>
															<textarea class="form-control" name="aktivitas" id="aktivitas" placeholder="Tuliskan Aktivitas" required="" style="height: 125px;"></textarea>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<button type="submit" class="btn btn-primary float-right">Kirim</button>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
							<div class="section-body" id="data-lembur">
								<div class="row">
									<div class="col-12">
										<div class="card">
											<div class="card-body">
												<div class="table-responsive">
													<table class="table table-striped" id="table-1">
														<thead>
															<tr>
																<th>No</th>
																<th>Nama</th>
																<th>Nip</th>
																<th>Tanggal</th>
																<th>Jam Mulai</th>
																<th>Jam Selesai</th>
																<th>Aktivitas</th>
															</tr>
														</thead>
														<tbody>
															<?php
															$no = 1;
															$nip = $online['nip'];
															$kueri = $conn->prepare("SELECT nama, nip, tanggal, jam_mulai, jam_selesai, aktivitas FROM tb_lembur WHERE nip = '$nip' ORDER BY tanggal ASC");
															$kueri->execute();
															while($tampil = $kueri->fetch(PDO::FETCH_ASSOC)) {
																?>
																<tr>
																	<td><?php echo $no++;?></td>
																	<td><?php echo $tampil['nama'];?></td>
																	<td><?php echo $tampil['nip'];?></td>
																	<td><?php echo $tampil['tanggal'];?></td>
																	<td><?php echo $tampil['jam_mulai'];?></td>
																	<td><?php echo $tampil['jam_selesai'];?></td>
																	<td><?php echo $tampil['aktivitas'];?></td>
																</tr>
															<?php } ?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</section>
					</div>
				<?php }?>
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
					url: "proses/add-lembur-staf.php",
					data: data,
					processData: false,
					contentType: false,
					success: function(response) {
						var dataresponse = JSON.parse(response);
						if(dataresponse.status == "1") {
							window.location.reload();
							window.location.href='beranda#data-lembur'
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