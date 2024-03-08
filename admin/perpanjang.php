<?php
date_default_timezone_set("Asia/jakarta");
$id_transaksi  = isset($_GET['id_trans']) ? $_GET['id_trans'] : "";
$lambat      = isset($_GET['lambat']) ? $_GET['lambat'] : "";
$judul      = isset($_GET['judul']) ? $_GET['judul'] : "";
$tgl_kembali  = isset($_GET['kembali']) ? $_GET['kembali'] : "";


if ($lambat > 8) {
  echo "<script>alert('Anda Sudah lewat dari maksimal batas pengembalian, silahkan kembalikan buku kemudian pinjam kembali!'); window.location = 'data-pinjam.php'</script>";
} else {
  include "../connection/koneksi.php";

  $pecah      = explode("-", $tgl_kembali);
  $next_7_hari  = mktime(0, 0, 0, $pecah[1], $pecah[0] + 8, $pecah[2]);
  $hari_next    = date("d-m-Y", $next_7_hari);


  $update_tgl_kembali = mysqli_query($conn, "UPDATE tb_peminjaman SET tgl_kembali='$hari_next' WHERE id_peminjaman='$id_transaksi'");

  if ($update_tgl_kembali) {
    echo "<script>alert('Peminjaman buku berhasil diperpanjang!'); window.location = 'data-pinjam.php'</script>";
  } else {
    echo "<script>alert('Peminjaman buku gagal diperpanjang!'); window.location = 'data-pinjam.php'</script>";
  }
}
