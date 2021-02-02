<?php include 'koneksi.php'; ?>
<?php

if($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'Pimpinan Final' || $_SESSION['role'] === 'Pimpinan Unit' || $_SESSION['role'] === 'Pimpinan Cabang' ){
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
						<h1>Lembur</h1>
						<div class="section-header-breadcrumb">
							<div class="breadcrumb-item active"><a href="beranda">Beranda</a></div>
							<div class="breadcrumb-item">Lembur</div>
						</div>
					</div>
					<div class="section-body">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<a href="tambah-lembur" class="btn btn-primary" style="border-radius: 4px;"><i class="fas fa-plus"></i></a>
										<?php if($_SESSION['role'] === 'admin'): ?>
										<a href="laporan-lembur-excel" target="_blank" class="btn btn-success ml-2" style="border-radius: 4px;">EXPORT KE EXCEL</a>
										<?php endif; ?>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-striped" id="table-1">
												<thead>
													<tr>
														<th>No</th>
														<th>Nama</th>
														<th>Tanggal</th>
														<th>Jam Mulai</th>
														<th>Jam Selesai</th>
														<th>Aktivitas</th>
														<th>Approval Unit</th>
														<th>Approval Cabang</th>
														<th>Approval Final</th>
														<th>Aksi</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$no = 1;
													if($_SESSION['role'] === 'Pimpinan Final'){
														$kueri = $conn->prepare("SELECT * FROM tb_lembur WHERE approval_cabang != 'Belum di approve' ORDER BY tanggal ASC ");
													} else if($_SESSION['role'] === 'Pimpinan Cabang'){		
														$kode = $_SESSION['kode_outlet'];
														if($_SESSION['posisi'] === 'Manajer Bisnis ULaMM'){
															$kueri = $conn->prepare("SELECT * FROM tb_lembur WHERE posisi = 'Staf - KAM' AND approval_unit != 'Tidak di setujui' AND approval_unit != 'Belum di approve' ORDER BY tanggal ASC ");
														} else {
															$kueri = $conn->prepare("SELECT * FROM tb_lembur WHERE kode_outlet = '$kode' ORDER BY tanggal ASC ");
														}
													} else if($_SESSION['role'] === 'Pimpinan Unit') {
														$kode = $_SESSION['kode_outlet'];
														$kueri = $conn->prepare("SELECT * FROM tb_lembur WHERE approval_unit = 'Belum di approve' AND kode_outlet = '$kode' ORDER BY tanggal ASC ");
													} else {
														$kueri = $conn->prepare("SELECT * FROM tb_lembur WHERE approval_final != 'Tidak di setujui' AND approval_unit != 'Belum di approve' AND approval_cabang != 'Belum di approve' ORDER BY tanggal ASC ");
													}
													$kueri->execute();
													while($tampil = $kueri->fetch(PDO::FETCH_ASSOC)) {
														?>
														<tr>
															<td><?php echo $no++;?></td>
															<td><?php echo $tampil['nama'];?></td>
															<td><?php echo $tampil['tanggal'];?></td>
															<td><?php echo $tampil['jam_mulai'];?></td>
															<td><?php echo $tampil['jam_selesai'];?></td>
															<td><?php echo $tampil['aktivitas'];?></td>
															<td>
																<?php if($tampil['approval_unit'] === 'Belum di approve') {
																	echo "Belum di approve";
																} else if($tampil['approval_unit'] === 'Tidak di setujui') {
																	echo "Tidak di setujui";
																} else if($tampil['approval_unit'] === 'Tidak perlu approval unit'){
																	echo "Tidak perlu approval unit";
																} else {?>
																	<img src="assets/images/approval/<?php echo $tampil['approval_unit'];?>" style="width: 150px; height: 150px">
																<?php } ?>
															</td>
															<td>
																<?php if($tampil['approval_cabang'] === 'Belum di approve') { 
																	echo "Belum di approve";	
																} else if($tampil['approval_cabang'] === 'Tidak di setujui'){
																	echo "Tidak di setujui";
																} else { ?>
																	<img src="assets/images/approval/<?php echo $tampil['approval_cabang'];?>" style="width: 150px; height: 150px">
																<?php } ?>
															</td>
															<td>
																<?php if($tampil['approval_final'] === 'Belum di approve') { 
																	echo "Belum di approve";
																} else if($tampil['approval_final'] === 'Tidak di setujui') {
																	echo "Tidak di setujui";
																} else {?>
																	<img src="assets/images/approval/<?php echo $tampil['approval_final'];?>" style="width: 150px; height: 150px">
																<?php } ?>
															</td>
															<td style="white-space: nowrap;">
																<?php if($_SESSION['role'] === 'Pimpinan Unit'): ?>
																	<?php if($tampil['approval_unit'] === 'Belum di approve'): ?>
																		<a href="approval-unit?id=<?php echo $tampil['id_lembur'];?>" class="btn btn-success">Approve</a>
																		<a href="" data-id-lembur="<?= $tampil['id_lembur'] ?>" class="btn btn-danger" id="tolak-data">Tolak</a>
																	<?php endif;?>
																<?php endif; ?>
																<?php if($_SESSION['role'] === 'Pimpinan Cabang'): ?>
																	<?php if($tampil['approval_cabang'] === 'Belum di approve'): ?>
																		<a href="approval-cabang?id=<?php echo $tampil['id_lembur'];?>" class="btn btn-success">Approve</a>
																		<a href="" data-id-lembur="<?= $tampil['id_lembur'] ?>" class="btn btn-danger" id="tolak-data">Tolak</a>
																	<?php endif; ?>
																<?php endif; ?>
																<?php if($_SESSION['role'] === 'Pimpinan Final'): ?>
																	<?php if($tampil['approval_final'] === 'Belum di approve'): ?>
																		<a href="approval-final?id=<?php echo $tampil['id_lembur'];?>" class="btn btn-success">Approve</a>
																		<a href="" data-id-lembur="<?= $tampil['id_lembur'] ?>" class="btn btn-danger" id="tolak-data">Tolak</a>
																	<?php endif;?>
																<?php endif; ?>
																<a href="detail-lembur?id=<?php echo $tampil['id_lembur'];?>" class="btn btn-info"><i class="fas fa-edit"></i></a>
																<a href="laporan-lembur?id=<?= $tampil['id_lembur'] ?>" target="blank" class="btn btn-warning" style="border-radius: 4px;">PDF</a>
																<?php if($_SESSION['role'] === 'admin'): ?>
																	<a href="" class="btn btn-danger" id="delete-data" data-id="<?php echo $tampil['id_lembur'];?>"><i class="fas fa-trash-alt"></i></a>
																<?php endif; ?>
															</td>
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
			<footer class="main-footer">
				<?php include 'menu/footer.php'; ?>
			</footer>
		</div>
	</div>
	<?php include 'menu/script.php'; ?>
	<script type="text/javascript">
		"use strict";
		$("#table-1").dataTable();
	</script>
	<script type="text/javascript">
		$(document).on('click','#tolak-data', function(e) {
			e.preventDefault();
			var id = $(this).data('id');
			var idLembur = $(this).data('id-lembur');
			swal({
				title: 'Apakah Anda yakin?',
				text: 'Setelah di tolak, Anda tidak dapat mengedit data ini !',
				icon: 'warning',
				buttons: {
					cancel: {
						text: "Jangan",
						value: false,
						visible: true,
						className: "",
						closeModal: true,
					},
					confirm: {
						text: "Ya",
						value: true,
						visible: true,
						className: "",
						closeModal: true
					},
				},
				dangerMode: true,
			}).then((willDelete) => {
				if (willDelete) {
					$.ajax({
						type: "POST",
						url: "proses/tolak-approval.php",
						data: {'id_lembur':idLembur},
						success: function(response) {
							console.log(response);
							var dataresponse = JSON.parse(response);
							if(dataresponse.status == "1") {
								window.location.href='lembur'
							}else {
								swal('Peringatan', 'Kesalahan dalam sebuah query', 'error');
							}
						}
					});
				}
			});
		});

		$(document).on('click','#delete-data', function(e) {
			e.preventDefault();
			var id = $(this).data('id');
			swal({
				title: 'Apakah Anda yakin?',
				text: 'Setelah dihapus, Anda tidak dapat memulihkan data ini !',
				icon: 'warning',
				buttons: {
					cancel: {
						text: "Jangan",
						value: false,
						visible: true,
						className: "",
						closeModal: true,
					},
					confirm: {
						text: "Ya, hapus saja!",
						value: true,
						visible: true,
						className: "",
						closeModal: true
					},
				},
				dangerMode: true,
			}).then((willDelete) => {
				if (willDelete) {
					$.ajax({
						type: "POST",
						url: "proses/delete-lembur.php",
						data: {'id':id},
						success: function(response) {
							var dataresponse = JSON.parse(response);
							if(dataresponse.status == "1") {
								window.location.href='lembur'
							}else {
								swal('Peringatan', 'Kesalahan dalam sebuah query', 'error');
							}
						}
					});
				}
			});
		});
	</script>
</body>
</html>
<?php } else {
	header("Location: beranda");
} ?>