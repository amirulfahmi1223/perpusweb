<?php
include 'sidebar.php';
if (isset($_POST['tambah'])) {
  $judul = $_POST['judul'];
  $desk = $_POST['deskripsi'];
  $status = $_POST['status'];
  $currdate = date('Y-m-d H:i:s');
  $id = $_POST['id_pengguna'];
  $kat = $_POST['kat'];
  $filename = $_FILES['foto']['name'];
  $tmpname = $_FILES['foto']['tmp_name'];
  $filesize = $_FILES['foto']['size'];

  $formatfile = pathinfo($filename, PATHINFO_EXTENSION);
  $rename = 'image' . time() . '.' . $formatfile;

  //validasi file yang boleh masuk
  $allowedtype = array('png', 'jpg', 'jpeg', 'jfif', 'gif', 'JPG', 'PNG', 'JPEG', 'JFIF');
  //cek jika ukurannya terlalu besar
  if ($filesize > 20000000) {
    echo "<div class='alert alert-error'>Ukuran File Tidak Boleh Lebih dari 10 Mb</div>";
    return false;
  }
  if (!in_array($formatfile, $allowedtype)) {
    echo "<div class='alert alert-error'>Format File Tidak diIzinkan!</div>";
  } else {
    move_uploaded_file($tmpname, "../uploads/foto/" . $rename);
    $simpan = mysqli_query($conn, "INSERT INTO foto VALUES(
              '',
              '" . $judul . "',
              '" . $rename . "',
              '" . $desk . "',
              '" . $status . "',
              '" . $kat . "',
              '" . $id . "',
              '" . $currdate . "'
            )");
    if ($simpan) {
      echo "<script>alert('Tambah Foto Berhasil')</script>";
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
}
if (isset($_POST['edit'])) {
  $judul = $_POST['judul'];
  $desk = $_POST['deskripsi'];
  $status = $_POST['status'];
  $currdate = date('Y-m-d H:i:s');
  $kat = $_POST['kat'];
  $id = $_POST['id_foto'];
  if ($_FILES['foto']['name'] != '') {
    $filename = $_FILES['foto']['name'];
    $tmpname = $_FILES['foto']['tmp_name'];
    $filesize = $_FILES['foto']['size'];

    $formatfile = pathinfo($filename, PATHINFO_EXTENSION);
    $rename = 'image' . time() . '.' . $formatfile;

    //validasi file yang boleh masuk
    $allowedtype = array('png', 'jpg', 'jpeg', 'jfif', 'gif', 'JPG', 'PNG', 'JPEG', 'JFIF');
    if ($filesize > 20000000) {
      echo "<div class='alert alert-error'>Ukuran File Tidak Boleh Lebih dari 20 Mb</div>";
      return false;
    }
    if (!in_array($formatfile, $allowedtype)) {
      echo "<div class='alert alert-error'>Format File Tidak diIzinkan!</div>";
      return false;
    } else {
      //menghapus gambar yang lama kemudian upload yang baru
      if (file_exists("../uploads/foto/" . $_POST['foto2'])) {
        unlink("../uploads/foto/" . $_POST['foto2']);
      }
      move_uploaded_file($tmpname, "../uploads/foto/" . $rename);
    }
  } else {
    $rename = $_POST['foto2'];
  }
  $update = mysqli_query($conn, "UPDATE foto SET 
  judul = '" . $judul . "',
  id_kategori = '" . $kat . "',
  deskripsi = '" . $desk . "',
  foto = '" . $rename . "',
  status = '" . $status . "'
  WHERE id_foto = '" . $id . "'
");
  if ($update) {
    echo "<script>alert('Berhasil')</script>";
    echo '<script>history.go(-1);</script>';
  } else {
    echo "<div class='alert alert-error'>Edit Data Gagal</div>";
    echo '<script>history.go(-1);</script>';
  }
}
if (isset($_POST['ubah'])) {
  $pass1 = htmlspecialchars($_POST['pass1']);
  $pass2 = htmlspecialchars($_POST['pass2']);
  $id = $_POST['id_pengguna'];
  //query insert data

  //cek konfirmasi password
  if ($pass2 != $pass1) {
    echo '<script>alert("Konfirmasi Password Baru tidak sesuai")</script>';
  } else {
    $u_pass = mysqli_query($conn, "UPDATE pengguna SET 
     password = '" . $pass1 . "'
     WHERE id_pengguna = '" . $id . "'");
    if ($u_pass) {
      echo '<script>alert("Ubah Password berhasil")</script>';
      echo '<script>history.go(-1);</script>';
    } else {
      echo '<script>alert("Ubah Password Gagal");</script>' . mysqli_error($conn);
    }
  }
}

?>
<!-- isinya -->
<h1 class="h3 mb-0">
  Data Photo
  <button class="btn btn-primary btn-sm border-0 float-right" type="button" data-toggle="modal" data-target="#Tambah"><i class="fa fa-plus"></i> Tambah Foto</button>
</h1>
<hr>
<table class="table table-striped table-sm table-bordered dt-responsive nowrap text-center" id="table" width="100%">
  <thead>
    <tr>
      <th>No</th>
      <th>Judul</th>
      <th>Foto</th>
      <th>Deskripsi</th>
      <th>tanggal</th>
      <th>Status</th>
      <th>Opsi</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1;
    $foto = mysqli_query($conn, "SELECT * FROM foto WHERE created_by = '" . $_COOKIE['id'] . "'");
    while ($p = mysqli_fetch_array($foto)) {
    ?>

      <tr>
        <td><?= $no++; ?></td>
        <td><?= $p['judul']; ?></td>
        <td><a href="../uploads/foto/<?= $p['foto']; ?>" target="_blank"> <img src="../uploads/foto/<?= $p['foto']; ?>" height="70px" width="70px" alt=""></a></td>
        <td><?= substr($p['deskripsi'], 0, 30) ?></td>
        <td><?= $p['created_at']; ?></td>
        <td><?= ($p['status'] == 0) ? 'Tidak Aktif' : 'Aktif'; ?></a></td>
        <td>
          <button type="button" class="btn btn-primary btn-xs mr-1" data-toggle="modal" data-target="#Edit<?= $p['id_foto'] ?>">
            <i class="fas fa-pencil-alt fa-xs mr-1"></i>Edit
          </button>
          <a class="btn btn-danger btn-xs delete-data" href="hapus-foto.php?id_foto=<?= $p['id_foto'] ?>">
            <i class="fas fa-trash-alt fa-xs mr-1"></i>Hapus</a>
        </td>
      </tr>
      <!-- Modal edit -->
      <div class="modal fade" id="Edit<?= $p['id_foto'] ?>" tabindex=" -1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content border-0">
            <form action="" method="POST" enctype="multipart/form-data">
              <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Edit Foto</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label class="samll">Kategori Foto :</label>
                  <select name="kat" id="" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php
                    $kategori = mysqli_query($conn, "SELECT * FROM kategori WHERE created_by = '" . $_COOKIE['id'] . "'");
                    while ($k = mysqli_fetch_array($kategori)) {
                    ?>
                      <option value="<?php echo $k['id_kategori'] ?>" <?= ($p['id_kategori'] == $k['id_kategori']) ? 'selected' : ''; ?>><?php echo $k['nama_kategori'] ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <input type="hidden" value="52">
                  <label class="samll">Judul Foto :</label>
                  <input type="text" name="judul" placeholder="Masukkan Nama Foto" class="form-control" value="<?= $p['judul']; ?>" required>
                </div>
                <div class="form-group">
                  <label class="samll">Deskripsi :</label>
                  <textarea class="form-control" name="deskripsi" id="" cols="30" rows="10"><?= $p['deskripsi']; ?></textarea>
                </div>
                <div class="form-group">
                  <label class="samll">Status :</label>
                  <select name="status" id="" class="form-control" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="1" <?= ($p['status'] == 1) ? 'selected' : ''; ?>>Aktif</option>
                    <option value="0" <?= ($p['status'] == 0) ? 'selected' : ''; ?>>Tidak Aktif</option>
                  </select>
                </div>
                <div class="form-group">
                  <label class="samll">Upload Foto:</label>
                  <br>
                  <img src="../uploads/foto/<?= $p['foto']; ?>" height="80px" width="80px" alt="" class="mt-1 mb-3">
                  <input type="hidden" name="id_foto" value="<?= $p['id_foto']; ?>">
                  <input type="file" name="foto" class="form-control">
                  <input type="hidden" name="foto2" value="<?= $p['foto']; ?>">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                <button type="submit" name="edit" class="btn btn-primary">Edit</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    <?php } ?>
  </tbody>
</table>

<!-- Modal tambah -->
<div class="modal fade" id="Tambah" tabindex=" -1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content border-0">
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white">Tambah Foto</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label class="samll">Kategori Foto :</label>
            <select name="kat" id="" class="form-control" required>
              <option value="">-- Pilih Kategori --</option>
              <?php
              $kategori = mysqli_query($conn, "SELECT * FROM kategori WHERE created_by = '" . $_COOKIE['id'] . "'");
              while ($k = mysqli_fetch_array($kategori)) {
              ?>
                <option value="<?= $k['id_kategori'] ?>"><?= $k['nama_kategori']; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group">
            <input type="hidden" value="52">
            <label class="samll">Judul Foto :</label>
            <input type="text" name="judul" placeholder="Masukkan Nama Foto" class="form-control" required>
          </div>
          <div class="form-group">
            <label class="samll">Deskripsi :</label>
            <textarea class="form-control" name="deskripsi" id="" cols="14" rows="6"></textarea>
          </div>
          <div class="form-group">
            <label class="samll">Status :</label>
            <select name="status" id="" class="form-control" required>
              <option value="">-- Pilih Status --</option>
              <option value="1">Aktif</option>
              <option value="0">Tidak Aktif</option>
            </select>
          </div>
          <div class="form-group">
            <label class="samll">Upload Foto:</label>
            <br>

            <input type="hidden" name="id_pengguna" value="<?= $_COOKIE['id']; ?>">
            <input type="file" name="foto" class="form-control">

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
          <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
        </div>
    </div>
    </form>
  </div>
</div>
<!-- Modal ubah password -->

<!-- end isinya -->
<?php include "footer.php" ?>