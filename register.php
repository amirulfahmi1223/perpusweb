<?php
date_default_timezone_set("Asia/jakarta");
session_start();
include "connection/koneksi.php";
if (isset($_COOKIE['remember'])) {
  //cek value
  if ($_COOKIE['remember'] == 'true') {
    //set session true
    $_SESSION['login_user'] = true;
  }
}
if (isset($_SESSION["login_user"])) {
  echo '<script>window.location="login.php"</script>';
}
if (isset($_POST['register'])) {
  //ambil Id terbesar di kolom id pendaftaran,lalu ambil 5 karakter aja dari sebelah kanan 
  $getMaxId = mysqli_query($conn, "SELECT MAX(RIGHT(id_anggota, 4)) AS id FROM tb_anggota");
  $d = mysqli_fetch_object($getMaxId);
  $generateId = 'USR-' . sprintf("%04s", $d->id + 1);
  $nama = htmlspecialchars($_POST["nama"]);
  $user = htmlspecialchars($_POST["user"]);
  $nisn = htmlspecialchars($_POST["nisn"]);
  $kelas = htmlspecialchars($_POST["kelas"]);
  $password = htmlspecialchars($_POST["pass1"]);
  $currdate = date('Y-m-d h:i:s');
  $status = 1;
  $foto = "new-default.png";
  if ($_POST['pass2'] != $password) {
    $_SESSION['info'] = 'Konfirmasi Password Salah!';
    echo '<script>window.location="register.php"</script>';
  } else {
    $result = mysqli_query($conn, "SELECT username FROM tb_anggota WHERE username = '$user'");
    if (mysqli_fetch_assoc($result)) {
      $_SESSION['info'] = 'Username sudah terdaftar';
      echo '<script>window.location="register.php"</script>';
    } else {
      $insert = mysqli_query($conn, "INSERT INTO tb_anggota VALUES(
        '" . $generateId . "',
        '" . $nisn . "',
        '" . $nama . "',
        '" . $kelas . "',
        '" . $user . "',
        '" . $password . "',
        '" . $foto . "',
        '" . $currdate . "',
        null,
        '" . $status . "'
      )");
      if ($insert) {
        $_SESSION['info'] = 'Register Berhasil';
        echo '<script>window.location="login.php"</script>';
      } else {
        $_SESSION['info'] = 'Register Gagal';
        echo '<script>window.location="register.php"</script>';
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="image/background/favicon.ico">
  <link rel="icon" href="image/background/favicon.ico" type="image/ico">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Register | User</title>
  <link rel="icon" type="image/x-icon" href="assets/atr.jpeg" />
  <!-- Custom fonts for this template-->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
  <!-- SWAL -->
  <div class="info-data" data-infodata="<?php if (isset($_SESSION['info'])) {
                                          echo $_SESSION['info'];
                                        }
                                        ?>"></div>
  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="user" method="POST">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" name="nisn" class="form-control form-control-user" id="exampleInputUsername" placeholder="Masukkan Nisn" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="text" name="nama" class="form-control form-control-user" id="exampleInputUsername" placeholder="Masukkan Nama Lengkap" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6">
                    <input type="text" name="user" class="form-control form-control-user" id="exampleInputUsername" placeholder="Masukkan username anda" required>
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" name="kelas" class="form-control form-control-user" id="exampleInputUsername" placeholder="Masukkan kelas anda" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" name="pass1" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" required>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" name="pass2" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password" required>
                  </div>
                </div>
                <input type="submit" name="register" class="btn btn-primary btn-user btn-block" value="Register Account">

              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="login.php">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="assets/js/sb-admin-2.min.js"></script>
  <!-- Swal -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.15.2/dist/sweetalert2.all.min.js"></script>
  <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
  <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
  <script>
    const notifikasi = $('.info-data').data('infodata');

    if (notifikasi == "Register Gagal" || notifikasi == "Konfirmasi Password Salah!" || notifikasi == "Username sudah terdaftar") {
      Swal.fire({
        icon: 'error',
        title: 'GAGAL',
        text: notifikasi,
      })
    }
  </script>
</body>

</html>