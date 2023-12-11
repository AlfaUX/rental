<?php
$judul_browser = "Microphile";
include 'koneksi.php';
$currentPage = "Konsol";
$halaman = $currentPage;
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
					<h1>Data Komputer</h1>
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
					<div class="row">
						<div class="col-xs-12">
							<div class="box">
								<div class="box-header">
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">
										<b>+</b> Tambah Komputer
									</button>
									<!--a href="tambahkonsol.php" class="btn btn-primary" role="button"><b>+</b> Tambah
												Konsol</a-->
									<!-- Modal Tambah Data Konsol -->
									<div class="modal" id="tambahModal">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title">Tambah Data Komputer</h4>
													<button type="button" class="close" data-dismiss="modal">&times;</button>
												</div>
												<div class="modal-body">
													<form action="bukuadm.php" method="post">
														<div class="form-group">
															<label for="konsol">Nama Komputer:</label>
															<input type="text" class="form-control" placeholder="Nama Konsol"
																name="konsol">
														</div>
														<div class="form-group">
															<label for="televisi">Jenis Monitor :</label>
															<input type="text" class="form-control" placeholder="Televisi"
																name="televisi">
														</div>
														<div class="form-group">
															<label for="harga">Harga Per Jam :</label>
															<input type="text" class="form-control" placeholder="Harga Per Jam"
																name="harga">
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
												<form id="editForm" action="proseskonsoladm.php" method="post">
													<div class="modal-header">
														<h4 class="modal-title" id="editModal">Edit Data Komputer</h4>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<input type="hidden" name="IDKonsol" id="editItemId">
														<div class="form-group">
															<label for="editKonsol">Nama Komputer:</label>
															<input type="text" class="form-control" id="editKonsol"
																name="NamaKonsol">
														</div>
														<div class="form-group">
															<label for="editTelevisi">Jenis Monitor:</label>
															<input type="text" class="form-control" id="editTelevisi"
																name="Televisi">
														</div>
														<div class="form-group">
															<label for="editStatus">Status</label>
															<select class="form-control" name="Status" id="editSatus">
																<option value="0">Normal</option>
																<option value="1">Rusak</option>
															</select>
														</div>
														<div class="form-group">
															<label for="editTelevisi">Harga:</label>
															<input type="text" class="form-control" id="editHarga"
																name="Harga">
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
												<form id="hapusForm" action="proseshapus.php" method="post">
													<div class="modal-header">
														<h4 class="modal-title" id="hapusModal">Hapus Komputer</h4>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<input type="hidden" name="IDKonsol" id="hapusItemId">
														<div class="form-group">
															<label for="editKonsol">Nama Komputer:</label>
															<input type="text" class="form-control" id="hapusKonsol"
																name="NamaKonsol" disabled>
														</div>
														<div class="form-group">
															<label for="editTelevisi">Jenis Monitor:</label>
															<input type="text" class="form-control" id="hapusTelevisi"
																name="Televisi" disabled>
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
													<th>Komputer</th>
													<th>Monitor</th>
													<th>Harga (Per Jam)</th>
													<th>Status</th>
													<th>Edit</th>
												</tr>
											</thead>
											<tbody>
												<?php
												include 'koneksi.php';
												$no = 1;
												$data = mysqli_query($koneksi, "select * from datakonsol");
												while ($d = mysqli_fetch_array($data)) {
													?>
													<tr>
														<td>
														<?php echo $no++; ?>
														</td>
														<td>
														<?php echo $d['NamaKonsol']; ?>
														</td>
														<td>
														<?php echo $d['Televisi']; ?>
														</td>
														<td>
															<?php
															$harga = $d['harga'];
															$formatted_harga = 'Rp. ' . number_format($harga, 0, ',', '.');
															echo $formatted_harga;
															?>

														</td>
														<td>
														<?php echo ($d['Status'] == 1) ? "Rusak" : "Normal"; ?>
														</td>
														<!--td>
																	<a class="col-xs-offset-1 btn btn-success btn-edit glyphicon glyphicon-pencil"
																		href="editkonsol.php?idkonsol=<?php echo $d['IDKonsol']; ?>"></a>
																	<a class="btn btn-danger glyphicon glyphicon-trash"
																		href="hapus.php?idkonsol=<?php echo $d['IDKonsol']; ?>"></a>
																</td-->
														<td><button
																class="col-xs-offset-1 btn btn-success btn-edit glyphicon glyphicon-pencil"
																data-toggle="modal" data-target="#modal<?php echo $d['IDKonsol']; ?>"
																data-id="<?php echo $d['IDKonsol']; ?>"
																data-nama="<?php echo $d['NamaKonsol']; ?>"
																data-televisi="<?php echo $d['Televisi']; ?>"
																data-harga="<?php echo $d['harga']; ?>"
																data-status="<?php echo $d['Status']; ?>">
															</button>
															<button
																class="col-xs-offset-1 btn btn-danger btn-delete glyphicon glyphicon-trash"
																data-id="<?php echo $d['IDKonsol']; ?>"
																data-nama="<?php echo $d['NamaKonsol']; ?>"
																data-televisi="<?php echo $d['Televisi']; ?>">
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

include '../bagian/sekrip.php';
?>
<script>
	$(document).ready(function () {
		// Edit button click event
		$(document).on('click', '.btn-edit', function () {
			var id = $(this).data('id');
			var nama = $(this).data('nama');
			var televisi = $(this).data('televisi');
			var harga = $(this).data('harga');

			$('#editItemId').val(id);
			$('#editKonsol').val(nama);
			$('#editTelevisi').val(televisi);
			$('#editHarga').val(harga);

			$('#modalEdit').modal('show');
		});

		// Delete button click event
		$(document).on('click', '.btn-delete', function () {
			var id = $(this).data('id');
			var nama = $(this).data('nama');
			var televisi = $(this).data('televisi');

			$('#hapusItemId').val(id);
			$('#hapusKonsol').val(nama);
			$('#hapusTelevisi').val(televisi);

			$('#hapusForm').modal('show');
		});
	});
	document.addEventListener("DOMContentLoaded", function () {
		const showAlert = getUrlParam("showAlert");
		const namaPelanggan = getUrlParam("namaPelanggan");

		if (showAlert === "1") {
			showBootstrapAlert('success', 'SUKSES', `Berhasil Menambahkan Konsol ${namaPelanggan}`);
		} else if (showAlert === "2") {
			showBootstrapAlert('success', 'SUKSES', `Berhasil Mengedit Konsol ${namaPelanggan}`);
		} else if (showAlert === "3") {
			showBootstrapAlert('success', 'SUKSES', `Berhasil Menghapus Konsol ${namaPelanggan}`);
		} else if (showAlert === "4") {
			showBootstrapAlert('success', 'Selamat Datang', ` ${namaPelanggan}`);
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