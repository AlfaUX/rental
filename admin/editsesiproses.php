<?php
include 'koneksi.php';

$id = $_POST['idsesi'];
$lamabermain = $_POST['waktubermain'];

$namaPelangganQuery = mysqli_query($koneksi, "SELECT NamaPelanggan FROM pelanggan WHERE IDPelanggan IN 
(SELECT IDPelanggan FROM sesi WHERE IDSesi='$id')");
$namaPelanggan = ($namaPelangganQuery && mysqli_num_rows($namaPelangganQuery) > 0) ? 
mysqli_fetch_array($namaPelangganQuery)['NamaPelanggan'] : '';

mysqli_query($koneksi, "UPDATE sesi SET LamaBermain=LamaBermain + $lamabermain, nambah=1 WHERE IDSesi='$id'");
header("location: sesi.php?showAlert=2&namaPelanggan=" . urlencode($namaPelanggan));
?>