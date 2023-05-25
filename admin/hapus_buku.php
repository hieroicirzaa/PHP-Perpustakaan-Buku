<?php
if ($_GET['id_buku']) {
    include "koneksi.php";
    $buku = mysqli_query($conn, "SELECT foto FROM buku WHERE id_buku = '" . $_GET['id_buku'] . "' ");
    $p = mysqli_fetch_object($buku);

    unlink('../admin/images/' . $p->foto);
    $qry_hapus = mysqli_query($conn, "delete from buku where id_buku='" . $_GET['id_buku'] . "'");

    if ($qry_hapus) {
        echo "<script>alert('Sukses hapus buku');location.href='tampil_buku.php';</script>";
    } else {
        echo "<script>alert('Gagal hapus buku');location.href='tampil_buku.php';</script>";
    }
}
