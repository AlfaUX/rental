<?php
// Function to check if the user agent belongs to a mobile device
function isMobileDevice()
{
	return preg_match('/(android|webos|iphone|ipad|ipod|blackberry|windows phone)/i', $_SERVER['HTTP_USER_AGENT']);
}

// Use the isMobileDevice function to check if the device is mobile
$isMobile = isMobileDevice();
?>

<!-- For mobile devices -->
<?php if ($isMobile && $_SESSION['hak_akses'] == "Pemilik"): ?>
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<i class="fa fa-bars" style="margin-right: 5px;"></i> <span class="hidden-xs">Administrasi</span>
		</a>
		<ul class="dropdown-menu">
			<li>
				<a href="user.php">
					<i class="fa fa-user" style="color: black; margin-right: 5px;"></i>
					<span style="color: black;">Administrasi Karyawan</span>
				</a>
			</li>
			<li>
				<a href="index.php">
					<i class="fa fa-gamepad" style="color: black; margin-right: 5px;"></i>
					<span style="color: black;">Administrasi Komputer</span>
				</a>
			</li>
			<li>
				<a href="pelanggan.php">
					<i class="fa fa-users" style="color: black; margin-right: 5px;"></i>
					<span style="color: black;">Administrasi Pelanggan</span>
				</a>
			</li>
			<li>
				<a href="sesi.php">
					<i class="fa fa-clock-o" style="color: black; margin-right: 5px;"></i>
					<span style="color: black;">Administrasi Sesi</span>
				</a>
			</li>
		</ul>
	</li>
<?php endif; ?>

<?php if ($isMobile && $_SESSION['hak_akses'] == "Operator"): ?>
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			<i class="fa fa-bars" style="margin-right: 5px;"></i> <span class="hidden-xs">Administrasi</span>
		</a>
		<ul class="dropdown-menu">
			<li>
				<a href="pelanggan.php">
					<i class="fa fa-users" style="color: black; margin-right: 5px;"></i>
					<span style="color: black;">Administrasi Pelanggan</span>
				</a>
			</li>
			<li>
				<a href="indexop.php">
					<i class="fa fa-clock-o" style="color: black; margin-right: 5px;"></i>
					<span style="color: black;">Administrasi Sesi</span>
				</a>
			</li>
		<?php endif; ?>

		<?php if ($isMobile && $_SESSION['hak_akses'] == "Tamu"): ?>

				<?php endif; ?>
			</ul>
			</div>
			</nav>
			</header>

			<aside class="main-sidebar">
				<section class="sidebar">
					<ul class="sidebar-menu" data-widget="tree">
						<li class="header">MENU</li>

						<?php if ($_SESSION['hak_akses'] == "Pemilik"): ?>
							<li <?php if ($halaman == "Karyawan")
								echo 'class="active"'; ?>>
								<a href="user.php">
									<i class="fa fa-user" style="color: skyblue;"></i> <span>Administrasi Karyawan</span>
								</a>
							</li>
						<?php endif; ?>

						<?php if ($_SESSION['hak_akses'] == "Pemilik"): ?>
							<li <?php if ($halaman == "Konsol")
								echo 'class="active"'; ?>>
								<a href="index.php">
									<i class="fa fa-gamepad" style="color: white;"></i> <span>Administrasi Komputer</span>
								</a>
							</li>
						<?php endif; ?>

						<?php if ($_SESSION['hak_akses'] == "Pemilik" || $_SESSION['hak_akses'] == "Operator"): ?>
							<li <?php if ($halaman == "Pelanggan")
								echo 'class="active"'; ?>>
								<a href="pelanggan.php">
									<i class="fa fa-users" style="color: white;"></i> <span>Administrasi Pelanggan</span>
								</a>
							</li>
						<?php endif; ?>

						<?php if ($_SESSION['hak_akses'] == "Pemilik" || $_SESSION['hak_akses'] == "Operator" || 
						$_SESSION['hak_akses'] == "Tamu"): ?>
							<li <?php if ($halaman == "Sesi")
								echo 'class="active"'; ?>>
								<a
									href="<?php if ($_SESSION['hak_akses'] == "Pemilik"): ?> sesi.php <?php elseif 
									($_SESSION['hak_akses'] == "Operator"): ?> indexop.php 
									<?php elseif ($_SESSION['hak_akses'] == "Tamu"): ?> indexmem.php <?php endif; ?>">
									<i class="fa fa-clock-o" style="color: white;"></i> <span>Administrasi Sesi</span>
								</a>

							</li>
						<?php endif; ?>
					</ul>
				</section>
			</aside>