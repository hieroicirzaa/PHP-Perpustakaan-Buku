<?php
if (isset($_POST['submit'])) {
  $id_buku    = $_POST['id_buku'];
  $nama_buku  = $_POST['nama_buku'];
  $pengarang  = $_POST['pengarang'];
  $deskripsi  = $_POST['deskripsi'];
  $foto       = $_POST['foto'];

  // data foto yang baru
  $filename   = $_FILES['gambar']['name'];
  $tmp_name   = $_FILES['gambar']['tmp_name'];

  // jika admin ganti foto
  if ($filename != '') {
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
      unlink('./images/' . $foto);
      move_uploaded_file($tmp_name, './images/' . $newname);
      $namagambar = $newname;
    }
  } else {
    // jika admin tidak ganti foto
    $namagambar = $foto;
  }
  // query update data buku
  include "koneksi.php";
  $update = mysqli_query($conn, "UPDATE buku SET
                            nama_buku   = '" . $nama_buku . "',
                            pengarang   = '" . $pengarang . "',
                            deskripsi   = '" . $deskripsi . "',
                            foto        = '" . $namagambar . "'
                            WHERE id_buku = '" . $id_buku . "' ");

  if ($update) {
    echo "<script>alert('Update Data Buku berhasil');location.href='tampil_buku.php';</script>";
  } else {
    echo 'gagal update data' . mysqli_error($conn);
  }
}
?>