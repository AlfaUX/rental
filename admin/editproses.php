<?php
    include 'koneksi.php';    
    
    $id = $_POST['id'];
    $username = $_POST['kode'];
    $akses = $_POST['jenis'];
    
    mysqli_query($koneksi,"update user set username='$username', hak_akses='$akses'  where id='$id'");
    $message = "Data Berhasil Diedit";
    header("location: user.php");   
?>