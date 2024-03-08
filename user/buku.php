<?php
session_start();
include "../connection/koneksi.php";
date_default_timezone_set("Asia/jakarta");
if ($_GET['kd_buku'] == '') {
  echo '<script>window.location="galeri_buku.php"</script>';
}
$buku = mysqli_query($conn, "SELECT * FROM tb_buku INNER JOIN tb_kategori ON tb_buku.id_kategori = tb_kategori.id_kategori WHERE tb_buku.id_buku = '" . $_GET['kd_buku'] . "'");
$data = mysqli_fetch_assoc($buku);
if (isset($_POST['koleksi'])) {
  $kode = $_POST['kd_buku'];
  $id = $_POST['id_user'];

  $currdate = date('Y-m-d');

  $simpan = mysqli_query($conn, "INSERT INTO tb_koleksi VALUES(
                '',
              '" . $kode . "',
              '" . $id . "',
              '" . $currdate . "'
            )");
  if ($simpan) {
    echo "<script>alert('Tambah Koleksi Buku Berhasil')</script>";
    echo '<script>history.go(-1);</script>';
  } else {
    echo "<div class='alert alert-error'>Simpan Gagal</div>";
    echo '<script>history.go(-1);</script>';
  }
}
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Galeri-Perpus</title>
  <link rel="icon" href="../image/background/favicon.ico">
  <link rel="icon" href="../image/background/favicon.ico" type="image/ico">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="crossorigin" />
  <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Arimo:wght@400;600;700&amp;display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Arimo:wght@400;600;700&amp;display=swap" media="print" onload="this.media='all'" />
  <noscript>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Arimo:wght@400;600;700&amp;display=swap" />
  </noscript>
  <link href="../css/bootstrap.min.css?ver=1.2.0" rel="stylesheet">
  <link href="../css/font-awesome/css/all.min.css?ver=1.2.0" rel="stylesheet">
  <link href="../css/main.css?ver=1.2.0" rel="stylesheet">
</head>
<style>
  .cuss {
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    background-color: #1e22296e;
    justify-content: center;
    align-items: center;
    z-index: 1051;
  }

  .cuss .tengah-tengah {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100px;
    border-bottom-left-radius: 0.3rem;
    border-bottom-right-radius: 0.3rem;
    margin: 0 auto;
    width: 40%;
    background-color: #ffffff;
  }

  .comment {
    border: 1px solid #ddd;
    margin-bottom: 20px;
    padding: 10px;
    border-radius: 5px;
  }

  .comment .reply-btn {
    cursor: pointer;
  }

  .comment .replies {
    margin-left: 30px;
  }

  .stars i {
    cursor: pointer;
    color: #ccc;
  }

  .stars .fas {
    color: #ffc107;
  }

  .cuss {
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    background-color: #1e22296e;
    justify-content: center;
    align-items: center;
    z-index: 1051;
  }

  .cuss .tengah-tengah {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100px;
    border-bottom-left-radius: 0.3rem;
    border-bottom-right-radius: 0.3rem;
    margin: 0 auto;
    width: 40%;
    background-color: #ffffff;
  }
</style>

<body id="top">
  <div class="page">
    <header>
      <div class="pp-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <div class="container"><a href="index.php"><img src="../image/pngegg (4).png" class="text-dark" alt="Logo"> </a><a class="navbar-brand" href="index.php">School Library</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a class="nav-link" href="galeri-buku.php">Home</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="data-koleksi.php">Koleksi Pribadi</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="#Search" data-toggle="modal">Search</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="index.php">E-Perpus</a>
                </li>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </header>

    <div class="page-content">
      <div class="container">
        <div class="container pp-section">
          <div class="h3 font-weight-normal">Detail Buku <?= $data['judul']; ?></div>
          <div class="row mt-5">
            <div class="col-md-12">
              <div class="panel">
                <!-- <div class="box-header"> -->
                <!-- <h3 class="box-title">Responsive Hover Table</h3> -->
                <!-- </div> -->
                <div class="panel-body">
                  <table id="example" class="table table-hover table-bordered">
                    <tr>
                      <td>Kode Buku</td>
                      <td><?php echo $data['id_buku']; ?></td>
                      <td rowspan="9">
                        <div class="pull-right image">
                          <img src="../uploads/buku/<?= $data['gambar']; ?>" class="img-rounded" height="300" width="250" alt="User Image" style="border: 3px solid #333333;" />
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td width="250">Judul</td>
                      <td width="550"><?php echo $data['judul']; ?></td>
                    </tr>
                    <tr>
                      <td>Penulis</td>
                      <td><?php echo $data['penulis']; ?></td>
                    </tr>
                    <tr>
                      <td>Penerbit</td>
                      <td><?php echo $data['penerbit']; ?></td>
                    </tr>
                    <tr>
                      <td>Tahun Terbit</td>
                      <td><?php echo $data['th_terbit']; ?></td>
                    </tr>
                    <tr>
                      <td>Kategori</td>
                      <td><?php echo $data['nama_kategori']; ?></td>
                    </tr>
                    <tr>
                      <td>Jumlah</td>
                      <td><?php echo $data['jumlah_buku']; ?></td>
                    </tr>
                    <tr>
                      <td>Lokasi</td>
                      <td><?php echo $data['lokasi']; ?></td>
                    </tr>
                    <tr>
                      <td>Tanggal Input</td>
                      <td><?php echo $data['tgl_input']; ?></td>
                    </tr>
                  </table>
                  <form action="" method="POST">
                    <input type="hidden" name="kd_buku" value="<?= $_GET['kd_buku']; ?>">
                    <input type="hidden" name="id_user" value="<?= $_COOKIE['id']; ?>">
                    <div class="text-right mr-3 mt-5">
                      <button type="submit" name="koleksi" class="btn btn-sm pt-2 pb-2 btn-warning text-left">Tambah Koleksi <i class="fa fa-plus"></i></button>
                  </form>
                  <a href="transaksi-peminjaman.php?kd_buku=<?= $data['id_buku']; ?>" class="btn btn-sm pt-2 pb-2 btn-success
                     text-left">Pinjam Buku <i class="fa fa-book"></i></a>
                </div>
              </div>
            </div><!-- /.box -->
          </div>

        </div>
      </div>
      <!-- <div class="row mt-5">
          <div class="col-md-3">
            <div class="h5">Tags</div><a class="mr-1 badge badge-primary" href="#"><?= $data['judul']; ?></a><a class="mr-1 badge badge-primary" href="#"><?= $data['judul']; ?></a><a class="badge badge-primary" href="#">Flower</a>
            <div class="h5 pt-4">Date</div>
            <p><?= $data['created_at']; ?></p>
          </div>
          <div class="col-md-9">
            <p><?= $data['penerbit']; ?></p>

          </div>
        </div> -->
    </div>
    <div class="pp-section"></div>
  </div>
  </div>
  <div class="container mt-5">
    <h2>Penilaian Buku Perpustakaan</h2>
    <!-- Form untuk menambah komentar -->
    <!-- <form>
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" class="form-control" id="username" name="username">
      </div>
      <div class="form-group">
        <label for="comment">Tambahkan Komentar:</label>
        <textarea class="form-control" id="comment" rows="3"></textarea>
      </div>
      <div class="form-group">
        <label for="rating">Rating:</label>
        <div class="stars">
          <i class="fas fa-star text-warning" data-rating="1"></i>
          <i class="far fa-star text-warning" data-rating="2"></i>
          <i class="far fa-star text-warning" data-rating="3"></i>
          <i class="far fa-star text-warning" data-rating="4"></i>
          <i class="far fa-star text-warning" data-rating="5"></i>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Kirim</button>
    </form> -->

    <!-- Komentar-komentar -->
    <div class="comments mt-4">
      <div class="comment">
        <div class="d-flex align-items-center">
          <img src="../uploads/new-default.png" alt="Profile Image" class="rounded-circle mr-2" style="width: 50px;">
          <strong>Unknow</strong>
        </div>
        <div class="stars mt-2">
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
          <i class="fas fa-star"></i>
        </div>
        <p>Ini adalah buku yang sangat bagus. Terima kasih!</p>
        <div class="replies mt-3">
          <div class="comment">
            <div class="d-flex align-items-center">
              <img src="../uploads/new-default.png" alt="Profile Image" class="rounded-circle mr-2" style="width: 50px;">
              <strong>Admin</strong>
            </div>
            <p>Terima kasih telah berkomentar!</p>
          </div>
        </div>
      </div>
      <?php
      $ulasan = mysqli_query($conn, "SELECT * FROM tb_ulasan INNER JOIN tb_anggota ON tb_ulasan.id_anggota = tb_anggota.id_anggota WHERE tb_ulasan.id_buku = '" . $_GET['kd_buku'] . "'");
      while ($u = mysqli_fetch_assoc($ulasan)) {
      ?>
        <div class="comment">
          <div class="d-flex align-items-center">
            <img src="../uploads/profil/<?= $u['foto']; ?>" alt="Profile Image" class="rounded-circle mr-2" style="width: 50px; height:50px;">
            <strong><?= $u['nama']; ?></strong>
          </div>
          <!-- bagian rating -->
          <div class="stars mt-2">
            <?php if ($u['rating'] == "1") { ?>
              <i class="fas fa-star"></i>
              <i class="far fa-star "></i>
              <i class="far fa-star "></i>
              <i class="far fa-star "></i>
              <i class="far fa-star"></i>
            <?php } else if ($u['rating'] == "2") { ?>
              <i class="fas fa-star"></i>
              <i class="fas fa-star "></i>
              <i class="far fa-star "></i>
              <i class="far fa-star "></i>
              <i class="far fa-star"></i>
            <?php } else if ($u['rating'] == "3") { ?>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="far fa-star"></i>
              <i class="far fa-star"></i>
            <?php } else if ($u['rating'] == "4") { ?>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="far fa-star"></i>
            <?php } else { ?>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            <?php } ?>
          </div>
          <p><?= $u['ulasan']; ?></p>
          <?php if ($u['balasan'] != '') { ?>
            <div class="replies mt-3">
              <div class="comment">
                <div class="d-flex align-items-center">
                  <img src="../uploads/new-default.png" alt="Admin Profile Image" class="rounded-circle mr-2" style="width: 50px;">
                  <strong>Admin</strong>
                </div>
                <p><?= $u['balasan']; ?></p>
                <i class="text-secondary" style="font-size:12px;"><?= $u['tgl_balasan']; ?></i>
              </div>
            </div>
          <?php } ?>
          <i class="text-secondary" style="font-size:12px;"><?= $u['tgl_ulasan']; ?></i>
        </div>
      <?php } ?>
    </div>
  </div>
  <footer class="pp-footer">
    <div class="container py-5">
      <div class="row text-center">
        <div class="col-md-12"><a class="pp-facebook btn btn-link" href="#"><i class="fab fa-facebook-f fa-2x " aria-hidden="true"></i></a><a class="pp-twitter btn btn-link " href="#"><i class="fab fa-twitter fa-2x " aria-hidden="true"></i></a><a class="pp-youtube btn btn-link" href="#"><i class="fab fa-youtube fa-2x" aria-hidden="true"></i></a><a class="pp-instagram btn btn-link" href="#"><i class="fab fa-instagram fa-2x " aria-hidden="true"></i></a></div>
        <div class="col-md-12">
          <p class="mt-3">Copyright &copy; FahmiCode. All rights reserved.<br>Design - <a class="credit" href="https://templateflip.com" target="_blank">TemplateFlip</a></p>
        </div>
      </div>
    </div>
  </footer>
  <div style="display:none;width: 100%;" class="cuss" id="Search">

    <form action="" method="GET" class="tengah-tengah px-3">
      <div class="input-group">
        <input name="judul" type="text" placeholder="Cari Judul Buku.." class="form-control mr-2">
        <div class="input-group-append">
          <button type="submit" name="cari" class="btn btn-primary px-3">Search</button>
        </div>
    </form>
  </div>
  </div>
  <script src="../scripts/jquery.min.js?ver=1.2.0"></script>
  <script src="../bootstrap.bundle.min.js?ver=1.2.0"></script>
  <script src="../scripts/main.js?ver=1.2.0"></script>
</body>

</html>