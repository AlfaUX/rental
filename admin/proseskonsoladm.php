<?php
include 'koneksi.php';

$IDKonsol = $_POST['IDKonsol'];
$NamaKonsol = $_POST['NamaKonsol'];
$Televisi = $_POST['Televisi'];
$Harga = $_POST['Harga'];
$Status = $_POST['Status'];

mysqli_query($koneksi, "update datakonsol set NamaKonsol='$NamaKonsol', Televisi='$Televisi', Status='$Status', harga='$Harga' 
where IDKonsol='$IDKonsol'");

header("location:index.php?showAlert=2&namaPelanggan=" . urlencode($NamaKonsol));
?>