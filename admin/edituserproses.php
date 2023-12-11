<?php
include 'koneksi.php';
$idUser = $_POST['id_user'];
$username = $_POST['username'];
$password = $_POST['password'];
$akses = $_POST['pangkat'];

// Query untuk melakukan update data user
$sql = "UPDATE user SET username='$username', password='$password', hak_akses='$akses' WHERE IDUser='$idUser'";
$result = mysqli_query($koneksi, $sql);

if (!$result) {
    die('Error: ' . mysqli_error($koneksi));
}

header("location: user.php?showAlert=2&namaPelanggan=" . urlencode($username));

?>