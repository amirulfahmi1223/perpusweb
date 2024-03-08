<?php
session_start();
include '../connection/koneksi.php';
date_default_timezone_set("Asia/jakarta");
if (!isset($_SESSION["status_login"])) {
  echo '<script>window.location="login.php"</script>';
}
$query = "SELECT * FROM tb_admin WHERE id = '" .  $_COOKIE['id_admin'] . "'";
$run = mysqli_query($conn, $query);
$d = mysqli_fetch_array($run);
// if ($d['status'] == 0) {
//   echo '<script>window.location="../blokir-pengguna.php"</script>';
// }


?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PerPusWeb | SMKN 4 BOJONEGORO</title>
  <link rel="icon" href="../image/background/favicon.ico">
  <link rel="icon" href="../image/background/favicon.ico" type="image/ico">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link href="../assets/css/style.css" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link href="../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="../assets/vendor/datatables/responsive.bootstrap4.min.css" rel="stylesheet">
</head>

<body>
  <div class="info-data" data-infodata="<?php if (isset($_SESSION['info'])) {
                                          echo $_SESSION['info'];
                                        }
                                        unset($_SESSION['info']); ?>"></div>
  <div class="page-wrapper chiller-theme toggled">
    <a id="show-sidebar" class="btn btn-sm btn-primary border-0" href="#">
      <i class="fas fa-bars"></i>
    </a>
    <nav id="sidebar" class="sidebar-wrapper">
      <div class="sidebar-content">
        <div class="sidebar-brand">
          <a href="./"><i class="fa fa-credit-card mr-1"></i>PerPus Web</a>
          <div id="close-sidebar">
            <i class="fas fa-times"></i>
          </div>
        </div>
        <div class="sidebar-header">
          <div class="user-pic" style="height:70px;width:70px;">
            <img class="img-responsive img-rounded" src="../uploads/profil/<?= $d['foto']; ?>" alt="User picture">
          </div>
          <div class="user-info">
            <span class="user-name"><?= $d['nama']; ?>
            </span>
            <span class="user-role"><?= $d['level'] ?></span>
            <span class="user-status">
              <i class="fa fa-circle"></i>
              <span>Online</span>
            </span>
          </div>
        </div>
        <!-- sidebar-header  -->
        <div class="sidebar-menu">
          <ul>
            <li class="header-menu">
              <span>General</span>
            </li>
            <li>
              <a href="index.php">
                <i class="fas fa-home"></i>
                <span>Beranda</span>
              </a>
            </li>
            <li>
              <a href="transaksi.php">
                <i class="fa fa-tv"></i>
                <span>Transaksi</span>
              </a>
            </li>
            </li>
            <li>
              <a href="kategori.php">
                <i class="fa fa-fw fa-bookmark"></i>
                <span>Data Kategori</span>
              </a>
            </li>
            <li>
              <a href="data-buku.php">
                <i class="fa fa-book"></i>
                <span>Data Buku</span>
              </a>
            </li>
            <li>
              <a href="data-anggota.php">
                <i class="fas fa-globe"></i>
                <span>Data Anggota</span>
              </a>
            </li>
            <?php
            if ($d['level'] == "Admin") { ?>
              <li>
                <a href="data-admin.php">
                  <i class="fas fa-users"></i>
                  <span>Data Pengguna</span>
                </a>
              </li>
            <?php  }  ?>
            <li>
              <a href="pengaturan.php">
                <i class="fa fa-cog"></i>
                <span>Pengaturan</span>
              </a>
            </li>
            <li>
              <a href="#Exit" data-toggle="modal">
                <i class="fa fa-power-off"></i>
                <span>Keluar</span>
              </a>
            </li>
          </ul>
        </div>
        <!-- sidebar-menu  -->
      </div>
      <div class="sidebar-footer">
        © 2024 Developed by - <a target="_blank" rel="noopener noreferrer" href="https://fahmi965.000webhostapp.com/Portofolio.html">
          FahmiCode</a>
      </div>
    </nav>
    <!-- sidebar-wrapper  -->
    <main class="page-content">
      <div class="container-fluid">
        <div class="d-block d-sm-block d-md-none d-lg-none py-2"></div>