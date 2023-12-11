<?php
$accessLevel = $_SESSION['hak_akses'];

$imagePaths = [
	'Pemilik' => '../dist/img/pemilik.png',
	'Operator' => '../dist/img/operator.png',
	'Tamu' => '../dist/img/pelanggan.png'
];

$defaultImagePath = '../dist/img/YD.jpg';
?>

<div class="wrapper">
	<header class="main-header">
		<a href="#" class="logo">
			<span class="logo-lg">MICROPHILE</span>
		</a>
		<nav class="navbar navbar-static-top">
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<li class="dropdown user user-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<img src="<?php echo isset($imagePaths[$accessLevel]) ? $imagePaths[$accessLevel] : $defaultImagePath; ?>"
								class="user-image" alt="User Image">
							<span class="hidden-xs">
								<?php echo ucwords($_SESSION['user']); ?>
							</span>
						</a>
						<ul class="dropdown-menu">
							<li class="user-header">
								<img src="<?php echo isset($imagePaths[$accessLevel]) ? $imagePaths[$accessLevel] : $defaultImagePath; ?>"
									class="img-circle" alt="User Image">
								<p>
									<?php echo $_SESSION['user']; ?>
								</p>
								<p><small>
										<?php echo $_SESSION['hak_akses']; ?>
									</small></p>
							</li>
							<li class="user-footer">
								<div class="pull-right">
									<a href="logout.php" class="btn btn-default btn-flat">Keluar</a>
								</div>
							</li>
						</ul>
					</li>