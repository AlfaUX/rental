<?php
include 'koneksi.php';

$id = $_POST['IDKonsol'];

$namaKonsolQuery = mysqli_query($koneksi, "SELECT NamaKonsol FROM datakonsol WHERE IDKonsol='$id';");
$namaKonsol = ($namaKonsolQuery && mysqli_num_rows($namaKonsolQuery) > 0) ? mysqli_fetch_array($namaKonsolQuery)['NamaKonsol'] : '';

mysqli_query($koneksi, "DELETE FROM datakonsol WHERE IDKonsol='$id'");

header("location: index.php?showAlert=3&namaPelanggan=" . urlencode($namaKonsol));
?>
