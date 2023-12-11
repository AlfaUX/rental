<?php
$judul_browser = "Microphile";
include 'koneksi.php';
$currentPage = "Sesi";
$halaman = $currentPage;

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
                    <h1>Sesi</h1>
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
                                        <!-- Modal for adding a new session -->
                                        <div class="modal fade" id="tambahSesiModal" tabindex="-1" role="dialog"
                                            aria-labelledby="tambahSesiModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="hapusSesiModalLabel">Tambah Sesi</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <!-- The content will be loaded dynamically here -->
                                                    <div class="modal-body" id="modalContent">
                                                        <!-- Loading spinner or message can be shown here while the content is loading -->
                                                        <div class="text-center">
                                                            <i class="fa fa-spinner fa-spin"></i> Loading...
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="editSesiModal" tabindex="-1" role="dialog"
                                            aria-labelledby="editSesiModal">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form id="editForm" action="editsesiproses.php" method="post">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="hapusModal">Hapus Sesi</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="idsesi" id="editIDSesi">
                                                            <div class="form-group">
                                                                <label for="editKonsol">Nama Pelanggan :</label>
                                                                <input type="text" class="form-control" id="editPelanggan"
                                                                    name="Pelanggan" disabled>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="editTelevisi">Konsol :</label>
                                                                <input type="text" class="form-control" id="editKonsol"
                                                                    name="Pelanggan" disabled>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="waktubermain" class="control-label">Waktu
                                                                    Bermain (Tambah Waktu) : </label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Waktu Bermain (Dalam Menit)" name="waktubermain"
                                                                    id="editWaktubermain">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Hapus Modal -->
                                        <div class="modal fade" id="hapusSesiModal" tabindex="-1" role="dialog"
                                            aria-labelledby="hapusSesiModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <form id="hapusForm" action="hapussesiproses.php" method="post">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="hapusModal">Hapus Sesi</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="idsesi" id="hapusIDSesi">
                                                            <div class="form-group">
                                                                <label for="editKonsol">Nama Pelanggan:</label>
                                                                <input type="text" class="form-control" id="hapusPelanggan"
                                                                    name="Pelanggan" disabled>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="editTelevisi">Konsol:</label>
                                                                <input type="text" class="form-control" id="hapusKonsol"
                                                                    name="Konsol" disabled>
                                                            </div>
                                                            <div class="alert alert-danger has-feedback">
                                                                <p>Perhatian!</p>
                                                                <p>Data yang sudah dihapus tidak dapat dikembalikan kembali.</p>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
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
                                                            <th>Komputer</th>
                                                            <!--th>Televisi</th-->
                                                            <th>Pengguna</th>
                                                            <th>Waktu Mulai</th>
                                                            <th>Lama Bermain</th>
                                                            <th>Bayar</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        include 'koneksi.php';
                                                        $no = 1;
                                                        $data = mysqli_query($koneksi, "SELECT sesi.IDSesi, sesi.nambah, datakonsol.Status, datakonsol.IDKonsol, datakonsol.NamaKonsol, datakonsol.Televisi, datakonsol.harga, pelanggan.NamaPelanggan , sesi.Waktu , sesi.LamaBermain, sesi.LamaBermain*(datakonsol.harga/60) AS hargabayar FROM sesi RIGHT JOIN datakonsol ON sesi.IDKonsol = datakonsol.IDKonsol LEFT JOIN pelanggan ON sesi.IDPelanggan = pelanggan.IDPelanggan;");
                                                        while ($d = mysqli_fetch_array($data)) {
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                <?php echo $no++; ?>
                                                                </td>
                                                                <td>
                                                                <?php echo $d['NamaKonsol']; ?>
                                                                <?php if ($d['Status'] == 1): ?>
                                                                    <span class="label label-danger">Rusak</span>
                                                                <?php endif; ?>
                                                                <td>
                                                                    <?php
                                                                    if ($d['NamaPelanggan'] == null) {
                                                                        echo "-";
                                                                    } else {
                                                                        echo $d['NamaPelanggan'];

                                                                        // Mengambil jam dari Waktu dan menambahkan LamaBermain dalam menit
                                                                        $waktuSesi = strtotime($d['Waktu']);
                                                                        $jamSesi = date('H', $waktuSesi);
                                                                        $menitSesi = date('i', $waktuSesi);
                                                                        $lamaBermainMenit = $d['LamaBermain'];

                                                                        // Menghitung total menit bermain
                                                                        $totalMenit = $menitSesi + $lamaBermainMenit;

                                                                        // Menghitung total jam
                                                                        $jamSekarang = date('H');
                                                                        $totalJam = $jamSesi + floor($totalMenit / 60);
                                                                        // Cek apakah sesi TAMBAH
                                                                        if ($d['nambah'] == 1 && $jamSekarang > $totalJam) {
                                                                            echo ' <span class="label label-danger">HABIS</span>';
                                                                        } elseif ($d['nambah'] == 1) {
                                                                            echo ' <span class="label label-warning">TAMBAH</span>';
                                                                        } elseif ($jamSekarang > $totalJam) {
                                                                            echo ' <span class="label label-danger">HABIS</span>';
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    $waktu = date('Y-m-d H:i');
                                                                    $bila = $d['Waktu'];

                                                                    $date = substr($waktu, 0, 10);
                                                                    $formattedDate = date('d-m-Y', strtotime($date));
                                                                    $dinoiki = $formattedDate;

                                                                    $dante = substr($bila, 0, 10);
                                                                    $formattedDante = date('d-m-Y', strtotime($dante));
                                                                    $dinoiku = $formattedDante;

                                                                    $time = substr($bila, 11);
                                                                    $formattedTime = date('H:i', strtotime($time));
                                                                    if ($d['Waktu'] == null) {
                                                                        echo "-";
                                                                    } else {
                                                                        if ($dinoiku == $dinoiki) {
                                                                            echo $formattedTime;
                                                                        } else {
                                                                            echo $d['Waktu'];
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    if ($d['LamaBermain'] == null) {
                                                                        echo "-";
                                                                    } elseif ($d['LamaBermain'] >= 1440) {
                                                                        $days = floor($d['LamaBermain'] / 1440);
                                                                        $hours = floor(($d['LamaBermain'] % 1440) / 60);
                                                                        $minutes = $d['LamaBermain'] % 60;
                                                                        echo $days . " Hari";
                                                                        if ($hours > 0) {
                                                                            echo " " . $hours . " Jam";
                                                                        }
                                                                        if ($minutes > 0) {
                                                                            echo " " . $minutes . " Menit";
                                                                        }
                                                                    } elseif ($d['LamaBermain'] >= 60) {
                                                                        $hours = floor($d['LamaBermain'] / 60);
                                                                        $minutes = $d['LamaBermain'] % 60;
                                                                        echo $hours . " Jam";
                                                                        if ($minutes > 0) {
                                                                            echo " " . $minutes . " Menit";
                                                                        }
                                                                    } else {
                                                                        echo $d['LamaBermain'] . " Menit";
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    if ($d['hargabayar'] !== null) {
                                                                        // Format  hargabayar in Indonesian Rupiah format
                                                                        $formatted_hargabayar = 'Rp. ' . number_format($d['hargabayar'], 0, ',', '.');

                                                                        echo $formatted_hargabayar;
                                                                    } else {
                                                                        echo "-";
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                <?php if ($d['Status'] == 1): ?>
                                                                    <a class="col-xs-offset-1 btn btn-success glyphicon glyphicon-remove"
                                                                        disabled title="Konsol ini rusak"></a>
                                                                <?php else: ?>
                                                                <?php if ($d['IDSesi'] == null): ?>
                                                                    <a class="col-xs-offset-1 btn btn-success btn-tambah-sesi glyphicon glyphicon-plus"
                                                                        data-toggle="modal" data-target="#tambahSesiModal"
                                                                        data-idkonsol="<?php echo $d['IDKonsol']; ?>"></a>
                                                                <?php else: ?>
                                                                <?php if ($d['nambah'] == 1 && $jamSekarang <= $totalJam): ?>
                                                                    <a class="col-xs-offset-1 btn btn-success glyphicon glyphicon-remove"
                                                                        disabled title="Dilarang Nambah Lagi"></a>
                                                                    <a class="col-xs-offset-1 btn btn-danger btn-hapus-sesi glyphicon glyphicon-trash"
                                                                        data-toggle="modal" data-target="#hapusSesiModal"
                                                                        data-idsesi="<?php echo $d['IDSesi']; ?>"
                                                                        data-pelanggan="<?php echo $d['NamaPelanggan']; ?>"
                                                                        data-konsol="<?php echo $d['NamaKonsol']; ?>"></a>
                                                                <?php else: ?>
                                                                <?php if ($jamSekarang > $totalJam && $d['nambah'] == 1): ?>
                                                                    <a class="col-xs-offset-1 btn btn-success glyphicon glyphicon-time"
                                                                        disabled title="Waktu Sudah Habis dan Dilarang Nambah"></a>
                                                                    <a class="col-xs-offset-1 btn btn-danger btn-hapus-sesi glyphicon glyphicon-trash"
                                                                        data-toggle="modal" data-target="#hapusSesiModal"
                                                                        data-idsesi="<?php echo $d['IDSesi']; ?>"
                                                                        data-pelanggan="<?php echo $d['NamaPelanggan']; ?>"
                                                                        data-konsol="<?php echo $d['NamaKonsol']; ?>"></a>
                                                                <?php elseif ($jamSekarang > $totalJam): ?>
                                                                    <a class="col-xs-offset-1 btn btn-success glyphicon glyphicon-time"
                                                                        disabled title="Waktu Sudah Habis"></a>
                                                                    <a class="col-xs-offset-1 btn btn-danger btn-hapus-sesi glyphicon glyphicon-trash"
                                                                        data-toggle="modal" data-target="#hapusSesiModal"
                                                                        data-idsesi="<?php echo $d['IDSesi']; ?>"
                                                                        data-pelanggan="<?php echo $d['NamaPelanggan']; ?>"
                                                                        data-konsol="<?php echo $d['NamaKonsol']; ?>"></a>
                                                                <?php else: ?>
                                                                    <a class="col-xs-offset-1 btn btn-success btn-edit-sesi glyphicon glyphicon-pencil"
                                                                        data-toggle="modal" data-target="#editSesiModal"
                                                                        data-idsesi="<?php echo $d['IDSesi']; ?>"
                                                                        data-pelanggan="<?php echo $d['NamaPelanggan']; ?>"
                                                                        data-konsol="<?php echo $d['NamaKonsol']; ?>"></a>
                                                                    <a class="col-xs-offset-1 btn btn-danger btn-hapus-sesi glyphicon glyphicon-trash"
                                                                        data-toggle="modal" data-target="#hapusSesiModal"
                                                                        data-idsesi="<?php echo $d['IDSesi']; ?>"
                                                                        data-pelanggan="<?php echo $d['NamaPelanggan']; ?>"
                                                                        data-konsol="<?php echo $d['NamaKonsol']; ?>"></a>
                                                                <?php endif; ?>
                                                                <?php endif; ?>
                                                                <?php endif; ?>
                                                                <?php endif; ?>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <p style="color: red; font-weight: bolder;">&ast; Halaman ini memuat setiap 1 menit
                                                sekali!</p>
                                        </div>
                                        <a href="hancurkansemuanya.php" type="button"
                                            class="btn btn-warning glyphicon glyphicon-trash" title="Hapus Semua Sesi (Hati-Hati)">
                                        </a>
                                        <!-- /.box-body -->
                                    </div>
                                </div>
                            </div>
                        </div>
                </section>
            </div>
            <?php
            include '../bagian/kopirek.php';
    }
} else {
    include '../bagian/haramakses.php';
}
include '../bagian/sekrip.php';
?>
<script>
    $(document).ready(function () {
        $('#tambahSesiModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var idkonsol = button.data('idkonsol'); // Extract ID Konsol from data attribute
            var modal = $(this);
            modal.find('.modal-body').load('tambahsesineo.php?idkonsol=' + idkonsol); // Load the content from get_sesi_data.php
        });

        // Edit button click event
        $(document).on('click', '.btn-edit-sesi', function () {
            var idsesi = $(this).data('idsesi');
            var pelanggan = $(this).data('pelanggan');
            var konsol = $(this).data('konsol');

            // Set modal data
            $('#editIDSesi').val(idsesi);
            $('#editPelanggan').val(pelanggan);
            $('#editKonsol').val(konsol);

            // Show the modal
            $('#editSesiModal').modal('show');
        });

        // Delete button click event
        $(document).on('click', '.btn-hapus-sesi', function () {
            var idsesi = $(this).data('idsesi');
            var pelanggan = $(this).data('pelanggan');
            var konsol = $(this).data('konsol');

            // Set modal data
            $('#hapusIDSesi').val(idsesi);
            $('#hapusPelanggan').val(pelanggan);
            $('#hapusKonsol').val(konsol);

            // Show the modal
            $('#hapusSesiModal').modal('show');
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
            showBootstrapAlert('success', 'SUKSES', `Berhasil Menghapus Semua Sesi`);
        } else if (showAlert === "5") {
            showBootstrapAlert('danger', 'GAGAL', `Tidak Ada Sesi yang Dihapus`);
        } else if (showAlert === "6") {
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

        setTimeout(function () {
            alertBox.style.display = 'none';
        }, 3000);
    }

    function getUrlParam(name) {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        return urlParams.get(name);
    }
    function reloadPage() {
        location.reload();
    }

    setInterval(reloadPage, 60000);
</script>
<?php include '../bagian/sekriporientasi.php'; ?>