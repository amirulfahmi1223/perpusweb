<?php
include "sidebar.php";
//ambil Id terbesar di kolom id pendaftaran,lalu ambil 5 karakter aja dari sebelah kanan 
if (isset($_POST['tambah'])) {

  $nama = htmlspecialchars($_POST["nama"]);
  $email = htmlspecialchars($_POST["email"]);
  $telepon = htmlspecialchars($_POST["telepon"]);
  $level = $_POST["level"];
  $user = htmlspecialchars($_POST["username"]);
  $password = htmlspecialchars($_POST["password"]);
  $currdate = date('Y-m-d h:i:m');
  $status = 1;
  $foto = "new-default.png";
  $result = mysqli_query($conn, "SELECT username FROM tb_admin WHERE username = '$user'");
  if (mysqli_fetch_assoc($result)) {
    $_SESSION['info'] = 'Username sudah terdaftar';
    echo '<script>window.location="tambah-pengguna.php"</script>';
  } else {
    $insert = mysqli_query($conn, "INSERT INTO tb_admin VALUES(
        '',
        '" . $nama . "',
        '" . $telepon . "',
        '" . $email . "',
        '" . $user . "',
        '" . $password . "',
        '" . $foto . "',
        '" . $level . "',
        '" . $currdate . "',
          null,
        '" . $status . "'
      )");
    if ($insert) {
      $_SESSION['info'] = 'Register Berhasil';
      echo '<script>window.location="data-admin.php"</script>';
    } else {
      $_SESSION['info'] = 'Register Gagal';
      echo '<script>window.location="data-admin.php"</script>';
    }
  }
}

?>
<!-- isinya -->
<h1 class="h3 mb-0">
  Tambah Pengguna
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
          <label class="samll">Nama Lengkap :</label>
          <input type="text" name="nama" placeholder="Masukkan Nama Lengkap" class="form-control" required>
        </div>
        <div class="form-group col-6">
          <label class="samll">Email :</label>
          <input type="email" placeholder="Masukkan Email" name="email" class="form-control" required>
        </div>
        <div class="form-group col-6">
          <label class="samll">Telepon :</label>
          <input type="number" placeholder="Masukkan Telepon" name="telepon" class="form-control" required>
          <input type="hidden" name="id_admin" value="<?= $_COOKIE['id_admin']; ?>">
        </div>

        <div class="form-group col-6">
          <label class="samll">Username :</label>
          <input type="text" placeholder="Masukkan Username" name="username" class="form-control" required>
        </div>
        <div class="form-group col-6">
          <label class="samll">Password :</label>
          <input type="password" placeholder="Masukkan Password" name="password" class="form-control" required>
        </div>
        <div class="form-group col-6">
          <label class="samll">Level :</label>
          <select name="level" class="form-control" required>
            <option value="">-- Pilih Level --</option>
            <option value="Admin">Admin</option>
            <option value="Petugas">Petugas</option>
          </select>
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
<?php include "footer.php" ?>