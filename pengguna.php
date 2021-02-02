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
						<h1>Pengguna</h1>
						<div class="section-header-breadcrumb">
							<div class="breadcrumb-item active"><a href="beranda">Beranda</a></div>
							<div class="breadcrumb-item">Pengguna</div>
						</div>
					</div>
					<div class="section-body">
						<div class="row">
							<div class="col-12">
								<div class="card">
									<div class="card-header">
										<a href="tambah-pengguna" class="btn btn-primary" style="border-radius: 4px;"><i class="fas fa-plus"></i></a>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-striped" id="table-1">
												<thead>
													<tr>
														<th>No</th>
														<th>Nama</th>
														<th>Nip</th>
														<th>Posisi</th>
														<th>Unit Kerja</th>
														<th>Kode Outlet</th>
														<th>Username</th>
														<th>Password</th>
														<th>Role</th>
														<th>Aksi</th>
													</tr>
												</thead>
												<tbody>
													<?php
													$no = 1;
													$kueri = $conn->prepare("SELECT * FROM tb_user ORDER BY nama ASC");
													$kueri->execute();
													while($tampil = $kueri->fetch(PDO::FETCH_ASSOC)) {
														?>
														<tr>
															<td><?php echo $no++;?></td>
															<td><?php echo $tampil['nama'];?></td>
															<td><?php echo $tampil['nip'];?></td>
															<td><?php echo $tampil['posisi'];?></td>
															<td><?php echo $tampil['unit_kerja'];?></td>
															<td><?php echo $tampil['kode_outlet'];?></td>
															<td><?php echo $tampil['username'];?></td>
															<td><?php echo $tampil['password'];?></td>
															<td><?php echo $tampil['role'];?></td>
															<td style="white-space: nowrap;">
																<a href="detail-pengguna?id=<?php echo $tampil['id_user'];?>" class="btn btn-success"><i class="fas fa-edit"></i></a>
																<a href="" class="btn btn-danger" id="delete-data" data-id="<?php echo $tampil['id_user'];?>"><i class="fas fa-trash-alt"></i></a>
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
						url: "proses/delete-pengguna.php",
						data: {'id':id},
						success: function(response) {
							var dataresponse = JSON.parse(response);
							console.log(dataresponse);
							if(dataresponse.status == "1") {
								window.location.href='pengguna'
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
}
?>