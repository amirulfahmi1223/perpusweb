<?php include  "sidebar.php";
$proses = mysqli_query($conn, "SELECT * FROM tb_peminjaman WHERE status_buku = 'Proses' AND id_peminjam = '" . $_COOKIE['id'] . "'");
$jumlah1 = mysqli_num_rows($proses);
$pinjam = mysqli_query($conn, "SELECT * FROM tb_peminjaman WHERE status_buku = 'Pinjam' AND id_peminjam = '" . $_COOKIE['id'] . "'");
$jumlah2 = mysqli_num_rows($pinjam);
$kembali = mysqli_query($conn, "SELECT * FROM tb_peminjaman WHERE status_buku = 'Kembali' AND id_peminjam = '" . $_COOKIE['id'] . "'");
$jumlah3 = mysqli_num_rows($kembali);
$koleksi = mysqli_query($conn, "SELECT * FROM tb_koleksi WHERE id_user = '" . $_COOKIE['id'] . "'");
$jumlah4 = mysqli_num_rows($koleksi);
?>
<!-- isinya -->
<h1 class="h3 mb-0">
  Beranda
  <div class="float-right">
    <p id="date_time" style="font-size: 14px; margin-top:11px"></p>
  </div>
</h1>
<hr>
<div class="row">
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-secondary o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          Buku di Proses
        </div>
        <div class="mr-5" style="font-size:32px;"><?= $jumlah1; ?></div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="data-proses.php">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fas fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-primary o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          Buku di Pinjam
        </div>
        <div class="mr-5" style="font-size:32px;"><?= $jumlah2; ?></div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="data-pinjam.php">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fas fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-success o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          Buku di Kembalikan
        </div>
        <div class="mr-5" style="font-size:32px;"><?= $jumlah3; ?></div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="data-kembali.php">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fas fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-warning o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          Daftar Koleksi
        </div>
        <div class="mr-5" style="font-size:32px;"><?= $jumlah4; ?></div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="data-koleksi.php">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fas fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <?php include "footer.php" ?>