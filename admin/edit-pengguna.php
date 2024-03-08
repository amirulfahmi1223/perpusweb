<?php
include "sidebar.php";
if ($_GET['id_user'] == "") {
  echo "<script>window.location='data-admin.php'</script>";
}

$query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE id = '" . $_GET['id_user'] . "'");
$p = mysqli_fetch_assoc($query);
//ambil Id terbesar di kolom id pendaftaran,lalu ambil 5 karakter aja dari sebelah kanan 
//edit
if (isset($_POST['edit'])) {
  $nama = htmlspecialchars($_POST["nama"]);
  $email = $_POST["email"];
  $telepon = htmlspecialchars($_POST["telepon"]);
  $level = $_POST["level"];
  $user = htmlspecialchars($_POST["username"]);
  $password = htmlspecialchars($_POST["password"]);
  $id = $_POST["id"];
  $currdate = date('Y-m-d H:i:s');
  if ($_FILES['foto']['name'] != '') {
    $filename = $_FILES['foto']['name'];
    $tmpname = $_FILES['foto']['tmp_name'];
    $filesize = $_FILES['foto']['size'];

    $formatfile = pathinfo($filename, PATHINFO_EXTENSION);
    $rename = 'image' . time() . '.' . $formatfile;

    //validasi file yang boleh masuk
    $allowedtype = array('webp', 'png', 'jpg', 'jpeg', 'jfif', 'gif', 'JPG', 'PNG', 'JPEG', 'JFIF', 'WEBP');
    if ($filesize > 200000000) {
      echo "<div class='alert alert-error'>Ukuran File Tidak Boleh Lebih dari 20 Mb</div>";
      return false;
    }
    if (!in_array($formatfile, $allowedtype)) {
      echo "<div class='alert alert-error'>Format File Tidak diIzinkan!</div>";
      return false;
    } else {
      //menghapus gambar yang lama kemudian upload yang baru
      if (file_exists("../uploads/profil/" . $_POST['foto2'])) {
        if ($_POST['foto2'] != "new-default.png") {
          unlink("../uploads/profil/" . $_POST['foto2']);
        }
      }
      move_uploaded_file($tmpname, "../uploads/profil/" . $rename);
    }
  } else {
    $rename = $_POST['foto2'];
  }
  $update = mysqli_query($conn, "UPDATE tb_admin SET
    password = '" . $password . "',
    level = '" . $level . "',
    nama = '" . $nama . "',
    telepon = '" . $telepon . "',
    email = '" . $email . "',
    updated_at = '" . $currdate . "',
    foto = '" . $rename . "'
    WHERE id = '" . $id . "'
  ");
  if ($update) {
    $_SESSION['info'] = 'Edit Pengguna Berhasil';
    echo '<script>history.go(-1);</script>';
  } else {
    $_SESSION['info'] = 'Edit Pengguna Gagal';
    echo '<script>history.go(-1);</script>';
  }
}



?>
<!-- isinya -->
<h1 class="h3 mb-0">
  Edit Data
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
          <input type="text" name="nama" value="<?= $p['nama']; ?>" placeholder="Masukkan Nama Lengkap" class="form-control" required>
        </div>
        <div class="form-group col-6">
          <label class="samll">Email :</label>
          <input type="email" value="<?= $p['email']; ?>" placeholder="Masukkan Email" name="email" class="form-control" required>
        </div>
        <div class="form-group col-6">
          <label class="samll">Telepon :</label>
          <input type="number" value="<?= $p['telepon']; ?>" placeholder="Masukkan Telepon" name="telepon" class="form-control" required>
          <input type="hidden" name="id_admin" value="<?= $_COOKIE['id_admin']; ?>">
        </div>

        <div class="form-group col-6">
          <label class="samll">Username :</label>
          <input type="text" value="<?= $p['username']; ?>" placeholder="Masukkan Username" name="username" class="form-control" readonly>
        </div>
        <div class="form-group col-6">
          <label class="samll">Password :</label>
          <input type="text" value="<?= $p['password']; ?>" placeholder="Masukkan Rak" name="password" class="form-control" required>
          <input type="hidden" name="id" value="<?= $p['id']; ?>">
        </div>
        <div class="form-group col-6">
          <label class="samll">Level :</label>
          <select name="level" class="form-control" required>
            <option value="">-- Pilih Level --</option>
            <option value="">-- Pilih --</option>
            <option value="Admin" <?= $p['level'] == "Admin" ? "selected" : "" ?>>Admin</option>
            <option value="Petugas" <?= $p['level'] == "Petugas" ? "selected" : "" ?>>Petugas</option>
          </select>
        </div>
        <div class="form-group col-6">
          <label class="samll">Upload Foto :</label>
          <br>
          <img src="../uploads/profil/<?= $p['foto']; ?>" height="80px" width="80px" alt="" class="mt-1 mb-3">
          <input type="file" name="foto" class="form-control">
          <input type="hidden" name="foto2" value="<?= $p['foto']; ?>">
        </div>
      </div>
      <div class="text-left mt-2">
        <button type="button" class="btn btn-secondary text-left" onclick="history.back(-1)">Kembali</button>
        <button type="submit" name="edit" class="btn btn-primary">Edit Data</button>
      </div>
    </div>
  </form>
</div>
<!-- end isinya -->
<?php include "footer.php" ?>