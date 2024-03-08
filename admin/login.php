<?php
include "../connection/koneksi.php";
session_start();

if (isset($_COOKIE['login_admin'])) {
  if ($_COOKIE['login_admin'] == 'true') {
    $_SESSION['status_login'] = true;
  }
}
if (isset($_SESSION["status_login"])) {
  echo '<script>window.location="index.php"</script>';
}
if (isset($_POST["login"])) {
  $user = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $status = 1;
  //cek akun ada apa tidak
  $cek = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '" . $user . "' AND password = '" . $password . "'");
  if (mysqli_num_rows($cek) > 0) {
    $d = mysqli_fetch_object($cek);
    $aktif = 1;
    if ($d->status == $aktif) {
      $_SESSION['status_login'] = true;
      $id = $d->id;
      setcookie('login_admin', 'true', time() + 950400); //waktu 11 hari
      setcookie('id_admin', $id, time() + (11 * 24 * 60 * 60));
      //cek remember me
      if (isset($_POST['remember'])) {
        setcookie('remember', 'true', time() + 950400); //waktu 11 hari
        setcookie('id', $id, time() + 950400);
      }
      $_SESSION['info'] = 'Login Berhasil';
      echo '<script>window.location="index.php"</script>';
    } else {
      $_SESSION['info'] = 'Akun Anda Telah diBlokir!';
      echo '<script>window.location="login.php"</script>';
    }
  } else {
    $_SESSION['info'] = 'Login Gagal';
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="../image/background/favicon.ico">
  <link rel="icon" href="../image/background/favicon.ico" type="image/ico">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Login | Administator</title>
  <link rel="icon" type="image/x-icon" href="assets/atr.jpeg" />
  <!-- Custom fonts for this template-->
  <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>
<style>
  .divider:after,
  .divider:before {
    content: "";
    flex: 1;
    height: 1px;
    background: #eee;
  }

  .h-custom {
    height: calc(100% - 73px);
  }

  @media (max-width: 450px) {
    .h-custom {
      height: 100%;
    }
  }
</style>

<body>
  <div class="info-data" data-infodata="<?php if (isset($_SESSION['info'])) {
                                          echo $_SESSION['info'];
                                        }
                                        ?>"></div>
  <section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img src="../image/knowledge-monochromatic.svg" class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          <form method="POST">
            <div class="text-center">
              <h3>L O G I N</h3>

            </div>

            <div class="divider d-flex align-items-center my-4">
              <p class="text-center fw-bold mx-3 mb-0">
                <button type="button" class="btn btn-primary btn-floating mx-1">
                  <i class="fa fa-user"></i>
                </button>
              </p>
            </div>

            <!-- Email input -->
            <div class="form-outline mb-4">
              <label class="form-label" for="form3Example3">Username</label>
              <input type="text" name="username" id="form3Example3" class="form-control form-control-lg" placeholder="Masukkan Username" />
            </div>

            <!-- Password input -->
            <div class="form-outline mb-3">
              <label class="form-label" for="form3Example4">Password</label>
              <input type="password" name="password" id="form3Example4" class="form-control form-control-lg" placeholder="Masukkan Password" />
            </div>

            <div class="d-flex justify-content-between align-items-center">
              <!-- Checkbox -->
              <div class="form-check mb-0">
                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                <label class="form-check-label" for="form2Example3">
                  Remember me
                </label>
              </div>
              <a href="#!" class="text-body">Forgot password?</a>
            </div>

            <div class="text-lg-start mt-4 pt-2">
              <button type="submit" name="login" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">LOGIN</button>

            </div>

          </form>
        </div>
      </div>
    </div>
    <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
      <!-- Copyright -->
      <div class="text-white mb-3 mb-md-0">
        Copyright FahmiCode © 2024. All rights reserved.
      </div>
      <!-- Copyright -->

      <!-- Right -->
      <div>
        <a href="#!" class="text-white me-4">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="#!" class="text-white me-4">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="#!" class="text-white me-4">
          <i class="fab fa-google"></i>
        </a>
        <a href="#!" class="text-white">
          <i class="fab fa-linkedin-in"></i>
        </a>
      </div>
      <!-- Right -->
    </div>
  </section>

  <!-- Bootstrap core JavaScript-->
  <script src="../assets/vendor/jquery/jquery.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../assets/js/sb-admin-2.min.js"></script>
  <!-- Swal -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.15.2/dist/sweetalert2.all.min.js"></script>
  <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
  <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
  <script>
    const notifikasi = $('.info-data').data('infodata');

    if (notifikasi == "Login Berhasil" || notifikasi == "Register Berhasil") {
      Swal.fire({
        icon: 'success',
        title: 'Sukses',
        text: notifikasi,
      })
    } else if (notifikasi == "Login Gagal") {
      Swal.fire({
        icon: 'error',
        title: 'GAGAL',
        text: 'Gagal, username atau password salah!',
      })
    } else if (notifikasi == "Akun Anda Telah diBlokir!") {
      Swal.fire({
        icon: 'error',
        title: 'GAGAL',
        text: notifikasi,
      })
    } else if (notifikasi == "Akun anda telah diblokir!") {
      Swal.fire({
        icon: 'warning',
        title: 'PERINGATAN',
        text: notifikasi,
      })
    }
  </script>
</body>

</html>