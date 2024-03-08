<?php
include '../connection/koneksi.php';
if ($_GET['id_foto'] == '') {
  echo '<script>window.location="foto.php"</script>';
}

if (isset($_GET['id_foto'])) {
  //menghapus file gambar di db sekaligus difoldernya
  //disimpanya gambar
  $foto = mysqli_query($conn, "SELECT foto FROM foto WHERE id_foto ='" . $_GET['id_foto'] . "' ");
  //mengecek data di table
  if (mysqli_num_rows($foto) > 0) {
    $p = mysqli_fetch_object($foto);
    //mengecek data difolder
    if (file_exists("../uploads/foto/" . $p->foto)) {
      //jika ada difolder jurusan maka lakukan proses hapus file
      unlink("../uploads/foto/" . $p->foto);
    }
  }
  $delete = mysqli_query($conn, "DELETE FROM foto WHERE id_foto = '" . $_GET['id_foto'] . "'");
  echo '<script>history.go(-1);</script>';
}
