<?php
session_start();
include "../connection/koneksi.php";
if (!isset($_SESSION["login_user"])) {
  echo '<script>window.location="../login.php"</script>';
}
$query = "SELECT * FROM tb_anggota WHERE id_anggota = '" .  $_COOKIE['id'] . "'";
$run = mysqli_query($conn, $query);
$d = mysqli_fetch_array($run);
?>

<!DOCTYPE html>
<html lang="en-US">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Galeri - PerPusWeb</title>
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
                <li class="nav-item active"><a class="nav-link" href="index.php">Home</a>
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
          <div class="row">
            <div class="col-md-9 col-sm-12 px-0">
              <h1 class="h3"> Reading One Book is Like Eating One Potato Chip.</h1>
            </div>
          </div>
        </div>
        <div class="container px-0 py-4">
          <div class="pp-category-filter">
            <div class="row">
              <div class="col-sm-12"><a class="btn btn-primary pp-filter-button" href="galeri-buku.php" data-filter="all">All</a>
                <?php
                $kategori = mysqli_query($conn, "SELECT * FROM tb_kategori");
                while ($k = mysqli_fetch_assoc($kategori)) { ?>
                  <!-- data filter untuk memanggil datagroup -->
                  <a class="btn btn-outline-primary pp-filter-button" href="#" data-filter="<?= $k['nama_kategori']; ?>"><?= $k['nama_kategori']; ?></a>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
        <div class="container px-0">
          <div class="pp-gallery">
            <div class="card-columns">
              <?php
              if (!isset($_GET['judul'])) {
                $buku = mysqli_query($conn, "SELECT * FROM tb_buku INNER JOIN tb_kategori ON tb_buku.id_kategori = tb_kategori.id_kategori");
              } else {
                $judul = $_GET['judul'];
                $buku = mysqli_query($conn, "SELECT * FROM tb_buku INNER JOIN tb_kategori ON tb_buku.id_kategori = tb_kategori.id_kategori WHERE tb_buku.judul LIKE CONCAT('%', '" . $judul . "', '%')");
              }

              if (mysqli_num_rows($buku) > 0) {
                while ($p = mysqli_fetch_array($buku)) {
              ?>
                  <!-- datagroup untuk data yang dipangggil filter data yg ditampilkan -->
                  <div class="card" data-groups="[&quot;<?= $p['nama_kategori']; ?>&quot;]">
                    <a href="buku.php?kd_buku=<?= $p['id_buku']; ?>" alt="<?= $p['nama_kategori']; ?>" class="fancylight popup-btn" data-fancybox-group="light">
                      <figure class="pp-effect"><img class="img-fluid" src="../uploads/buku/<?= $p['gambar']; ?>" alt="<?= $p['nama_kategori']; ?>" onclick="openPopup('../uploads/buku/<?= $p['gambar']; ?>')" />
                        <figcaption>
                          <div class="h4 text-uppercase"><?= $p['judul']; ?></div>
                          <p><?= $p['nama_kategori']; ?></p>
                        </figcaption>
                      </figure>
                    </a>
                  </div>
                <?php
                }
              } else { ?>
                <center>
                  <p class="text-center">Tidak Ada Foto</p>
                </center>
              <?php } ?>
            </div>
          </div>
          <div class="pp-section"></div>
        </div>
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
  <script src="../scripts/bootstrap.bundle.min.js?ver=1.2.0"></script>
  <script src="../scripts/main.js?ver=1.2.0"></script>
</body>

</html>