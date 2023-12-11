<?php

include 'koneksi.php';

$idUser = $_POST['id_user'];
$username = $_POST['username'];

$sql = "DELETE FROM user WHERE IDUser='$idUser'";
$result = mysqli_query($koneksi, $sql);

if (!$result) {
    die('Error: ' . mysqli_error($koneksi));
}

if (mysqli_affected_rows($koneksi) > 0) {
    header("location: user.php?showAlert=3&namaPelanggan=" . urlencode($username));
} else {
    header("location: user.php?showAlert=2&namaPelanggan=" . urlencode($username));
}
?>