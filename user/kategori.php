<?php
include 'sidebar.php';

if (isset($_POST['tambah'])) {
  $nama = $_POST['kategori'];
  // $data = upper($nama);
  $id = 1;
  $currdate = date('Y-m-d');
  $simpan = mysqli_query($conn, "INSERT INTO kategori VALUES(
    '',
    '" . $nama . "',
    '" . $id . "',
    '" . $currdate . "'
  )");
  if ($simpan) {
    $_SESSION['info'] = 'Tambah Pengguna Berhasil';
    echo '<script>history.go(-1);</script>';
  } else {
    $_SESSION['info'] = 'Tambah Pengguna Gagal';
    echo '<script>history.go(-1);</script>';
  }
}
if (isset($_POST['edit'])) {
  $nama = $_POST['kategori'];
  $id = $_POST['id'];
  $update = mysqli_query($conn, "UPDATE kategori SET
    nama_kategori = '" . $nama . "'
    WHERE id_kategori =  '" . $id . "'
  ");
  if ($update) {
    $_SESSION['info'] = 'Edit Projek Berhasil';
    echo '<script>history.go(-1);</script>';
  } else {
    $_SESSION['info'] = 'Edit Projek Gagal';
    echo '<script>history.go(-1);</script>';
  }
}
?>
<!-- isinya -->
<h1 class="h3 mb-0">
  Data Kategori
  <button class="btn btn-primary btn-sm border-0 float-right" type="button" data-toggle="modal" data-target="#Tambah"><i class="fa fa-plus"></i> Tambah Kategori</button>
</h1>
<hr>
<table class="table table-striped table-sm table-bordered dt-responsive nowrap text-center" id="table" width="100%">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama Kategori</th>
      <th>Tanggal Ditambahkan</th>
      <th>Opsi</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1;
    $kategori = mysqli_query($conn, "SELECT * FROM kategori WHERE created_by = '" . $_COOKIE['id'] . "'");
    while ($k = mysqli_fetch_array($kategori)) {
    ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $k['nama_kategori']; ?></td>
        <td><?= $k['created_date'];; ?></td>
        <td>
          <button type="button" class="btn btn-primary btn-xs mr-1" data-toggle="modal" data-target="#Edit<?= $k['id_kategori'] ?>">
            <i class="fas fa-pencil-alt fa-xs mr-1"></i>Edit
          </button>
          <a class="btn btn-danger btn-xs delete-data" href="hapus-kategori.php?id_kat=<?= $k['id_kategori'] ?>">
            <i class="fas fa-trash-alt fa-xs mr-1"></i>Hapus</a>
        </td>
      </tr>
      <!-- Modal edit -->
      <div class="modal fade" id="Edit<?= $k['id_kategori'] ?>" tabindex=" -1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content border-0">
            <form action="" method="POST">
              <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Edit Kategori</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <input type="hidden" value="52">
                  <label class="samll">Nama Ketegori :</label>
                  <input type="text" name="kategori" value="<?= $k['nama_kategori']; ?>" placeholder="Masukkan Nama Kategori" class="form-control" required>
                  <input type="hidden" name="id" value="<?= $k['id_kategori']; ?>">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                <button type="submit" name="edit" class="btn btn-primary">Edit</button>
              </div>
          </div>
          </form>
        </div>
      </div>
    <?php } ?>
  </tbody>
</table>

<!-- Modal tambah -->
<div class="modal fade" id="Tambah" tabindex=" -1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content border-0">
      <form action="" method="POST">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-white">Tambah Kategori</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" value="52">
            <label class="samll">Nama Ketegori :</label>
            <input type="text" name="kategori" placeholder="Masukkan Nama Kategori" class="form-control" required>
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


<!-- end isinya -->
<?php include "footer.php" ?>