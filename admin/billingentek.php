<?php
// Sertakan file koneksi ke database
include 'koneksi.php';

// Dapatkan waktu saat ini dalam bentuk timestamp
$timestampSekarang = time();

// Query untuk mendapatkan sesi-sesi dan lama bermain dari hasil join
$sql = "SELECT sesi.IDSesi, sesi.nambah, datakonsol.Status, datakonsol.IDKonsol, datakonsol.NamaKonsol, datakonsol.Televisi, datakonsol.harga, pelanggan.NamaPelanggan , sesi.Waktu , sesi.LamaBermain, sesi.LamaBermain*(datakonsol.harga/60) AS hargabayar FROM sesi RIGHT JOIN datakonsol ON sesi.IDKonsol = datakonsol.IDKonsol LEFT JOIN pelanggan ON sesi.IDPelanggan = pelanggan.IDPelanggan";
$result = mysqli_query($koneksi, $sql);

if (!$result) {
    die('Error: ' . mysqli_error($koneksi));
}

// Loop melalui hasil query dan hapus sesi-sesi yang telah kadaluarsa
while ($row = mysqli_fetch_assoc($result)) {
    $idsesi = $row['IDSesi'];
    $lamaBermain = $row['LamaBermain'];

    // Tentukan interval (dalam menit) berdasarkan lama bermain
    $intervalKadaluarsa = $lamaBermain; // Ganti dengan interval kadaluarsa berdasarkan lama bermain

    // Hitung timestamp kadaluarsa untuk sesi tertentu dengan mengurangkan interval dari waktu sesi
    $timestampKadaluarsa = strtotime($row['Waktu']) + ($intervalKadaluarsa * 60);

    // Jika timestamp kadaluarsa lebih kecil dari waktu saat ini, sesi telah kadaluarsa
    if ($timestampKadaluarsa <= $timestampSekarang) {
        // Hapus sesi dari database
        mysqli_query($koneksi, "DELETE FROM sesi WHERE IDSesi = '$idsesi'");
    }
}

// Tutup koneksi ke database
mysqli_close($koneksi);

echo "Sesi-sesi yang telah kadaluarsa telah dihapus.";
?>
