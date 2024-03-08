<?php
session_start();
include '../connection/koneksi.php';

error_reporting(0);
if ($_GET['id_buku'] == "") {
  echo "<script>window.location='data-buku.php'</script>";
}
if (isset($_GET['id_buku'])) {
  //menghapus file gambar di db sekaligus difoldernya
  //disimpanya gambar
  $buku = mysqli_query($conn, "SELECT gambar FROM tb_buku WHERE id_buku ='" . $_GET['id_buku'] . "' ");
  //mengecek data di table
  if (mysqli_num_rows($buku) > 0) {
    $p = mysqli_fetch_object($buku);
    //mengecek data difolder
    if (file_exists("../uploads/buku/" . $p->gambar)) {
      //jika ada difolder jurusan maka lakukan proses hapus file
      unlink("../uploads/buku/" . $p->gambar);
    }
  }
  $delete = mysqli_query($conn, "DELETE FROM tb_buku WHERE id_buku = '" . $_GET['id_buku'] . "'");
  if ($delete) {
    $_SESSION['info'] = 'Data Berhasil diHapus';
    echo "<script>window.location = 'data-buku.php'</script>";
  } else {
    $_SESSION['info'] = 'Data Gagal diHapus';
    echo '<script>history.go(-1);</script>';
  }
}
