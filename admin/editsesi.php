<?php
$judul_browser = "Microphile | Create Mode";

include 'koneksi.php';

?>
<style type="text/css">
	.btn-success {
		margin-left: 83%;
	}

	.panel-info {
		margin-top: 3%;
	}

	.navbar-inverse {
		background-color: green;
	}

	.navbar-brand {
		color: white;
		font-family: arial black;
	}
</style>

<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>
		<?php echo $judul_browser; ?>
	</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="../dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../dist/css/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="../dist/css/sweetalert2.min.css">
	<link rel="stylesheet" href="../dist/css/font-awesome.min.css">
	<link rel="stylesheet" href="../dist/css/ionicons.min.css">
	<!-- link rel="stylesheet" href="../dist/css/dataTables.bootstrap.min.css" -->
	<link rel="stylesheet" href="../dist/css/_all-skins.min.css">
</head>

<body class="hold-transition skin-blue sidebar-mini">

	<?php
	if (isset($_SESSION['status'])) {
		if ($_SESSION['status'] != "login") {
			?>
			<div class="row">
				<div class="col-md-offset-4 col-md-4">
					<div class="panel panel-warning">
						<div class="panel-heading">
							Informasi
						</div>
						<div class="panel-body">
							<p>Maaf, Anda tidak berhak mengakses halaman ini secara langsung. Silahkan login terlebih dahulu.
							</p>
							<a class="btn btn-warning pull-right" role="button" href="../login.php">Login</a>
						</div>
					</div>
				</div>
			</div>

		<?php
		} else if ($_SESSION['status'] == "login") {
			?>
				<div class="wrapper">
					<header class="main-header">
						<a href="#" class="logo">
							<span class="logo-lg">Aplikasi Rental Konsol</span>
						</a>
						<nav class="navbar navbar-static-top">
							<div class="navbar-custom-menu">
								<ul class="nav navbar-nav">
									<li class="dropdown user user-menu">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">
											<img src="../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
											<span class="hidden-xs">
											<?php echo ucwords($_SESSION['user']); ?>
											</span>
										</a>
										<ul class="dropdown-menu">
											<li class="user-header">
												<img src="../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
												<p>
												<?php echo $_SESSION['user']; ?>
												</p>
												<p><small>
													<?php echo $_SESSION['hak_akses'] ?>
													</small></p>
											</li>
											<li class="user-footer">
												<div class="pull-right">
													<a href="logout.php" class="btn btn-default btn-flat">Keluar</a>
												</div>
											</li>
										</ul>
									</li>
								</ul>
							</div>
						</nav>
					</header>

					<aside class="main-sidebar">
						<section class="sidebar">
							<ul class="sidebar-menu" data-widget="tree">
								<li class="header">MENU</li>
								<li>
									<a href="user.php">
										<i class="fa fa-user" style="color: skyblue;"></i> <span>Administrasi Karyawan</span>
									</a>
								</li>
								<li>
									<a href="index.php">
										<i class="fa fa-gamepad" style="color: white;"></i> <span>Administrasi Konsol</span>
									</a>
								</li>
								<li>
									<a href="pelanggan.php">
										<i class="fa fa-users" style="color: white;"></i> <span>Administrasi Pelanggan</span>
									</a>
								</li>
								<li class="active">
									<a href="sesi.php">
										<i class="fa fa-clock-o" style="color: white;"></i> <span>Administrasi Sesi</span>
									</a>
								</li>
							</ul>
						</section>
					</aside>

					<div class="content-wrapper">
						<section class="content-header">
							<h1>Tambah Sesi</h1>
							<ol class="breadcrumb">
								<li><a href="tambahsesi.php"><i class="fa fa-dashboard"></i> Beranda</a></li>
								<li>Administrasi Konsol</li>
								<li class="active">Create Mode</li>
							</ol>
						</section>
						<section class="content">

							<?php
							$id = $_GET['idkonsol'];
							$data = mysqli_query($koneksi, "select * from sesi where idsesi='$id'");
							$sesi = mysqli_query($koneksi, "SELECT MAX(IDSesi) AS IDSesiSekarang FROM sesi;");
							$pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE IDPelanggan IN (SELECT IDPelanggan FROM sesi WHERE IDSesi='$id');");
							$d = mysqli_fetch_array($data);
							$s = mysqli_fetch_array($sesi);
							$p = mysqli_fetch_array($pelanggan);
							$idsesi_sekarang = $s['IDSesiSekarang'];
							?>
							<div class="box">
								<form method="post" class="form-horizontal" action="editsesiproses.php">
									<h4 style="margin-left: 10px;">Masukkan Data Konsol</h4>
									<input type="hidden" class="form-control" placeholder="ID Sesi" name="idsesi"
										value="<?php echo $idsesi_sekarang ?>">
									<div class="form-group has-feedback">
										<div class="col-sm-9" style="width: 930px;">
											<input type="hidden" class="form-control" name="idsesi"
												value="<?php echo $d['IDSesi']; ?>">
											<input type="hidden" class="form-control" name="idkonsol"
												value="<?php echo $d['IDKonsol']; ?>">
											<input type="hidden" class="form-control" name="idkonsol"
												value="<?php echo $d['IDPelanggan']; ?>">
										</div>
									</div>
									<div class="form-group has-feedback">
										<label for="judul" class="col-sm-2 control-label">Pelanggan</label>
										<div class="col-sm-9" style="width: 930px;">
											<input type="text" class="form-control" name="namapelanggan" disabled
												value="<?php echo $p['NamaPelanggan']; ?>">
										</div>
									</div>
									<div class="form-group has-feedback">
										<label for="judul" class="col-sm-2 control-label">Waktu</label>
										<div class="col-sm-9" style="width: 930px;">
											<div class="input-group date">
												<input type="text" class="form-control datetimepicker"
													placeholder="Tanggal dan Waktu" name="waktu" val
													value="<?php echo $d['Waktu']; ?>">
												<div class="input-group-addon">
													<span class="glyphicon glyphicon-calendar"></span>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group has-feedback">
										<label for="kode" class="col-sm-2 control-label">Waktu Bermain</label>
										<div class="col-sm-9" style="width: 930px;">
											<input type="text" class="form-control" placeholder="Waktu Bermain (Dalam Menit)"
												name="waktubermain" value="<?php echo $d['LamaBermain']; ?>">
										</div>
									</div>
									<div class="form-group has-feedback">
										<div class="col-sm-10 pull-right">
										<?php if (mysqli_num_rows($pelanggan) > 0) { ?>
											<button type="submit" class="btn btn-success" name="tambah">Simpan</button>
										<?php } else { ?>
											<button type="button" class="btn btn-success" disabled data-toggle="tooltip"
												title="Tidak ada pelanggan yang tersedia.">Simpan</button>
										<?php } ?>
											<a href="sesi.php" class="pull-left btn btn-primary" style="margin-left: 0px;">Batal</a>
										</div>
									</div>
									</br>
								</form>
							</div>
						</section>
					</div>
					<footer class="main-footer">
						<div class="pull-right hidden-xs">
							<b>Version</b> 1.0.0
						</div>
						<strong>Copyright &copy; 2018 <a href="#">IksanJR</a>.</strong>
					</footer>
				</div>


				<?php
		}
	} else {
		?>
	<div class="row">
		<div class="col-md-offset-4 col-md-4">
			<div class="panel panel-warning">
				<div class="panel-heading">
					Informasi
				</div>
				<div class="panel-body">
					<p>Maaf, Anda tidak berhak mengakses halaman ini secara langsung. Silahkan login terlebih dahulu.
					</p>
					<a class="btn btn-warning pull-right" role="button" href="../login.php">Login</a>
				</div>
			</div>
		</div>
	</div>
	<?php
	}
	?>

	<script src="../dist/js/jquery.min.js"></script>
	<script src="../dist/js/bootstrap.min.js"></script>
	<script src="../dist/js/sweetalert2.min.js"></script>
	<!-- script src="../dist/js/validasi.js"></script -->
	<!-- script src="../dist/js/jquery.dataTables.min.js"></script -->
	<!--script src="../dist/js/dataTables.bootstrap.min.js"></script -->
	<script src="../dist/js/jquery.slimscroll.min.js"></script>
	<script src="../dist/js/moment.js"></script>
	<script src="../dist/js/fastclick.js"></script>
	<script src="../dist/js/bootstrap-datetimepicker.min.js"></script>
	<script src="../dist/js/adminlte.min.js"></script>
	<script src="../dist/js/demo.js"></script>
	<script>
		$(document).ready(function () {
			$(".datetimepicker").datetimepicker({
				format: "YYYY-MM-DD HH:mm:ss" // Date and time format you want to use
				// You can customize additional options for the datetimepicker here
			});
		});
	</script>


</body>

</html>