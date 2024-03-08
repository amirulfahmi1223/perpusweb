<?php
include "../connection/koneksi.php"; //memanggil file conn.php untuk koneksi ke database
$maks_pinjam    = 2; //maksimal peminjaman buku dua kali perpanjangan
$maks_hari_pinjam  = 7; //maksimal hari peminjaman

$id_trans  = $_GET['id_trans'];
$id_buku    = $_GET['id_buku'];

if (isset($_GET['id_trans'])) {

  $us = mysqli_query($conn, "UPDATE tb_peminjaman SET status_buku='Pinjam' WHERE id_peminjaman='" . $id_trans . "'");
  $uj = mysqli_query($conn, "UPDATE tb_buku SET jumlah_buku=(jumlah_buku-1) WHERE id_buku='$id_buku'");

  if ($us || $uj) {
    echo "<script>alert('Buku telah dikonfirmasi'); window.location = 'data-proses.php'</script>";
  } else {
    echo "<script>alert('Oops, Buku gagal dikonfirmasi!'); window.location = 'data-proses.php'</script>";
    echo "<meta http-equiv='refresh' content='0; url=?page=transaksi'>";
  }
}
