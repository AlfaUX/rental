<?php
// Sertakan file koneksi ke database
include 'koneksi.php';

// Jalankan skrip check_expired_sessions.php dari latar belakang tanpa mengarahkan ke halaman lain
exec("php " . __DIR__ . "/billingentek.php > /dev/null 2>&1 &");

// Tutup koneksi ke database
mysqli_close($koneksi);
?>
