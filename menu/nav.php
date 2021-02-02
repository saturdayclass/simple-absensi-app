<form class="form-inline mr-auto">
	<ul class="navbar-nav mr-3">
		<li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
	</ul>
</form>
<ul class="navbar-nav navbar-right">
	<li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
		<img alt="image" src="assets/dist/img/avatar/avatar-1.png" class="rounded-circle mr-1">
		<div class="d-sm-none d-lg-inline-block">Hai, <?php echo $online['nama'];?></div></a>
		<div class="dropdown-menu dropdown-menu-right">
			<div class='dropdown-title'>Selamat Datang</div>
			<a href="akun" class="dropdown-item has-icon">
				<i class="far fa-user"></i> Akun
			</a>
			<div class="dropdown-divider"></div>
			<a href="proses/logout.php" class="dropdown-item has-icon text-danger">
				<i class="fas fa-sign-out-alt"></i> Keluar
			</a>
		</div>
	</li>
</ul>