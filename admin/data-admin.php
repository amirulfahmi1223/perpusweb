<?php
include 'sidebar.php';
?>
<!-- isinya -->
<h1 class="h3 mb-0">
  Data Pengguna
  <a href="tambah-pengguna.php" class="btn btn-primary btn-sm border-0 float-right"><i class="fa fa-plus"></i> Tambah Pengguna</a>
</h1>
<hr>
<table class="table table-striped table-sm table-bordered dt-responsive nowrap text-center" id="table" width="100%">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Telepon</th>
      <th>Email</th>
      <th>Username</th>
      <th>Level</th>
      <th>Opsi</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1;
    $kategori = mysqli_query($conn, "SELECT * FROM tb_admin");
    while ($data = mysqli_fetch_array($kategori)) {
    ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $data['nama']; ?></td>
        <td><?= $data['telepon']; ?></td>
        <td><?= $data['email']; ?></td>
        <td><a href="detail-admin.php?id_admin=<?php echo $data['id']; ?>"><span class="fa fa-user"></span> <?= $data['username']; ?></a></td>
        <td><?= $data['level']; ?></td>
        <!-- <td><?= $data['status'] == "1" ? "Aktif" : "Tidak Aktif"; ?></td> -->
        <td>
          <a href="edit-pengguna.php?id_user=<?= $data['id']; ?>" class="btn btn-primary btn-sm px-3 mr-1">
            <i class="fas fa-pencil-alt fa-xs mr-1"></i>Edit
          </a>
          <a class="btn btn-danger btn-sm px-3 delete-data" href="hapus-pengguna.php?id_user=<?= $data['id'] ?>">
            <i class="fas fa-trash-alt fa-xs mr-1"></i>Hapus</a>
        </td>
      </tr>
    <?php  } ?>
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