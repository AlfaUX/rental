<?php
include 'koneksi.php';
date_default_timezone_set('Asia/Jakarta');

$sesi = $_POST['idsesi'];
$konsol = $_POST['idkonsol'];
$pelanggan = $_POST['pelanggan'];
$waktu = date('Y-m-d H:i');
$waktubermain = $_POST['waktubermain'];

mysqli_query($koneksi, "INSERT INTO sesi VALUES ('$sesi','$pelanggan','$konsol','$waktu','$waktubermain','')");
$namaPelangganQuery = mysqli_query($koneksi, "SELECT NamaPelanggan FROM pelanggan WHERE IDPelanggan='$pelanggan'");
$namaPelanggan = ($namaPelangganQuery && mysqli_num_rows($namaPelangganQuery) > 0) ? mysqli_fetch_array($namaPelangganQuery)['NamaPelanggan'] : '';

header("location:indexop.php?showAlert=1&namaPelanggan=" . urlencode($namaPelanggan));
?>
