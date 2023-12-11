<?php
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include 'koneksi.php';

// menangkap data yang dikirim dari form login
$user = $_POST['user'];
$pass = $_POST['pass'];


// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($koneksi, "select * from user where username='$user' and password='$pass'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

// cek apakah username dan password di temukan pada database
if ($cek > 0) {

  $data = mysqli_fetch_assoc($login);

  // cek jika user login sebagai admin
  if ($data['hak_akses'] == "3") {

    // buat session login dan username
    $_SESSION['user'] = $user;
    $_SESSION['hak_akses'] = "Pemilik";
    $_SESSION['status'] = "login";
    $akses = "Admin";
    // alihkan ke halaman dashboard admin
    header("location: ../rental/admin/index.php?showAlert=4&namaPelanggan=" . urlencode($user));

    // cek jika user login sebagai operator
  } else if ($data['hak_akses'] == "2") {
    // buat session login dan username
    $_SESSION['user'] = $user;
    $_SESSION['hak_akses'] = "Operator";
    $_SESSION['status'] = "login";
    $akses = "Anggota Ora Biasa";
    // alihkan ke halaman dashboard pegawai
    header("location: ../rental/operator/indexop.php?showAlert=6&namaPelanggan=" . urlencode($user));

    // cek jika user login sebagai tamu
  } else if ($data['hak_akses'] == "1") {
    // buat session login dan username
    $_SESSION['user'] = $user;
    $_SESSION['hak_akses'] = "Tamu";
    $_SESSION['status'] = "login";
    $akses = "Tamu";
    // alihkan ke halaman dashboard pengurus
    header("location: ../rental/member/indexmem.php?showAlert=4&namaPelanggan=" . urlencode($user));

  } else {

    // alihkan ke halaman login kembali
    header("location:../rental/login.php?showAlert=1");
  }
} else {
  header("location:../rental/login.php?showAlert=2");
}