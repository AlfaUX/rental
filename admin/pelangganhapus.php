<?php
include 'koneksi.php';

$id = $_POST['idpelanggan'];

$namaPelangganQuery = mysqli_query($koneksi, "SELECT NamaPelanggan FROM pelanggan WHERE IDPelanggan='$id';");
if (!$namaPelangganQuery) {
    die("Error: " . mysqli_error($koneksi));
}

$namaPelanggan = ($namaPelangganQuery && mysqli_num_rows($namaPelangganQuery) > 0) ? 
mysqli_fetch_array($namaPelangganQuery)['NamaPelanggan'] : '';

if (!mysqli_query($koneksi, "DELETE FROM pelanggan WHERE IDPelanggan='$id'")) {
    die("Error: " . mysqli_error($koneksi));
}

header("location: pelanggan.php?showAlert=3&namaPelanggan=" . urlencode($namaPelanggan));
?>