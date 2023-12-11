<?php
$judul_browser = "Administrator - Aplikasi Rental Konsol";
$currentPage = "Pelanggan";
$halaman = $currentPage;
include 'koneksi.php';
session_start();

include '../bagian/kepala.php';

if (isset($_SESSION['status'])) {
	if ($_SESSION['status'] != "login") {
		include '../bagian/haramakses.php';
	} else if ($_SESSION['status'] == "login") {
		include '../bagian/atasbar.php';
		include '../bagian/navbar.php';
		?>
			<div class="content-wrapper">
				<section class="content-header">
					<h1>Data Pelanggan</h1>
					<ol class="breadcrumb">
						<li><a href="index.php"><i class="fa fa-dashboard"></i> Beranda</a></li>
						<li class="active">View Mode</li>
					</ol>
				</section>
				<section class="content">
					<div class="alert alert-success alert-dismissible" role="alert" id="alertBox" style="display:none;">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
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
											<b>+</b> Tambah Pelanggan
										</button>
										<!-- Modal Tambah Data Konsol -->
										<div class="modal" id="tambahModal">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h4 class="modal-title">Tambah Data Pelanggan</h4>
														<button type="button" class="close" data-dismiss="modal">&times;</button>
													</div>
													<div class="modal-body">
														<form action="tambahpelangganproses.php" method="post">
															<div class="form-group">
																<label for="konsol">Nama Pelanggan:</label>
																<input type="text" class="form-control" placeholder="Nama Pelanggan"
																	name="pelanggan">
															</div>
															<div class="form-group">
																<label for="televisi">Domisili :</label>
																<input type="text" class="form-control" placeholder="Domisili"
																	name="domisili">
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-secondary"
																	data-dismiss="modal">Close</button>
																<button type="submit" class="btn btn-primary">Submit</button>
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
													<form id="editForm" action="pelangganeditproses.php" method="post">
														<div class="modal-header">
															<h4 class="modal-title" id="editModal">Edit Data Pelanggan</h4>
															<button type="button" class="close" data-dismiss="modal"
																aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<input type="hidden" name="IDPelanggan" id="editItemId">
															<div class="form-group">
																<label for="editKonsol">Nama Pelanggan :</label>
																<input type="text" class="form-control" id="editNama"
																	name="NamaPelanggan">
															</div>
															<div class="form-group">
																<label for="editTelevisi">Domisili :</label>
																<input type="text" class="form-control" id="editDomisili"
																	name="Domisili">
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-default"
																data-dismiss="modal">Close</button>
															<button type="submit" class="btn btn-primary">Save changes</button>
														</div>
													</form>
												</div>
											</div>
										</div>

										<!-- Hapus Modal -->
										<div class="modal fade" id="hapusForm" tabindex="-1" role="dialog"
											aria-labelledby="editModalLabel">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<form id="hapusForm" action="hapuspelangganproses.php" method="post">
														<div class="modal-header">
															<h4 class="modal-title" id="hapusModal">Hapus Pelanggan</h4>
															<button type="button" class="close" data-dismiss="modal"
																aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<input type="hidden" name="IDPelanggan" id="hapusItemId">
															<div class="form-group">
																<label for="editKonsol">Nama Pelanggan :</label>
																<input type="text" class="form-control" id="hapusNama"
																	name="NamaPelanggan" disabled>
															</div>
															<div class="form-group">
																<label for="editTelevisi">Domisili :</label>
																<input type="text" class="form-control" id="hapusDomisili"
																	name="Domisili" disabled>
															</div>
															<div class="alert alert-danger has-feedback">
																<p>Perhatian!</p>
																<p>Data yang sudah dihapus tidak dapat dikembalikan kembali.</p>
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-default"
																data-dismiss="modal">Close</button>
															<button type="submit" class="btn btn-primary">Save changes</button>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
									<div class="box-body">
										<div class="table-responsive">
											<table id="example2" class="table table-bordered table-hover">
												<thead>
													<tr>
														<th>No</th>
														<th>Nama Pelanggan</th>
														<th>Domisili</th>
														<th>Status</th>
														<th>Edit</th>
													</tr>
												</thead>
												<tbody>
													<?php
													include 'koneksi.php';
													$no = 1;
													$data = mysqli_query($koneksi, "SELECT * FROM sesi RIGHT JOIN pelanggan ON sesi.IDPelanggan = pelanggan.IDPelanggan;");
													while ($d = mysqli_fetch_array($data)) {
														?>
														<tr>
															<td>
															<?php echo $no++; ?>
															</td>
															<td>
															<?php echo $d['NamaPelanggan']; ?>
															</td>
															<td>
															<?php echo $d['Domisili']; ?>
															</td>
															<td>
															<?php echo ($d['IDSesi'] == null) ? "Tidak bermain" : "Bermain"; ?>
															</td>
															<td><button
																	class="col-xs-offset-1 btn btn-success btn-edit glyphicon glyphicon-pencil"
																	data-toggle="modal"
																	data-target="#modal<?php echo $d['IDPelanggan']; ?>"
																	data-id="<?php echo $d['IDPelanggan']; ?>"
																	data-nama="<?php echo $d['NamaPelanggan']; ?>"
																	data-domisili="<?php echo $d['Domisili']; ?>">
																</button>
																<button
																	class="col-xs-offset-1 btn btn-danger btn-delete glyphicon glyphicon-trash"
																	data-id="<?php echo $d['IDPelanggan']; ?>"
																	data-nama="<?php echo $d['NamaPelanggan']; ?>"
																	data-domisili="<?php echo $d['Domisili']; ?>">
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
		// Edit button click event
		$(document).on('click', '.btn-edit', function () {
			var id = $(this).data('id');
			var nama = $(this).data('nama');
			var domisili = $(this).data('domisili');

			$('#editItemId').val(id);
			$('#editNama').val(nama);
			$('#editDomisili').val(domisili);

			$('#modalEdit').modal('show');
		});

		// Delete button click event
		$(document).on('click', '.btn-delete', function () {
			var id = $(this).data('id');
			var nama = $(this).data('nama');
			var domisili = $(this).data('domisili');

			$('#hapusItemId').val(id);
			$('#hapusNama').val(nama);
			$('#hapusDomisili').val(domisili);

			$('#hapusForm').modal('show');
		});
	});
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

		// Hide the alert after 3 seconds (adjust the duration as needed)
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
<?php include '../bagian/sekriporientasi.php'; ?>