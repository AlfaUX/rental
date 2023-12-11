<?php
include 'koneksi.php';

// Eksekusi perintah DELETE
$result = mysqli_query($koneksi, "DELETE FROM sesi");

// Cek apakah ada baris yang terhapus
if (mysqli_affected_rows($koneksi) > 0) {
    header("location: sesi.php?showAlert=4");
} else {
    header("location: sesi.php?showAlert=5");
}
?>
