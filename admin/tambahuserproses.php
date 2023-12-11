<?php
include 'koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];
$akses = $_POST['Pangkat'];

$query = "SELECT COUNT(*) as total FROM user WHERE username = '$username'";
$result = mysqli_query($koneksi, $query);
$row = mysqli_fetch_assoc($result);
$usernameada = ($row['total'] > 0);

if ($usernameada) {
    header("location: user.php?showAlert=6&namaPelanggan=" . urlencode($username));
    exit();
}

$idne = rand(1, 9999);
mysqli_query($koneksi, "INSERT INTO user (IDUser, username, password, hak_akses) VALUES ('$idne', '$username', '$password', '$akses')");

header("location: user.php?showAlert=1&namaPelanggan=" . urlencode($username));
?>