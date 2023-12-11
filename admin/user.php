<?php
$judul_browser = "Microphile";
$currentPage = "Karyawan";
$halaman = $currentPage;

include 'koneksi.php';

session_start();


include '../bagian/kepala.php';

if (isset($_SESSION['status'])) {
	if ($_SESSION['status'] != "login") {
		include '../bagian/haramakses.php';
	} else if ($_SESSION['status'] == "login") {

		include '../bagian/atasbar.php';
		include '../bagian/navbar.php'; ?>

					<div class="content-wrapper">
						<section class="content-header">
							<h1>Data Karyawan</h1>
							<ol class="breadcrumb">
								<li><a href="index.php"><i class="fa fa-dashboard"></i> Beranda</a></li>
								<li class="active">Data Karyawan</li>
							</ol>
						</section>
						<section class="content">
							<div class="alert alert-success alert-dismissible" role="alert" id="alertBox" style="display:none;">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<strong id="alertTitle"></strong> <span id="alertMessage"></span>
							</div>
							<div class="container-fluid">
								<div class="row">
									<div class="col-xs-12">
										<div class="box">
											<div class="box-header">
												<button type="button" class="btn btn-primary" data-toggle="modal"
													data-target="#tambahModal">
													<b>+</b> Tambah Karyawan
												</button>
												<!-- Modal Tambah Data Konsol -->
												<div class="modal" id="tambahModal">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<h4 class="modal-title">Tambah Data Karyawan</h4>
																<button type="button" class="close"
																	data-dismiss="modal">&times;</button>
															</div>
															<div class="modal-body">
																<form action="tambahuserproses.php" method="post">
																	<div class="form-group">
																		<label for="konsol">Nama Karyawan (Username):</label>
																		<input type="text" class="form-control"
																			placeholder="Nama Karyawan (Username)" name="username"
																			maxlength="16" minlength="6" required
																			title="Masukkan Username minimal 6 huruf dan maksimal 16 huruf">
																	</div>
																	<div class="form-group">
																		<label for="televisi">Password :</label>
																		<input type="password" class="form-control"
																			placeholder="Password" name="password" maxlength="16"
																			minlength="6" required
																			title="Masukkan Password minimal 6 huruf dan maksimal 16 huruf">
																	</div>
																	<div class="form-group">
																		<label for="tambahPangkat">Pangkat</label>
																		<select class="form-control" name="Pangkat" id="pangkat">
																			<!-- Ubah "pangkat" menjadi "Pangkat" -->
																			<option value="3">Admin</option>
																			<option value="2">Operator</option>
																		</select>
																	</div>
																	<div class="modal-footer">
																		<button type="button" class="btn btn-secondary"
																			data-dismiss="modal">Close</button>
																		<button type="submit"
																			class="btn btn-primary">Submit</button>
																	</div>
																</form>

															</div>
														</div>
													</div>
												</div>
												<!-- Akhir Modal Tamba Data Konsol -->

												<!-- Edit Modal -->
												<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog"
													aria-labelledby="editModalLabel">
													<div class="modal-dialog" role="document">
														<div class="modal-content">
															<div class="modal-header">
																<h5 class="modal-title" id="editModalLabel">Edit User</h5>
																<button type="button" class="close" data-dismiss="modal"
																	aria-label="Close">
																	<span aria-hidden="true">&times;</span>
																</button>
															</div>
															<div class="modal-body">
																<form action="edituserproses.php" method="post">
																	<div class="form-group">
																		<label for="editUsername">Nama Karyawan (Username):</label>
																		<input type="text" class="form-control"
																			placeholder="Nama Karyawan (Username)" id="editUsername"
																			name="username">
																	</div>
																	<div class="form-group">
																		<label for="editPassword">Password :</label>
																		<input type="password"
																			class="form-control col-md-4 pull-left"
																			placeholder="Password" id="editPassword"
																			name="password">
																	</div>
																	<div class="form-group">
																		<label for="editAkses">Pangkat</label>
																		<select class="form-control" name="pangkat" id="editAkses">
																			<option value="3">Admin</option>
																			<option value="2">Operator</option>
																		</select>
																	</div>
																	<input type="hidden" name="id_user" id="editItemId" value="">
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-secondary"
																	data-dismiss="modal">Close</button>
																<button type="submit" class="btn btn-primary">Save
																	changes</button>
																<button type="button"
																	class="btn btn-warning password-toggle-btn pull-right"
																	onclick="togglePasswordVisibility()">Litah Password
																</button>
															</div>
															</form>
														</div>
													</div>
												</div>
											</div>

											<!-- Hapus Modal -->
											<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog"
												aria-labelledby="hapusModalLabel">
												<div class="modal-dialog" role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="hapusModalLabel">Hapus User</h5>
															<button type="button" class="close" data-dismiss="modal"
																aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<form action="hapususerproses.php" method="post">
																<div class="form-group">
																	<label for="hapusUsername">Nama Karyawan (Username):</label>
																	<input type="text" class="form-control"
																		placeholder="Nama Karyawan (Username)" id="hapusUsername"
																		name="username" disabled>
																</div>
																<div class="form-group">
																	<label for="hapusPassword">Password :</label>
																	<input type="password" class="form-control"
																		placeholder="Password" id="hapusPassword" name="password"
																		disabled>
																</div>
																<div class="form-group">
																	<label for="hapusAkses">Pangkat</label>
																	<input type="text" class="form-control" id="hapusAkses"
																		name="pangkat" disabled>
																</div>
																<input type="hidden" name="id_user" id="hapusItemId" value="">
																<div class="alert alert-danger has-feedback">
																	<p>Perhatian!</p>
																	<p>Data yang sudah dihapus tidak dapat dikembalikan kembali.
																	</p>
																</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary"
																data-dismiss="modal">Close</button>
															<button type="submit" class="btn btn-danger">Delete</button>
														</div>
														</form>
													</div>
												</div>
											</div>

											<div class="box-body">
												<div class="table-responsive">
													<table id="example2" class="table table-bordered table-hover">
														<thead>
															<tr>
																<th>No</th>
																<th>Username</th>
																<th>Password</th>
																<th>Level</th>
																<th>Edit</th>
															</tr>
														</thead>
														<tbody>
															<?php
															include 'koneksi.php';
															$no = 1;
															$data = mysqli_query($koneksi, "select * from user");
															while ($d = mysqli_fetch_array($data)) {
																?>
																<tr>
																	<td>
																	<?php echo $no++; ?>
																	</td>
																	<td>
																	<?php echo $d['username']; ?>
																	</td>
																	<td>
																		<?php
																		$passwordLength = strlen($d['password']);
																		echo str_repeat('*', $passwordLength);
																		?>
																	</td>
																	<td>
																		<?php
																		if ($d['hak_akses'] == 1) {
																			echo "Anggota Biasa";
																		} elseif ($d['hak_akses'] == 2) {
																			echo "Operator";
																		} elseif ($d['hak_akses'] == 3) {
																			echo "Admin";
																		} else {
																			echo "Tidak Ada Akses";
																		}
																		?>
																	</td>
																	<td><button
																			class="col-xs-offset-1 btn btn-success 
																			btn-edit glyphicon glyphicon-pencil"
																			data-toggle="modal"
																			data-target="#modal<?php echo $d['IDUser']; ?>"
																			data-id="<?php echo $d['IDUser']; ?>"
																			data-username="<?php echo $d['username']; ?>"
																			data-password="<?php echo $d['password']; ?>"
																			data-akses="<?php echo $d['hak_akses']; ?>">
																		</button>
																		<button
																			class="col-xs-offset-1 btn btn-danger 
																			btn-delete glyphicon glyphicon-trash"
																			data-id="<?php echo $d['IDUser']; ?>"
																			data-username="<?php echo $d['username']; ?>"
																			data-password="<?php echo $d['password']; ?>"
																			data-akses="<?php echo $d['hak_akses']; ?>">
																		</button>
																	</td>
																</tr>
																<?php
															}
															?>
														</tbody>
													</table>
												</div>
											</div>
											<!-- /.box-body -->
										</div>
									</div>
								</div>
							</div>
						</section>
					</div>
				<?php include '../bagian/kopirek.php'; ?>
				</div>


				<?php
		}
	} else {
		include '../bagian/haramakses.php';
	}
	include '../bagian/sekrip.php'; ?>
	<script>
		$(document).ready(function () {
			$(document).on('click', '.btn-edit', function () {
				var id = $(this).data('id');
				var username = $(this).data('username');
				var password = $(this).data('password');
				var akses = $(this).data('akses');

				$('#editItemId').val(id);
				$('#editUsername').val(username);
				$('#editPassword').val(password);
				$('#editAkses').val(akses);

				$('#modalEdit').modal('show');
			});

			$(document).on('click', '.btn-delete', function () {
				var id = $(this).data('id');
				var username = $(this).data('username');
				var password = $(this).data('password');
				var akses = $(this).data('akses');

				$('#hapusItemId').val(id);
				$('#hapusUsername').val(username);
				$('#hapusPassword').val(password);
				if (akses == 1) {
					$('#hapusAkses').val('Anggota Biasa');
				} else if (akses == 2) {
					$('#hapusAkses').val('Operator');
				} else if (akses == 3) {
					$('#hapusAkses').val('Admin');
				} else {
					$('#hapusAkses').val('Tidak Ada Akses');
				}

				$('#modalHapus').modal('show');
			});
		});
		function togglePasswordVisibility() {
			var passwordInput = document.getElementById('editPassword');

			if (passwordInput.type === 'password') {
				passwordInput.type = 'text';
			} else {
				passwordInput.type = 'password';
			}
		}
		document.addEventListener("DOMContentLoaded", function () {
			const showAlert = getUrlParam("showAlert");
			const namaPelanggan = getUrlParam("namaPelanggan");

			if (showAlert === "1") {
				showBootstrapAlert('success', 'SUKSES', `Berhasil Menambahkan User ${namaPelanggan}`);
			} else if (showAlert === "2") {
				showBootstrapAlert('success', 'SUKSES', `Berhasil Mengedit User ${namaPelanggan}`);
			} else if (showAlert === "3") {
				showBootstrapAlert('success', 'SUKSES', `Berhasil Menghapus User ${namaPelanggan}`);
			} else if (showAlert === "6") {
				showBootstrapAlert('danger', 'GAGAL', `Username ${namaPelanggan} Sudah Ada`);
			}

			if (showAlert) {
				window.history.replaceState(null, null, window.location.pathname);
			}
		});
		function showBootstrapAlert(type, title, message) {
			const alertBox = document.getElementById('alertBox');
			const alertTitle = document.getElementById('alertTitle');
			const alertMessage = document.getElementById('alertMessage');

			alertBox.className = `alert alert-${type} alert-dismissible`;
			alertTitle.innerText = title;
			alertMessage.innerText = message;

			alertBox.style.display = 'block';

			setTimeout(function () {
				alertBox.style.display = 'none';
			}, 3000);
		}
		function getUrlParam(name) {
			const queryString = window.location.search;
			const urlParams = new URLSearchParams(queryString);
			return urlParams.get(name);
		}
	</script>
</body>

</html>