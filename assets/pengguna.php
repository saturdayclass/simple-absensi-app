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
						<h1>Pembimbing</h1>
						<div class="section-header-breadcrumb">
							<div class="breadcrumb-item active"><a href="beranda">Beranda</a></div>
							<div class="breadcrumb-item">Pembimbing</div>
						</div>
					</div>
					<div class="section-body">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<a href="tambah-pembimbing" class="btn btn-primary" style="border-radius: 4px;"><i class="fas fa-plus"></i></a>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-striped" id="table-1">
												<thead>
													<tr>
														<th>No</th>
														<th>Nama</th>
														<th>Telepon</th>
														<th>Agama</th>
														<th>Aksi</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$no = 1;
													$kueri = mysqli_query($conn, "SELECT * FROM tb_pembimbing ORDER BY nama_pembimbing ASC");
													while($tampil = mysqli_fetch_array($kueri)) {
														?>
														<tr>
															<td><?php echo $no++;?></td>
															<td><?php echo $tampil['nama_pembimbing'];?></td>
															<td><?php echo $tampil['telepon'];?></td>
															<td><?php echo $tampil['agama'];?></td>
															<td style="white-space: nowrap;">
																<a href="detail-pembimbing?id=<?php echo $tampil['id_pembimbing'];?>" class="btn btn-success"><i class="fas fa-edit"></i></a>
																<a href="" class="btn btn-danger" id="delete-data" data-id="<?php echo $tampil['id_pembimbing'];?>"><i class="fas fa-trash-alt"></i></a>
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
				<?php include 'menu/footer.php';?>
			</footer>
		</div>
	</div>
	<?php include 'menu/script.php'; ?>
	<script type="text/javascript">
		"use strict";
		$("#table-1").dataTable();
	</script>
	<script type="text/javascript">
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
						url: "proses/delete-pembimbing.php",
						data: {'id':id},
						success: function(response) {
							var dataresponse = JSON.parse(response);
							console.log(dataresponse);
							if(dataresponse.status == "1") {
								window.location.href='pembimbing'
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