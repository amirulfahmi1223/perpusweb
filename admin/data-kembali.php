<?php
include 'sidebar.php';
//fungsi pinjaman buku terlambat    
function terlambat($tgl_dateline, $tgl_kembali)
{

  $tgl_dateline_pcs = explode("-", $tgl_dateline);
  $tgl_dateline_pcs = $tgl_dateline_pcs[2] . "-" . $tgl_dateline_pcs[1] . "-" . $tgl_dateline_pcs[0];

  $tgl_kembali_pcs = explode("-", $tgl_kembali);
  $tgl_kembali_pcs = $tgl_kembali_pcs[2] . "-" . $tgl_kembali_pcs[1] . "-" . $tgl_kembali_pcs[0];

  $selisih = strtotime($tgl_kembali_pcs) - strtotime($tgl_dateline_pcs);

  $selisih = $selisih / 86400;

  if ($selisih >= 1) {
    $hasil_tgl = floor($selisih);
  } else {
    $hasil_tgl = 0;
  }
  return $hasil_tgl;
}


?>
<!-- isinya -->
<h1 class="h3 mb-0">
  Data Pengembalian
  <a href="cetak/cetak-pengembalian.php" target="_blank" class="btn btn-warning btn-sm border-0 float-right"><i class="fa fa-print"></i> Cetak Laporan</a>
</h1>
<hr>
<table class="table table-striped table-sm table-bordered dt-responsive nowrap text-center" id="table" width="100%">
  <thead>
    <tr>
      <th>No</th>
      <th>Kode</th>
      <th>Judul Buku</th>
      <th>Peminjam</th>
      <th>Tanggal Pinjam</th>
      <th>Tanggal Kembali</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1;
    $peminjaman = mysqli_query($conn, "SELECT * FROM tb_peminjaman JOIN tb_buku ON tb_peminjaman.id_buku = tb_buku.id_buku JOIN tb_anggota ON tb_peminjaman.id_peminjam = tb_anggota.id_anggota WHERE tb_peminjaman.status_buku = 'Kembali'");
    while ($data = mysqli_fetch_array($peminjaman)) {
    ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $data['id_peminjaman']; ?></td>
        <td><a href="detail-buku.php?kd_buku=<?= $data['id_buku']; ?>"><span class="fa fa-book"></span> <?php echo $data['judul']; ?></a></td>
        <td><a href="detail-anggota.php?kd_anggota=<?= $data['id_anggota']; ?>"><span class="fa fa-user"></span> <?php echo $data['nama']; ?></a></td>
        <td><?= $data['tgl_pinjam']; ?></td>
        <td><?= $data['tgl_kembali']; ?></td>
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