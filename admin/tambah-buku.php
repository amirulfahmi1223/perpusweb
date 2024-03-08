<?php
include "sidebar.php";
//ambil Id terbesar di kolom id pendaftaran,lalu ambil 5 karakter aja dari sebelah kanan 
$getMaxId = mysqli_query($conn, "SELECT MAX(RIGHT(id_buku, 4)) AS id FROM tb_buku");
$d = mysqli_fetch_object($getMaxId);
$generateId = 'BK-' . sprintf("%04s", $d->id + 1);
if (isset($_POST['tambah'])) {
  $kode = $_POST['kode'];
  $judul = $_POST['judul'];
  $penulis = $_POST['penulis'];
  $penerbit = $_POST['penerbit'];
  $jumlah = $_POST['jumlah'];
  $lokasi = $_POST['lokasi'];
  $tahun = $_POST['tahun'];
  $kat = $_POST['kategori'];

  $currdate = date('Y-m-d');
  $id = $_POST['id_admin'];
  $filename = $_FILES['gambar']['name'];
  $tmpname = $_FILES['gambar']['tmp_name'];
  $filesize = $_FILES['gambar']['size'];

  $formatfile = pathinfo($filename, PATHINFO_EXTENSION);
  $rename = 'buku' . time() . '.' . $formatfile;

  //validasi file yang boleh masuk
  $allowedtype = array('webp', 'png', 'jpg', 'jpeg', 'jfif', 'gif', 'JPG', 'PNG', 'JPEG', 'JFIF', 'WEBP');
  //cek jika ukurannya terlalu besar
  if ($filesize > 200000000) {
    echo "<div class='alert alert-error'>Ukuran File Tidak Boleh Lebih dari 10 Mb</div>";
    return false;
  }
  if (!in_array($formatfile, $allowedtype)) {
    echo "<div class='alert alert-error'>Format File Tidak diIzinkan!</div>";
  } else {
    move_uploaded_file($tmpname, "../uploads/buku/" . $rename);
    $simpan = mysqli_query($conn, "INSERT INTO tb_buku VALUES(
              '" . $kode . "',
              '" . $judul . "',
              '" . $penulis . "',
              '" . $penerbit . "',
              '" . $tahun . "',
              '" . $kat . "',
              '" . $jumlah . "',
              '" . $lokasi . "',
              '" . $rename . "',
              '" . $id . "',
              '" . $currdate . "'
            )");
    if ($simpan) {
      echo "<script>alert('Tambah Buku Berhasil')</script>";
      echo "<script>window.location='tambah-buku.php'</script>";
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
          <input type="text" name="kode" value="<?= $generateId ?>" class="form-control" readonly>
        </div>
        <div class="form-group col-6">
          <label class="samll">Kategori Buku :</label>
          <select name="kategori" class="form-control" required>
            <option value="">-- Pilih Kategori --</option>
            <?php
            $kategori = mysqli_query($conn, "SELECT * FROM tb_kategori");
            while ($k = mysqli_fetch_array($kategori)) {
            ?>
              <option value="<?= $k['id_kategori'] ?>"><?= $k['nama_kategori']; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group col-6">
          <label class="samll">Judul Buku :</label>
          <input type="text" name="judul" placeholder="Masukkan Judul" class="form-control" required>
        </div>
        <div class="form-group col-6">
          <label class="samll">Penulis :</label>
          <input type="text" placeholder="Masukkan Penulis" name="penulis" class="form-control" required>
        </div>
        <div class="form-group col-6">
          <label class="samll">Penerbit :</label>
          <input type="text" placeholder="Masukkan Penerbit" name="penerbit" class="form-control" required>
          <input type="hidden" name="id_admin" value="<?= $_COOKIE['id_admin']; ?>">
        </div>

        <div class="form-group col-6">
          <label class="samll">Jumlah Buku :</label>
          <input type="number" placeholder="Masukkan Jumlah" name="jumlah" class="form-control" required>
        </div>
        <div class="form-group col-6">
          <label class="samll">Lokasi Buku :</label>
          <input type="text" placeholder="Masukkan Rak" name="lokasi" class="form-control" required>
        </div>

        <div class="form-group col-6">
          <label class="samll">Tahun Terbit :</label>
          <input type="date" name="tahun" class="form-control" required>
        </div>
        <div class="form-group col-6">
          <label class="samll">Gambar Buku :</label>
          <input type="file" name="gambar" class="form-control" required>
        </div>
      </div>
      <div class="text-left mt-2">
        <button type="button" class="btn btn-secondary text-left" onclick="history.back(-1)">Kembali</button>
        <button type="submit" name="tambah" class="btn btn-primary">Tambah Buku</button>
      </div>
    </div>
  </form>
</div>
<!-- end isinya -->
<?php include "footer.php" ?>