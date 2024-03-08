<?php
include "sidebar.php";
//ambil Id terbesar di kolom id pendaftaran,lalu ambil 5 karakter aja dari sebelah kanan 
$getMaxId = mysqli_query($conn, "SELECT MAX(RIGHT(id_anggota, 4)) AS id FROM tb_anggota");
$d = mysqli_fetch_object($getMaxId);
$generateId = 'USR-' . sprintf("%04s", $d->id + 1);
if (isset($_POST['tambah'])) {
  //ambil Id terbesar di kolom id pendaftaran,lalu ambil 5 karakter aja dari sebelah kanan 
  $getMaxId = mysqli_query($conn, "SELECT MAX(RIGHT(id_anggota, 4)) AS id FROM tb_anggota");
  $d = mysqli_fetch_object($getMaxId);
  $generateId = 'USR-' . sprintf("%04s", $d->id + 1);
  $nama = htmlspecialchars($_POST["nama"]);
  $user = htmlspecialchars($_POST["username"]);
  $nisn = htmlspecialchars($_POST["nisn"]);
  $kelas = htmlspecialchars($_POST["kelas"]);
  $password = htmlspecialchars($_POST["password"]);
  $currdate = date('Y-m-d h:i:s');
  $status = 1;
  $foto = "new-default.png";
  $result = mysqli_query($conn, "SELECT username FROM tb_anggota WHERE username = '$user'");
  if (mysqli_fetch_assoc($result)) {
    $_SESSION['info'] = 'Username sudah terdaftar';
    echo '<script>window.location="tambah-anggota.php"</script>';
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
      echo '<script>window.location="tambah-anggota.php"</script>';
    } else {
      $_SESSION['info'] = 'Register Gagal';
      echo '<script>window.location="tambah-anggota.php"</script>';
    }
  }
}



?>
<!-- isinya -->
<h1 class="h3 mb-0">
  Tambah Anggota
  <div class="float-right">
    <p id="date_time" style="font-size: 14px; margin-top:11px"></p>
  </div>
</h1>
<hr>
<div class="modal-content border-0">
  <form method="POST" enctype="multipart/form-data">
    <div class="modal-body">
      <div class="row">
        <div class="form-group col-6">
          <label class="samll">Kode Anggota :</label>
          <input type="text" name="kode" value="<?= $generateId; ?>" class="form-control" readonly>
        </div>
        <div class="form-group col-6">
          <label class="samll">Nama Lengkap :</label>
          <input type="text" name="nama" placeholder="Masukkan Nama Lengkap" class="form-control" required>
        </div>
        <div class="form-group col-6">
          <label class="samll">Nisn :</label>
          <input type="number" placeholder="Masukkan Nisn" name="nisn" class="form-control" required>
        </div>
        <div class="form-group col-6">
          <label class="samll">Kelas :</label>
          <input type="text" placeholder="Masukkan Kelas" name="kelas" class="form-control" required>
        </div>

        <div class="form-group col-6">
          <label class="samll">Username :</label>
          <input type="text" placeholder="Masukkan Username" name="username" class="form-control" required>
        </div>
        <div class="form-group col-6">
          <label class="samll">Password :</label>
          <input type="password" placeholder="Masukkan Password" name="password" class="form-control" required>
        </div>

        <!-- 
        <div class="form-group col-6">
          <label class="samll">Upload Foto :</label>
          <input type="file" name="foto" class="form-control" required>
        </div> -->
      </div>
      <div class="text-left mt-2">
        <button type="button" class="btn btn-secondary text-left" onclick="history.back(-1)">Kembali</button>
        <button type="submit" name="tambah" class="btn btn-primary">Tambah Data</button>
      </div>
    </div>
  </form>
</div>
<!-- end isinya -->
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
<?php include "footer.php" ?>