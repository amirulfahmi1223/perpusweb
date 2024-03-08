<?php
include 'sidebar.php';


?>
<!-- isinya -->
<h1 class="h3 mb-0">
  Data Proses
  <div class="float-right">
    <p id="date_time" style="font-size: 14px; margin-top:11px"></p>
  </div>
</h1>
<hr>
<table class="table table-striped table-sm table-bordered dt-responsive nowrap text-center" id="table" width="100%">
  <thead>
    <tr>
      <th>No</th>
      <th>Kode Peminjaman</th>
      <th>Judul Buku</th>
      <th>Tanggal Pinjam</th>
      <th>Tanggal Kembali</th>
      <th>Status</th>
      <th>Opsi</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1;
    $peminjaman = mysqli_query($conn, "SELECT * FROM tb_peminjaman JOIN tb_buku ON tb_peminjaman.id_buku = tb_buku.id_buku JOIN tb_anggota ON tb_peminjaman.id_peminjam = tb_anggota.id_anggota WHERE tb_peminjaman.status_buku = 'Proses' AND tb_peminjaman.id_peminjam = '" . $_COOKIE['id'] . "'");
    while ($data = mysqli_fetch_array($peminjaman)) {
    ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $data['id_peminjaman']; ?></td>
        <td><a href="detail-buku.php?kd_buku=<?= $data['id_buku']; ?>"><span class="fa fa-book"></span> <?php echo $data['judul']; ?></a></td>
        <td><?= $data['tgl_pinjam']; ?></td>
        <td><?= $data['tgl_kembali']; ?></td>
        <td><?= $data['status_buku']; ?></td>
        <td>
          <a href="edit-pinjaman.php?id_trans=<?= $data['id_peminjaman']; ?>" class="btn btn-primary btn-sm px-3 mr-1">
            <i class="fas fa-pencil-alt fa-xs mr-1"></i>Edit
          </a>
          <a class="btn btn-danger btn-sm px-3 delete-data" href="hapus-proses.php?id_trans=<?= $data['id_peminjaman']; ?>">
            <i class="fas fa-trash-alt fa-xs mr-1"></i>Hapus</a>
        </td>
      </tr>
      <!-- Modal Exit -->
      <div class="modal fade" id="Konfirmasi" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content border-0">
            <div class="modal-body text-center">
              <i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i>
              <h3 class="mb-4">Konfirmasi Peminjaman ?</h3>
              <button type="button" class="btn btn-secondary px-4 mr-2" data-dismiss="modal">Batal</button>
              <a href="pinjam.php?id_buku=<?= $data['id_buku'] ?>&id_trans=<?= $data['id_peminjaman']; ?>" class="btn btn-primary px-4">Konfirmasi</a>
            </div>
          </div>
        </div>
        <!-- end Modal Exit -->
      <?php  } ?>
  </tbody>
</table>


<!-- end isinya -->
<?php include "footer.php" ?>