<?php
session_start();
include '../connection/koneksi.php';

error_reporting(0);
if ($_GET['id_kat'] == "") {
  echo "<script>window.location='kategori.php'</script>";
}
if (isset($_GET['id_kat'])) {
  $data = mysqli_query($conn, "SELECT * FROM kategori WHERE id_kategori ='" . $_GET['id_kat'] . "'");
  //mengecek data di table
  if (mysqli_num_rows($data) > 0) {
    $query = "DELETE FROM kategori WHERE id_kategori = '" . $_GET['id_kat'] . "' AND created_by = 1";
    $delete = mysqli_query($conn, $query);
    if ($delete) {
      $_SESSION['info'] = 'Data Berhasil diHapus';
      echo "<script>window.location = 'kategori.php'</script>";
    } else {
      $_SESSION['info'] = 'Data Gagal diHapus';
      echo '<script>history.go(-1);</script>';
    }
  } else {
    echo "<script>alert('Hak Akses diTolak')</script>";
  }
}
