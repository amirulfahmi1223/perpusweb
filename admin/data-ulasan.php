<?php
include 'sidebar.php';
?>
<!-- isinya -->
<h1 class="h3 mb-0">
  Daftar Ulasan
  <div class="float-right">
    <p id="date_time" style="font-size: 14px; margin-top:11px"></p>
  </div>
</h1>
<hr>
<table class="table table-striped table-sm table-bordered dt-responsive nowrap text-center" id="table" width="100%">
  <thead>
    <tr>
      <th>No</th>
      <th>Judul Buku</th>
      <th>Peminjam</th>
      <th>Ulasan</th>
      <th>Tanggal Ulasan</th>
      <th>Status</th>
      <th>Opsi</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1;
    $ulasan = mysqli_query($conn, "SELECT * FROM tb_ulasan JOIN tb_buku ON tb_ulasan.id_buku = tb_buku.id_buku JOIN tb_anggota ON tb_ulasan.id_anggota = tb_anggota.id_anggota");
    while ($data = mysqli_fetch_array($ulasan)) {
    ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><a href="detail-buku.php?kd_buku=<?= $data['id_buku']; ?>"><span class="fa fa-book"></span> <?php echo $data['judul']; ?></a></td>
        <td><a href="detail-anggota.php?kd_anggota=<?= $data['id_anggota']; ?>"><span class="fa fa-user"></span> <?php echo $data['nama']; ?></a></td>
        <td><?= substr($data['ulasan'], 0, 35); ?></td>
        <td><?= $data['tgl_ulasan']; ?></td>
        <?php if ($data['balasan'] != '') { ?>
          <td>Telah diBaca</td>
        <?php } else { ?>
          <td>Belum diBaca</td>
        <?php } ?>
        <td>
          <a href="tanggapan.php?id_tanggapan=<?= $data['id_ulasan']; ?>" class="btn btn-primary btn-sm px-3 mr-1">
            <i class="fas fa-comments fa-xs mr-1"></i>
          </a>
          <a class="btn btn-danger btn-sm px-3 delete-data" href="hapus-ulasan.php?id_ulasan=<?= $data['id_ulasan'] ?>">
            <i class="fas fa-trash-alt fa-xs mr-1"></i></a>
        </td>
      </tr>
    <?php  } ?>
  </tbody>
</table>

<!-- end isinya -->
<?php include "footer.php" ?>