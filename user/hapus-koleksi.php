<?php
session_start();
include '../connection/koneksi.php';

error_reporting(0);
if ($_GET['id_koleksi'] == "") {
  echo "<script>window.location='data-koleksi.php'</script>";
}
if (isset($_GET['id_koleksi'])) {

  $delete = mysqli_query($conn, "DELETE FROM tb_koleksi WHERE id_koleksi = '" . $_GET['id_koleksi'] . "'");
  echo '<script>history.go(-1);</script>';
}
