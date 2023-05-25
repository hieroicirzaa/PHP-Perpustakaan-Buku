<?php
if ($_POST) {
    $nama_buku = $_POST['nama_buku'];
    $pengarang = $_POST['pengarang'];
    $deskripsi = $_POST['deskripsi'];
    $filename   = $_FILES['foto']['name'];
    $tmp_name   = $_FILES['foto']['tmp_name'];
    $type1      = explode('.', $filename);
    $type2      = $type1[1];

    $newname    = 'buku' . time() . '.' . $type2;

    // menampung data format file yang diizinkan
    $tipe_diizinkan = array('jpg', 'jpeg', 'png', 'jfif', 'bmp', 'gif', 'tiff', 'heif', 'raw', 'psd', 'svg', 'eps', 'pdf', 'indd', 'ai', 'JPG');

    // validasi format file
    if (!in_array($type2, $tipe_diizinkan)) {
        //jika format array  file tidak ada di dalam tipe diizinkan
        echo '<script>alert("Format file tidak diizinkan")</script>';
    } else {
        // jika format file sesuai dengan yang ada di dalam array tipe diizinkan
        // proses upload file sekaligus insert ke database
        move_uploaded_file($tmp_name, './images/' . $newname);

        include "koneksi.php";
        $insert = mysqli_query($conn, "insert into buku (nama_buku, pengarang, deskripsi, foto) value ('" . $nama_buku . "','" . $pengarang . "','" . $deskripsi . "','" . $newname . "')");
        if ($insert) {
            echo "<script>alert('Tambah Data berhasil');location.href='tampil_buku.php';</script>";
        } else {
            echo 'gagal menambah data' . mysqli_error($conn);
        }
    }
}
