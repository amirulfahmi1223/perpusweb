<?php
include 'sidebar.php';

?>
<!-- isinya -->
<h1 class="h3 mb-0">
  Data Anggota
  <a href="tambah-anggota.php" class="btn btn-primary btn-sm border-0 float-right"><i class="fa fa-plus"></i> Tambah Anggota</a>
</h1>
<hr>
<table class="table table-striped table-sm table-bordered dt-responsive nowrap text-center" id="table" width="100%">
  <thead>
    <tr>
      <th>No</th>
      <th>Kode Anggota</th>
      <th>Nisn</th>
      <th>Nama</th>
      <th>Kelas</th>
      <th>Username</th>
      <th>Status</th>
      <th>Opsi</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1;
    $kategori = mysqli_query($conn, "SELECT * FROM tb_anggota");
    while ($data = mysqli_fetch_array($kategori)) {
    ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $data['id_anggota']; ?></td>
        <td><?= $data['nisn']; ?></td>
        <td><?= $data['nama']; ?></td>
        <td><?= $data['kelas']; ?></td>
        <td><a href="detail-anggota.php?kd_anggota=<?php echo $data['id_anggota']; ?>"><span class="fa fa-user"></span> <?= $data['username']; ?></a></td>
        <td><?= $data['status'] == "1" ? "Aktif" : "Tidak Aktif"; ?></td>
        <td>
          <a href="edit-anggota.php?id_anggota=<?= $data['id_anggota']; ?>" class="btn btn-primary btn-sm px-3 mr-1">
            <i class="fas fa-pencil-alt fa-xs mr-1"></i>Edit
          </a>
          <a class="btn btn-danger btn-sm px-3 delete-data" href="hapus-anggota.php?id_anggota=<?= $data['id_anggota'] ?>">
            <i class="fas fa-trash-alt fa-xs mr-1"></i>Hapus</a>
        </td>
      </tr>
    <?php  } ?>
  </tbody>
</table>




<!-- end isinya -->
<?php include "footer.php" ?>