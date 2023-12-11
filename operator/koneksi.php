<?php
    $koneksi = mysqli_connect("localhost","root","","rental");
    $db = new mysqli("localhost", "root", "", "rental");
    if(mysqli_connect_errno()){
        echo"Koneksi Database Gagal : ".
        mysqli_connect_error();
    }
?>