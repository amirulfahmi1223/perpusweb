<?php
include 'sidebar.php';


?>
<!-- isinya -->
<h1 class="h3 mb-0">
  Data Proses
</h1>
<hr>
<table class="table table-striped table-sm table-bordered dt-responsive nowrap text-center" id="table" width="100%">
  <thead>
    <tr>
      <th>No</th>
      <th>Kode Pinjam</th>
      <th>Judul Buku</th>
      <th>Peminjam</th>
      <th>Tanggal Pinjam</th>
      <th>Tanggal Kembali</th>
      <th>Opsi</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1;
    $peminjaman = mysqli_query($conn, "SELECT * FROM tb_peminjaman JOIN tb_buku ON tb_peminjaman.id_buku = tb_buku.id_buku JOIN tb_anggota ON tb_peminjaman.id_peminjam = tb_anggota.id_anggota WHERE tb_peminjaman.status_buku = 'Proses'");
    while ($data = mysqli_fetch_array($peminjaman)) {
    ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $data['id_peminjaman']; ?></td>
        <td><a href="detail-buku.php?kd_buku=<?= $data['id_buku']; ?>"><span class="fa fa-book"></span> <?php echo $data['judul']; ?></a></td>
        <td><a href="detail-anggota.php?kd_anggota=<?= $data['id_anggota']; ?>"><span class="fa fa-user"></span> <?php echo $data['nama']; ?></a></td>
        <td><?= $data['tgl_pinjam']; ?></td>
        <td><?= $data['tgl_kembali']; ?></td>
        <td>
          <a href="#Konfirmasi<?= $data['id_peminjaman'] ?>" data-toggle="modal" class="btn btn-primary btn-sm px-3 mr-1">
            <i class="fas fa-save fa-xs mr-1"></i>Terima
          </a>
          <a href="cetak-bukti.php?detail=<?= $data['id_peminjaman'] ?>" class="btn btn-warning btn-sm px-3">
            <i class="fa fa-print fa-xs mr-1"></i>Cetak</a>
          <a class="btn btn-danger btn-sm px-3 delete-data" href="hapus-proses.php?id_trans=<?= $data['id_peminjaman']; ?>">
            <i class="fas fa-trash-alt fa-xs mr-1"></i>Hapus</a>
        </td>
      </tr>
      <!-- Modal Exit -->
      <div class="modal fade" id="Konfirmasi<?= $data['id_peminjaman'] ?>" tabindex="-1" role="dialog">
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
<!-- data print -->
<section id="print">
  <div class="d-none pt-5 px-5 print-show">
    <div class="text-center mb-5 pt-2">
      <h2 class="mb-3" style="font-size:60px;">Bukti Peminjaman</h2>
      <h2 class="mb-0">Perpustakaan SMAN 1 Sumberrejo</h2>
    </div>
    <?php
    $data_laporan = mysqli_query($conn, "SELECT * FROM tb_peminjaman WHERE id_peminjaman='" . $kode . "'");
    $l = mysqli_fetch_array($data_laporan)
    ?>
    <h2 class="mb-1">Kode Peminjaman : AD30124174136 <span class="float-right">Petugas : Fahmi</span></h2>
    <h2 class="mb-1">Tanggal : 2024-01-30 17:41:47</h2>
    <div class="row">
      <div class="col-12 py-3 my-3 border-top border-bottom">
        <div class="row">
          <div class="col-3">
            <h2 class="mb-0 py-1" style="font-weight:700;">Kode Buku</h2>
          </div>
          <div class="col-3">
            <h2 class="mb-0 py-1" style="font-weight:700;">Peminjam</h2>
          </div>
          <div class="col-3">
            <h2 class="mb-0 py-1" style="font-weight:700;">Tgl_Pinjam</h2>
          </div>
          <div class="col-3">
            <h2 class="mb-0 py-1" style="font-weight:700;">Tgl_Kembali</h2>
          </div>
        </div>
      </div>
      <div class="col-12">
        <div class="row">
          <div class="col-3">
            <h2 class="mb-0 py-1" style="font-weight:500;">BK-0001</h2>
          </div>
          <div class="col-3">
            <h2 class="mb-0 py-1" style="font-weight:500;">FAHMI</h2>
          </div>
          <div class="col-3">
            <h2 class="mb-0 py-1" style="font-weight:500;">12-10-2023</h2>
          </div>
          <div class="col-3">
            <h2 class="mb-0 py-1" style="font-weight:500;">22-10-2023</h2>
          </div>
        </div>
      </div>
      <div class="col-12 py-3 my-3 mb-5 border-top">
        <div class="row justify-content-end mt-5">
          <div class="col-3 text-right border-bottom">
            <h2 class="mb-5" style="font-weight:700;">Mengetahui</h2>
            <h3 class="mt-5" style="font-weight:500; margin-top:60px;">Amirul Fahmi</h3>
          </div>
        </div>
      </div>
      <div class="col-12 text-center mt-5">
        <h2>* Terima Kasih Telah Berbelanja Di Adgrafika *</h2>
      </div>
    </div><!-- end row -->
  </div><!-- end box print -->
</section>
<!-- end data print -->


<!-- end isinya -->
<?php include "footer.php" ?>