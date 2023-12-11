<?php
include 'koneksi.php';

$id = $_POST['IDPelanggan'];

$namaKonsolQuery = mysqli_query($koneksi, "SELECT NamaPelanggan FROM pelanggan WHERE IDPelanggan='$id';");
$namaPelanggan = ($namaKonsolQuery && mysqli_num_rows($namaKonsolQuery) > 0) ? mysqli_fetch_array($namaKonsolQuery)['NamaPelanggan'] : '';

mysqli_query($koneksi, "DELETE FROM pelanggan WHERE IDPelanggan='$id'");

header("location: pelanggan.php?showAlert=3&namaPelanggan=" . urlencode($namaPelanggan));
?>
