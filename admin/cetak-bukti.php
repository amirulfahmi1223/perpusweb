<?php
session_start();
include '../connection/koneksi.php';
date_default_timezone_set("Asia/jakarta");
if (!isset($_SESSION["status_login"])) {
  echo '<script>window.location="login.php"</script>';
}
$kode = $_GET['detail'];
if (!empty($_GET['detail'])) {
} else {
  echo '<script>history.go(-1);</script>';
};
$query = "SELECT * FROM tb_admin WHERE id = '" .  $_COOKIE['id_admin'] . "'";
$run = mysqli_query($conn, $query);
$d = mysqli_fetch_array($run);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cetak Bukti</title>
  <link rel="icon" href="../image/background/favicon.ico">
  <link rel="icon" href="../image/background/favicon.ico" type="image/ico">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link href="../assets/css/style.css" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link href="../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="../assets/vendor/datatables/responsive.bootstrap4.min.css" rel="stylesheet">
</head>
<script>
  window.print();
</script>

<body>
  <!-- data print -->
  <section id="print">
    <div class="d-none pt-5 px-5 print-show">
      <div class="text-center mb-5 pt-2">
        <h2 class="mb-3" style="font-size:60px;">BUKTI PEMINJAMAN</h2>
        <h2 class="mb-0">PERPUSTAKAAN SMKN 4 BOJONEGORO</h2>
      </div>
      <?php
      $data_laporan = mysqli_query($conn, "SELECT * FROM tb_peminjaman JOIN tb_buku ON tb_peminjaman.id_buku = tb_buku.id_buku JOIN tb_anggota ON tb_peminjaman.id_peminjam = tb_anggota.id_anggota WHERE tb_peminjaman.id_peminjaman='" . $kode . "'");
      $l = mysqli_fetch_array($data_laporan);
      $tanggal = date('d-m-Y');
      ?>
      <h2 class="mb-1">Kode Peminjaman : <?= $l['id_peminjaman']; ?> <span class="float-right">Petugas : <?= $d['nama']; ?></span></h2>
      <h2 class="mb-1">Tanggal : <?= $tanggal; ?> </h2>
      <div class="row">
        <div class="col-12 py-3 my-3 border-top border-bottom">
          <div class="row">
            <div class="col-3">
              <h2 class="mb-0 py-1" style="font-weight:700;">Kode Buku</h2>
            </div>
            <div class="col-3">
              <h2 class="mb-0 py-1" style="font-weight:700;">Peminjam</h2>
            </div>
            <div class="col-3">
              <h2 class="mb-0 py-1" style="font-weight:700;">Tgl_Pinjam</h2>
            </div>
            <div class="col-3">
              <h2 class="mb-0 py-1" style="font-weight:700;">Tgl_Kembali</h2>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="row">
            <div class="col-3">
              <h2 class="mb-0 py-1" style="font-weight:500;"><?= $l['id_buku']; ?></h2>
            </div>
            <div class="col-3">
              <h2 class="mb-0 py-1" style="font-weight:500;"><?= $l['nama']; ?></h2>
            </div>
            <div class="col-3">
              <h2 class="mb-0 py-1" style="font-weight:500;"><?= $l['tgl_pinjam']; ?></h2>
            </div>
            <div class="col-3">
              <h2 class="mb-0 py-1" style="font-weight:500;"><?= $l['tgl_kembali']; ?></h2>
            </div>
          </div>
        </div>
        <div class="col-12 py-3 my-3 mb-5 border-top">

        </div>
        <div class="col-12 text-center mt-3">
          <img src="../image/qr.jpg" height="300" width="300" alt="">
          <h2>* Terima Kasih Atas Kunjungannya *</h2>
        </div>
      </div><!-- end row -->
    </div><!-- end box print -->
  </section>
  <!-- end data print -->

</body>

</html>