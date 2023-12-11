<?php
include 'koneksi.php';

$id = $_POST['idsesi'];

$namaPelangganQuery = mysqli_query($koneksi, "SELECT NamaPelanggan FROM pelanggan WHERE IDPelanggan IN 
(SELECT IDPelanggan FROM sesi WHERE IDSesi='$id')");
$namaPelanggan = ($namaPelangganQuery && mysqli_num_rows($namaPelangganQuery) > 0) ? 
mysqli_fetch_array($namaPelangganQuery)['NamaPelanggan'] : '';

mysqli_query($koneksi, "DELETE FROM sesi WHERE IDSesi='$id'");

header("location:sesi.php?showAlert=3&namaPelanggan=" . urlencode($namaPelanggan));
?>
