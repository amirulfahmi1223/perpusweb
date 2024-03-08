<?php
session_start();
include '../connection/koneksi.php';

error_reporting(0);
if ($_GET['id_user'] == "") {
  echo "<script>window.location='data-admin.php'</script>";
}
if (isset($_GET['id_user'])) {
  //menghapus file gambar di db sekaligus difoldernya
  //disimpanya gambar
  $user = mysqli_query($conn, "SELECT foto FROM tb_admin WHERE id ='" . $_GET['id_user'] . "' ");
  //mengecek data di table
  if (mysqli_num_rows($user) > 0) {
    $p = mysqli_fetch_object($user);
    //mengecek data difolder
    if (file_exists("../uploads/profil/" . $p->foto) && $p->foto != "new-default.png") {
      //jika ada difolder jurusan maka lakukan proses hapus file
      unlink("../uploads/profil/" . $p->foto);
    }
  }
  $delete = mysqli_query($conn, "DELETE FROM tb_admin WHERE id = '" . $_GET['id_user'] . "'");
  if ($delete) {
    $_SESSION['info'] = 'Data Berhasil diHapus';
    echo "<script>window.location = 'data-admin.php'</script>";
  } else {
    $_SESSION['info'] = 'Data Gagal diHapus';
    echo '<script>history.go(-1);</script>';
  }
}
