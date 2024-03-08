<?php
include 'sidebar.php';


?>
<!-- isinya -->
<h1 class="h3 mb-0">
  Data Buku
  <a href="tambah-buku.php" class="btn btn-primary btn-sm border-0 float-right ml-2"><i class="fa fa-plus"></i> Tambah Buku</a>
  <a href="cetak/excel.php" class="btn btn-success btn-sm border-0 float-right"><i class="fa fa-file"></i> Export Excel</a>
</h1>
<hr>
<table class="table table-striped table-sm table-bordered dt-responsive nowrap text-center" id="table" width="100%">
  <thead>
    <tr>
      <th>No</th>
      <th>Judul Buku</th>
      <th>Pengarang</th>
      <th>Penerbit</th>
      <th>Jumlah</th>
      <th>Lokasi</th>
      <th>Opsi</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1;
    $buku = mysqli_query($conn, "SELECT * FROM tb_buku");
    while ($data = mysqli_fetch_array($buku)) {
    ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><a href="detail-buku.php?kd_buku=<?= $data['id_buku']; ?>"><span class="fa fa-book"></span> <?php echo $data['judul']; ?></a></td>
        <td><?= $data['penulis']; ?></td>
        <td><?= $data['penerbit']; ?></td>
        <td><?= $data['jumlah_buku']; ?></td>
        <td><?= $data['lokasi']; ?></td>
        <td>
          <a href="edit-buku.php?id_buku=<?= $data['id_buku']; ?>" class="btn btn-primary btn-sm px-3 mr-1">
            <i class="fas fa-pencil-alt fa-xs mr-1"></i>Edit
          </a>
          <a class="btn btn-danger btn-sm px-3 delete-data" href="hapus-buku.php?id_buku=<?= $data['id_buku'] ?>">
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