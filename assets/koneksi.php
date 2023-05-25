<?php
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $database = "perpustakaan";

    //buat koneksi
    $conn = mysqli_connect($serverName, $userName, $password, $database);

    //cek koneksi
    // if (!$koneksi) {
    //     die("Koneksi Gagal".mysqli_connect_error());
    // }
    // else{
    //     echo "koneksi berhasil";
    // }
?>