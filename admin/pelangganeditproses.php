<?php
include 'koneksi.php';

$id = $_POST['IDPelanggan'];
$nama = $_POST['NamaPelanggan'];
$domisili = $_POST['Domisili'];

mysqli_query($koneksi, "update pelanggan set NamaPelanggan='$nama', Domisili='$domisili' where IDPelanggan='$id'");

header("location:pelanggan.php?showAlert=2&namaPelanggan=" . urlencode($nama));
?>