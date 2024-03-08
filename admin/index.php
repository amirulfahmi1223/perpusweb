<?php
include 'sidebar.php';
// $pengguna = mysqli_query($conn, "SELECT * FROM tb_pengguna");
// $jumlah1 = mysqli_num_rows($pengguna);
// if ($d['level'] == "Administrator") {
//   $query = "SELECT tb_pengguna.nama AS pengguna,tb_projek.kode_projek,tb_projek.nama AS projek, tb_projek.token_projek, tb_projek.deskripsi,tb_projek.progress_projek,tb_projek.target_selesai,tb_projek.status,tb_projek.created_at,tb_projek.update_at FROM tb_projek JOIN tb_pengguna ON tb_projek.created_by = tb_pengguna.id ORDER BY tb_projek.created_at ASC";
// } else {
//   $query = "SELECT tb_pengguna.nama AS pengguna,tb_projek.kode_projek,tb_projek.nama AS projek, tb_projek.token_projek, tb_projek.deskripsi,tb_projek.progress_projek,tb_projek.target_selesai,tb_projek.status,tb_projek.created_at,tb_projek.update_at FROM tb_projek JOIN tb_pengguna ON tb_projek.created_by = tb_pengguna.id WHERE tb_projek.created_by = '" .  $_COOKIE['id'] . "'";
// }
$anggota = mysqli_query($conn, "SELECT * FROM tb_anggota");
$jumlah1 = mysqli_num_rows($anggota);
$pengguna = mysqli_query($conn, "SELECT * FROM tb_admin");
$jumlah2 = mysqli_num_rows($pengguna);
$buku = mysqli_query($conn, "SELECT * FROM tb_buku");
$jumlah3 = mysqli_num_rows($buku);
$tr = mysqli_query($conn, "SELECT * FROM tb_ulasan");
$jumlah4 = mysqli_num_rows($tr);
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
  <?php
  if ($d['level'] == "Admin") { ?>
    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card text-white bg-info o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            Daftar Anggota
          </div>
          <div class="mr-5" style="font-size:32px;"><?= $jumlah1; ?></div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="data-anggota.php">
          <span class="float-left">View Details</span>
          <span class="float-right">
            <i class="fas fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
  <?php } ?>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-secondary o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          Daftar Petugas
        </div>
        <div class="mr-5" style="font-size:32px;"><?= $jumlah2; ?></div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="data-admin.php">
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
          Daftar Buku
        </div>
        <div class="mr-5" style="font-size:32px;"><?= $jumlah3; ?></div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="data-buku.php">
        <span class="float-left">View Details</span>
        <span class="float-right">
          <i class="fas fa-angle-right"></i>
        </span>
      </a>
    </div>
  </div>
  <div class="col-xl-3 col-sm-6 mb-3">
    <div class="card text-white bg-danger o-hidden h-100">
      <div class="card-body">
        <div class="card-body-icon">
          Daftar Ulasan
        </div>
        <div class="mr-5" style="font-size:32px;"><?= $jumlah4; ?></div>
      </div>
      <a class="card-footer text-white clearfix small z-1" href="data-ulasan.php">
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

  <div class="col-md-6">
    <div class="panel">
      <header class="panel-heading mb-2">
        Daftar Anggota Baru
      </header>
      <?php
      $query = mysqli_query($conn, "SELECT * FROM tb_anggota ORDER BY created_at DESC LIMIT 4");
      while ($a = mysqli_fetch_assoc($query)) {
      ?>
        <ul class="list-group teammates">
          <li class="list-group-item">
            <a href="detail-anggota.php?kd_anggota=<?= $a['id_anggota']; ?>"><img src="../uploads/profil/<?= $a['foto']; ?>" width="50" height="50" style="border: 3px solid #555555;"></a>
            <a href="detail-anggota.php?kd_anggota=<?= $a['id_anggota']; ?>"><?= $a['nama']; ?></a>
          </li>
        </ul>
      <?php } ?>

      <div class="panel-footer bg-white">
        <!-- <span class="pull-right badge badge-info">32</span> -->
        <a href="data-anggota.php" class="btn btn-sm btn-info mt-2"><i class="fa fa-user"></i> Data Anggota</a>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <?php
    $anggota = mysqli_query($conn, "SELECT * FROM tb_anggota ORDER BY created_at DESC LIMIT 1");
    $admin = mysqli_query($conn, "SELECT * FROM tb_admin ORDER BY created_at DESC LIMIT 1");
    $buku = mysqli_query($conn, "SELECT * FROM tb_buku ORDER BY id_buku DESC LIMIT 1");
    $ulasan = mysqli_query($conn, "SELECT * FROM tb_ulasan JOIN tb_anggota ON tb_ulasan.id_anggota = tb_anggota.id_anggota ORDER BY tb_ulasan.tgl_ulasan DESC LIMIT 1");
    ?>
    <!--chat start-->
    <section class="panel">
      <header class="panel-heading mb-2">
        Pemberitahuan
      </header>
      <?php while ($u = mysqli_fetch_assoc($anggota)) { ?>
        <div class="panel-body" id="noti-box">
          <div class="alert alert-block alert-danger">
            <button data-dismiss="alert" class="close close-sm" type="button">
              <i class="fa fa-times"></i>
            </button>
            <strong><?= $u['nama']; ?></strong>, Telah terdaftar menjadi anggota perpustakaan.
          </div>
        <?php } ?>
        <?php while ($adm = mysqli_fetch_assoc($admin)) { ?>
          <div class="alert alert-success">
            <button data-dismiss="alert" class="close close-sm" type="button">
              <i class="fa fa-times"></i>
            </button>
            <strong><?= $adm['nama']; ?></strong>, Telah ditambahkan menjadi <?= $adm['level']; ?> PerPusWeb yang baru.
          </div>
        <?php } ?>
        <?php while ($bu = mysqli_fetch_assoc($buku)) { ?>
          <div class="alert alert-info">
            <button data-dismiss="alert" class="close close-sm" type="button">
              <i class="fa fa-times"></i>
            </button>
            <strong><?= $bu['judul']; ?></strong>, Buku bacaan baru yang ada di PerPusWeb.
          </div>
        <?php } ?>
        <?php while ($ul = mysqli_fetch_assoc($ulasan)) { ?>
          <div class="alert alert-warning">
            <button data-dismiss="alert" class="close close-sm" type="button">
              <i class="fa fa-times"></i>
            </button>
            <strong><?= $ul['nama']; ?> </strong> Baru saja memberikan ulasan di PerPusWeb.
          </div>
        <?php } ?>
    </section>



  </div>


</div>


<!-- Director for demo purposes -->
<script type="text/javascript">
  $('input').on('ifChecked', function(event) {
    // var element = $(this).parent().find('input:checkbox:first');
    // element.parent().parent().parent().addClass('highlight');
    $(this).parents('li').addClass("task-done");
    console.log('ok');
  });
  $('input').on('ifUnchecked', function(event) {
    // var element = $(this).parent().find('input:checkbox:first');
    // element.parent().parent().parent().removeClass('highlight');
    $(this).parents('li').removeClass("task-done");
    console.log('not');
  });
</script>
<script>
  $('#noti-box').slimScroll({
    height: '400px',
    size: '5px',
    BorderRadius: '5px'
  });

  $('input[type="checkbox"].flat-grey, input[type="radio"].flat-grey').iCheck({
    checkboxClass: 'icheckbox_flat-grey',
    radioClass: 'iradio_flat-grey'
  });
</script>
<script type="text/javascript">
  $(function() {
    "use strict";
    //BAR CHART
    var data = {
      labels: ["January", "February", "March", "April", "May", "June", "July"],
      datasets: [{
          label: "My First dataset",
          fillColor: "rgba(220,220,220,0.2)",
          strokeColor: "rgba(220,220,220,1)",
          pointColor: "rgba(220,220,220,1)",
          pointStrokeColor: "#fff",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: [65, 59, 80, 81, 56, 55, 40]
        },
        {
          label: "My Second dataset",
          fillColor: "rgba(151,187,205,0.2)",
          strokeColor: "rgba(151,187,205,1)",
          pointColor: "rgba(151,187,205,1)",
          pointStrokeColor: "#fff",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(151,187,205,1)",
          data: [28, 48, 40, 19, 86, 27, 90]
        }
      ]
    };
    new Chart(document.getElementById("linechart").getContext("2d")).Line(data, {
      responsive: true,
      maintainAspectRatio: false,
    });

  });
  // Chart.defaults.global.responsive = true;
</script>
<!-- end isinya -->
<?php include 'footer.php'; ?>