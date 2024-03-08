<?php
include "sidebar.php";
if ($_GET['id_anggota'] == "") {
  echo "<script>window.location='data-admin.php'</script>";
}

$query = mysqli_query($conn, "SELECT * FROM tb_anggota WHERE id_anggota = '" . $_GET['id_anggota'] . "'");
$p = mysqli_fetch_assoc($query);
//ambil Id terbesar di kolom id pendaftaran,lalu ambil 5 karakter aja dari sebelah kanan 
if (isset($_POST['edit'])) {
  $nama = htmlspecialchars($_POST["nama"]);
  $user = htmlspecialchars($_POST["username"]);
  $nisn = htmlspecialchars($_POST["nisn"]);
  $kelas = htmlspecialchars($_POST["kelas"]);
  $password = htmlspecialchars($_POST["password"]);
  $status = $_POST['status'];
  $id = $_POST["id"];
  $currdate = date('Y-m-d H:i:s');
  if ($_FILES['foto']['name'] != '') {
    $filename = $_FILES['foto']['name'];
    $tmpname = $_FILES['foto']['tmp_name'];
    $filesize = $_FILES['foto']['size'];

    $formatfile = pathinfo($filename, PATHINFO_EXTENSION);
    $rename = 'profil' . time() . '.' . $formatfile;

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
  $update = mysqli_query($conn, "UPDATE tb_anggota SET
    password = '" . $password . "',
    status = '" . $status . "',
    nama = '" . $nama . "',
    kelas = '" . $kelas . "',
    nisn = '" . $nisn . "',
    updated_at = '" . $currdate . "',
    foto = '" . $rename . "'
    WHERE id_anggota = '" . $id . "'
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
  Edit Anggota
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
          <input type="text" name="kode" value="<?= $p['id_anggota']; ?>" class="form-control" readonly>
        </div>
        <div class="form-group col-6">
          <label class="samll">Nama Lengkap :</label>
          <input type="text" name="nama" value="<?= $p['nama']; ?>" placeholder="Masukkan Nama Lengkap" class="form-control" required>
        </div>
        <div class="form-group col-6">
          <label class="samll">Nisn :</label>
          <input type="number" value="<?= $p['nisn']; ?>" placeholder="Masukkan Nisn" name="nisn" class="form-control" required>
        </div>
        <div class="form-group col-6">
          <label class="samll">Kelas :</label>
          <input type="text" value="<?= $p['kelas']; ?>" placeholder="Masukkan Kelas" name="kelas" class="form-control" required>
        </div>

        <div class="form-group col-6">
          <label class="samll">Username :</label>
          <input type="text" value="<?= $p['username']; ?>" placeholder="Masukkan Username" name="username" class="form-control" readonly>
        </div>
        <div class="form-group col-6">
          <label class="samll">Password :</label>
          <input type="text" value="<?= $p['password']; ?>" placeholder="Masukkan Password" name="password" class="form-control" required>
          <input type="hidden" name="id" value="<?= $p['id_anggota'] ?>">
        </div>
        <div class="form-group col-6">
          <label class="samll">Status :</label>
          <select name="status" id="" class="form-control" required>
            <option value="">-- Pilih --</option>
            <option value="1" <?= $p['status'] = 1 ? "selected" : ""; ?>>Aktif</option>
            <option value="0" <?= $p['status'] = 0 ? "selected" : ""; ?>>Tidak Aktif</option>
          </select>
        </div>
      </div>
      <div class="form-group col-6">
        <label class="samll">Upload Foto :</label>
        <br>
        <img src="../uploads/profil/<?= $p['foto']; ?>" height="80px" width="80px" alt="" class="mt-1 mb-3">
        <input type="file" name="foto" class="form-control">
        <input type="hidden" name="foto2" value="<?= $p['foto']; ?>">
      </div>
      <div class="text-left mt-2">
        <button type="button" class="btn btn-secondary text-left" onclick="history.back(-1)">Kembali</button>
        <button type="submit" name="edit" class="btn btn-primary">Edit Data</button>
      </div>
    </div>
  </form>
</div>

<?php include "footer.php" ?>