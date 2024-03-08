<?php
include "sidebar.php";
error_reporting(0);
if ($_GET['id_buku'] == "") {
  echo "<script>window.location='data-buku.php'</script>";
}

$query = mysqli_query($conn, "SELECT * FROM tb_buku WHERE id_buku = '" . $_GET['id_buku'] . "'");
$b = mysqli_fetch_assoc($query);
//mengecek data di table
// if (mysqli_num_rows($data) < 0) {
//   echo "<script>window.location='data-buku.php'</script>";
//   echo "<script>alert('Hak Akses diTolak')</script>";
// }


if (isset($_POST['edit'])) {
  $kode = $_POST['kode'];
  $judul = $_POST['judul'];
  $penulis = $_POST['penulis'];
  $penerbit = $_POST['penerbit'];
  $jumlah = $_POST['jumlah'];
  $lokasi = $_POST['lokasi'];
  $tahun = $_POST['tahun'];
  $kat = $_POST['kategori'];

  $currdate = date('Y-m-d');
  $id = $_GET['id_buku'];
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
      if (file_exists("../uploads/buku/" . $_POST['foto2'])) {
        unlink("../uploads/buku/" . $_POST['foto2']);
      }
      move_uploaded_file($tmpname, "../uploads/buku/" . $rename);
    }
  } else {
    $rename = $_POST['foto2'];
  }
  $update = mysqli_query($conn, "UPDATE tb_buku SET 
  judul = '" . $judul . "',
  penulis = '" . $penulis . "',
  penerbit = '" . $penerbit . "',
  th_terbit = '" . $tahun . "',
  id_kategori = '" . $kat . "',
  jumlah_buku = '" . $jumlah . "',
  lokasi = '" . $lokasi . "',
  gambar = '" . $rename . "'
  WHERE id_buku = '" . $id . "'
");
  if ($update) {
    echo "<script>alert('Update Berhasil')</script>";
    echo '<script>history.go(-1);</script>';
  } else {
    echo "<div class='alert alert-error'>Simpan Gagal</div>";
    echo '<script>history.go(-1);</script>';
  }
  // if ($simpan) {
  //   echo "<div class='alert alert-succes'>Simpan Berhasil</div>";
  // } else {
  //   echo "<div class='alert alert-error'>Simpan Gagal</div>";
  // }
}

?>
<!-- isinya -->
<h1 class="h3 mb-0">
  Tambah Buku
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
          <label class="samll">Kode Buku :</label>
          <input type="text" name="kode" value="<?= $b['id_buku']; ?>" class="form-control" readonly>
        </div>
        <div class="form-group col-6">
          <label class="samll">Kategori Buku :</label>
          <select name="kategori" class="form-control" required>
            <option value="">-- Pilih Kategori --</option>
            <?php
            $kategori = mysqli_query($conn, "SELECT * FROM tb_kategori");
            while ($k = mysqli_fetch_array($kategori)) {
            ?>
              <option value="<?php echo $k['id_kategori'] ?>" <?= ($b['id_kategori'] == $k['id_kategori']) ? 'selected' : ''; ?>><?php echo $k['nama_kategori'] ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group col-6">
          <label class="samll">Judul Buku :</label>
          <input type="text" name="judul" value="<?= $b['judul']; ?>" placeholder="Masukkan Judul" class="form-control" required>
        </div>
        <div class="form-group col-6">
          <label class="samll">Penulis :</label>
          <input type="text" value="<?= $b['penulis']; ?>" placeholder="Masukkan Penulis" name="penulis" class="form-control" required>
        </div>
        <div class="form-group col-6">
          <label class="samll">Penerbit :</label>
          <input type="text" value="<?= $b['penerbit']; ?>" placeholder="Masukkan Penerbit" name="penerbit" class="form-control" required>
          <input type="hidden" name="id_admin" value="<?= $_COOKIE['id_admin']; ?>">
        </div>

        <div class="form-group col-6">
          <label class="samll">Jumlah Buku :</label>
          <input type="number" value="<?= $b['jumlah_buku']; ?>" placeholder="Masukkan Jumlah" name="jumlah" class="form-control" required>
        </div>
        <div class="form-group col-6">
          <label class="samll">Lokasi Buku :</label>
          <input type="text" value="<?= $b['lokasi']; ?>" placeholder="Masukkan Rak" name="lokasi" class="form-control" required>
        </div>

        <div class="form-group col-6">
          <label class="samll">Tahun Terbit :</label>
          <input type="date" value="<?= $b['th_terbit']; ?>" name="tahun" class="form-control" required>
        </div>
        <div class="form-group col-6">
          <label class="samll">Gambar Buku :</label>
          <br>
          <img src="../uploads/buku/<?= $b['gambar']; ?>" height="80px" width="80px" alt="" class="mt-1 mb-3">
          <input type="file" name="foto" class="form-control">
          <input type="hidden" name="foto2" value="<?= $b['gambar']; ?>">
        </div>
      </div>
      <div class="text-left mt-2">
        <button type="button" class="btn btn-secondary text-left" onclick="history.back(-1)">Kembali</button>
        <button type="submit" name="edit" class="btn btn-primary">Edit Buku</button>
      </div>
    </div>
  </form>
</div>
<!-- end isinya -->
<?php include "footer.php" ?>