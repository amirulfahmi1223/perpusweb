<?php
session_start();
include '../connection/koneksi.php';

error_reporting(0);
if ($_GET['id_trans'] == "") {
  echo "<script>window.location='data-proses.php'</script>";
}
if (isset($_GET['id_trans'])) {

  $delete = mysqli_query($conn, "DELETE FROM tb_peminjaman WHERE id_peminjaman = '" . $_GET['id_trans'] . "'");
  if ($delete) {
    $_SESSION['info'] = 'Data Berhasil diHapus';
    echo "<script>window.location = 'data-proses.php'</script>";
  } else {
    $_SESSION['info'] = 'Data Gagal diHapus';
    echo '<script>history.go(-1);</script>';
  }
}
