<?php
include 'koneksi.php';

$idpel = mysqli_query($koneksi, "SELECT MAX(IDPelanggan) AS IDPelangganBaru FROM pelanggan");
$s = mysqli_fetch_array($idpel);
$idne = $s['IDPelangganBaru'] + 1;
$pelanggan = $_POST['pelanggan'];
$domisili = $_POST['domisili'];

mysqli_query($koneksi, "insert into pelanggan values ('$idne','$pelanggan','$domisili')");

header("location:pelanggan.php?showAlert=1&namaPelanggan=" . urlencode($pelanggan));
?>