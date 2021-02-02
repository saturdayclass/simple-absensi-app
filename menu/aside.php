<div class="sidebar-brand">
	<a href="beranda">Otis App</a>
</div>
<div class="sidebar-brand sidebar-brand-sm">
	<a href="beranda">OA</a>
</div>
<ul class="sidebar-menu">
	<li class="menu-header">Menu Pertama</li>
	<li class="nav-item active">
		<a href="beranda" class="nav-link"><i class="fas fa-fire"></i><span>Beranda</span></a>
	</li>
		<?php if($_SESSION['role'] !== 'Staf/Non Staf') : ?>
	<li class="menu-header">Menu Kedua</li>
	<li class="nav-item dropdown">
		<a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Data</span></a>
		<ul class="dropdown-menu">
			<?php if($_SESSION['role'] === 'Super Admin'):?>
				<li><a class="nav-link" href="pengguna">Pengguna</a></li>
				<li><a class="nav-link" href="level">Level User</a></li>
				<li><a class="nav-link" href="cabang">Cabang</a></li>
				<li><a class="nav-link" href="outlet">Kode Outlet</a></li>
			<?php endif; ?>
			<?php if($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'Pimpinan Final' || $_SESSION['role'] === 'Pimpinan Unit' || $_SESSION['role'] === 'Pimpinan Cabang' ){
				echo "<li><a class='nav-link' href='lembur'>Lembur</a></li>";
			} ?>
		</ul>
	</li>
			<?php endif;?>
</ul>