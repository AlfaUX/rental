<?php
include 'koneksi.php';

$judul = $_POST['konsol'];
$jenis = $_POST['televisi'];
$harga = $_POST['harga'];

$idne = rand(1, 9999);

mysqli_query($koneksi, "INSERT INTO datakonsol (IDKonsol, NamaKonsol, Televisi, Status, harga) 
VALUES ('$idne', '$judul', '$jenis', 0, '$harga')");

header("location: index.php?showAlert=1&namaPelanggan=" . urlencode($judul));
?>
