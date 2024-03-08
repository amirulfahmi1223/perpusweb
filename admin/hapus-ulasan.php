<?php
session_start();
include '../connection/koneksi.php';

error_reporting(0);
if ($_GET['id_ulasan'] == "") {
  echo "<script>window.location='data-ulasan.php'</script>";
}
if (isset($_GET['id_ulasan'])) {

  $delete = mysqli_query($conn, "DELETE FROM tb_ulasan WHERE id_ulasan = '" . $_GET['id_ulasan'] . "'");
  if ($delete) {
    $_SESSION['info'] = 'Data Berhasil diHapus';
    echo "<script>window.location = 'data-ulasan.php'</script>";
  } else {
    $_SESSION['info'] = 'Data Gagal diHapus';
    echo '<script>history.go(-1);</script>';
  }
}
