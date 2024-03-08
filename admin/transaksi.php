<?php
include 'sidebar.php';
// $pengguna = mysqli_query($conn, "SELECT * FROM tb_pengguna");
// $jumlah1 = mysqli_num_rows($pengguna);
// if ($d['level'] == "Administrator") {
//   $query = "SELECT tb_pengguna.nama AS pengguna,tb_projek.kode_projek,tb_projek.nama AS projek, tb_projek.token_projek, tb_projek.deskripsi,tb_projek.progress_projek,tb_projek.target_selesai,tb_projek.status,tb_projek.created_at,tb_projek.update_at FROM tb_projek JOIN tb_pengguna ON tb_projek.created_by = tb_pengguna.id ORDER BY tb_projek.created_at ASC";
// } else {
//   $query = "SELECT tb_pengguna.nama AS pengguna,tb_projek.kode_projek,tb_projek.nama AS projek, tb_projek.token_projek, tb_projek.deskripsi,tb_projek.progress_projek,tb_projek.target_selesai,tb_projek.status,tb_projek.created_at,tb_projek.update_at FROM tb_projek JOIN tb_pengguna ON tb_projek.created_by = tb_pengguna.id WHERE tb_projek.created_by = '" .  $_COOKIE['id'] . "'";
// }
$proses = mysqli_query($conn, "SELECT * FROM tb_peminjaman WHERE status_buku = 'Proses'");
$jumlah1 = mysqli_num_rows($proses);
$pinjam = mysqli_query($conn, "SELECT * FROM tb_peminjaman WHERE status_buku = 'Pinjam'");
$jumlah2 = mysqli_num_rows($pinjam);
$kembali = mysqli_query($conn, "SELECT * FROM tb_peminjaman WHERE status_buku = 'Kembali'");
$jumlah3 = mysqli_num_rows($kembali);
?>
<!-- isinya -->
<h1 class="h3 mb-0">
  Data Peminjaman
  <div class="float-right">
    <p id="date_time" style="font-size: 14px; margin-top:11px"></p>
  </div>
</h1>
<hr>
<div class="row">
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-primary o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          Buku di Proses
        </div>
        <div class="mr-5" style="font-size:32px;"><?= $jumlah1 ?></div>
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
    <div class="card text-white bg-warning o-hidden h-100">
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
</div>
<!-- Main row -->
<div class="row">
  <div class="col-lg-6">
    <?php
    $peminjaman = mysqli_query($conn, "SELECT * FROM tb_peminjaman JOIN tb_anggota ON tb_peminjaman.id_peminjam = tb_anggota.id_anggota WHERE tb_peminjaman.status_buku = 'Proses' OR tb_peminjaman.status_buku = 'Pinjam' ORDER BY tb_peminjaman.id_peminjaman DESC LIMIT 5");
    ?>
    <!--chat start-->
    <section class="panel">
      <header class="panel-heading mb-2">
        Pemberitahuan Peminjaman
      </header>

      <?php while ($p = mysqli_fetch_assoc($peminjaman)) { ?>
        <div class="alert alert-success">
          <button data-dismiss="alert" class="close close-sm" type="button">
            <i class="fa fa-times"></i>
          </button>
          <strong><?= $p['nama']; ?></strong>, Baru saja melakukan peminjaman di PerPusWeb.
        </div>
      <?php } ?>
    </section>
  </div>
  <div class="col-lg-6">
    <?php
    $kembali = mysqli_query($conn, "SELECT * FROM tb_peminjaman JOIN tb_anggota ON tb_peminjaman.id_peminjam = tb_anggota.id_anggota WHERE tb_peminjaman.status_buku = 'Kembali' ORDER BY tb_peminjaman.id_peminjaman DESC LIMIT 5");
    ?>
    <!--chat start-->
    <section class="panel">
      <header class="panel-heading mb-2">
        Pemberitahuan Pengembalian
      </header>
      <?php while ($k = mysqli_fetch_assoc($kembali)) { ?>
        <div class="panel-body" id="noti-box">
          <div class="alert alert-block alert-info">
            <button data-dismiss="alert" class="close close-sm" type="button">
              <i class="fa fa-times"></i>
            </button>
            <strong><?= $k['nama']; ?></strong>, Telah mengembalikan buku di Perpustakaan.
          </div>
        <?php } ?>

    </section>



  </div>


</div>


<!-- <div class="text-center mt-4">
  <h4>Jumlah Peminjam Buku : <?php echo "$jumlah2"; ?> Orang </h4>
</div> -->


<!-- end isinya -->
<?php include 'footer.php'; ?>