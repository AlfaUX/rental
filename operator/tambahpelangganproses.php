<?php
include 'koneksi.php';

$pelanggan = $_POST['pelanggan'];
$domisili = $_POST['domisili'];

$idne = rand(1, 9999);

mysqli_query($koneksi, "INSERT INTO pelanggan (IDPelanggan, NamaPelanggan, Domisili) VALUES ('$idne', '$pelanggan', '$domisili')");

header("location: pelanggan.php?showAlert=1&namaPelanggan=" . urlencode($pelanggan));
?>
