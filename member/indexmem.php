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
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        include 'koneksi.php';
                                                        $no = 1;
                                                        $data = mysqli_query($koneksi, "SELECT sesi.IDSesi, sesi.nambah, datakonsol.Status, datakonsol.IDKonsol, 
                                                        datakonsol.NamaKonsol, datakonsol.Televisi, datakonsol.harga, pelanggan.NamaPelanggan , sesi.Waktu , 
                                                        sesi.LamaBermain, sesi.LamaBermain*(datakonsol.harga/60) AS hargabayar FROM sesi 
                                                        RIGHT JOIN datakonsol ON sesi.IDKonsol = datakonsol.IDKonsol 
                                                        LEFT JOIN pelanggan ON sesi.IDPelanggan = pelanggan.IDPelanggan;");
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
    document.addEventListener("DOMContentLoaded", function () {
        const showAlert = getUrlParam("showAlert");
        const namaPelanggan = getUrlParam("namaPelanggan");

        if (showAlert === "4") {
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