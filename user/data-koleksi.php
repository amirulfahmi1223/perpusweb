<?php
include 'sidebar.php';

$pinjam            = date("d-m-Y");
//peminjaman hanya dibatasi 10 hari saja
$maxpinjam        = mktime(0, 0, 0, date("n"), date("j") + 12, date("Y"));
$kembali        = date("d-m-Y", $maxpinjam);
if (isset($_POST['pinjam'])) {
  //generate id peminjaman
  $getMaxId = mysqli_query($conn, "SELECT MAX(RIGHT(id_peminjaman, 5)) AS id FROM tb_peminjaman");
  $d = mysqli_fetch_object($getMaxId);
  $generateId = 'TRX-' . sprintf("%05s", $d->id + 1);
  $tgl_pinjam    =  $_POST['tgl_pinjam'];
  $tgl_kembali  = $_POST['tgl_kembali'];
  $id_buku    = $_POST['buku'];
  $peminjam     = $_POST['id_peminjam'];
  $ket      = $_POST['ket'];

  $jum = 1;
  $query = mysqli_query($conn, "SELECT * FROM tb_buku WHERE id_buku = '" . $id_buku . "'");
  while ($hasil = mysqli_fetch_array($query)) {
    $sisa = $hasil['jumlah_buku'];
    $tot = $sisa * $jum;
  }

  if ($tot == 0) {
    echo "<script>alert('Stock Buku Habis, Harap tunggu pengembalian buku!'); window.location = 'transaksi-peminjaman.php'</script>";
  } else {
    $qt      = mysqli_query($conn, "INSERT INTO tb_peminjaman VALUES (
                '" . $generateId . "',
                '" . $id_buku . "', 
                '" . $peminjam . "',
                '" . $tgl_pinjam . "',
                '" . $tgl_kembali . "', 
                'Proses', 
                '" . $ket . "')") or die("Gagal Masuk");

    // $qu      = mysqli_query($conn, "UPDATE tb_buku SET jumlah_buku=(jumlah_buku-1) WHERE id_buku='" . $id_buku . "' ");

    if ($qt) {
      echo "<script>alert('Transaksi Peminjaman Berhasil!'); window.location = 'data-proses.php'</script>";
    } else {
      echo "<<script>alert('Transaksi Gagal!'); window.location = 'data-koleksi.php'</script>";
    }
  }
}
?>
<!-- isinya -->
<h1 class="h3 mb-0">
  Data Koleksi Pribadi
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
      <th>Gambar</th>
      <th>Created At</th>
      <th>Opsi</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1;
    $buku = mysqli_query($conn, "SELECT * FROM tb_koleksi JOIN tb_buku ON tb_koleksi.id_buku = tb_buku.id_buku WHERE tb_koleksi.id_user = '" . $_COOKIE['id'] . "'");
    while ($data = mysqli_fetch_array($buku)) {
    ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><a href="detail-buku.php?kd_buku=<?= $data['id_buku']; ?>"><span class="fa fa-book"></span> <?php echo $data['judul']; ?></a></td>
        <td>
          <img src="../uploads/buku/<?= $data['gambar']; ?>" width="50" height="50" alt="buku">
        </td>
        <td><?= $data['created_at']; ?></td>
        <td>
          <a href="" data-toggle="modal" data-target="#Pinjam<?= $data['id_koleksi'] ?>" class="btn btn-primary btn-sm px-3 mr-1">
            <i class="fas fa-save fa-xs mr-1"></i>Pinjam
          </a>
          <a class="btn btn-danger btn-sm px-3 delete-data" href="hapus-koleksi.php?id_koleksi=<?= $data['id_koleksi'] ?>">
            <i class="fas fa-trash-alt fa-xs mr-1"></i>Hapus</a>
        </td>
      </tr>
      <!-- Modal tambah -->
      <div class="modal fade" id="Pinjam<?= $data['id_koleksi'] ?>" tabindex=" -1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content border-0">
            <form action="" method="POST">
              <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Pinjam Buku</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <input type="hidden" value="52">
                  <label class="samll">Judul Buku :</label>
                  <input type="text" class="form-control" name="kode" value="<?= $data['judul']; ?>" readonly>
                  <input type="hidden" class="form-control" name="buku" value="<?= $data['id_buku']; ?>">
                </div>
                <div class="form-group">
                  <label class="samll">Tanggal Pinjam :</label>
                  <input type="text" class="form-control" name="tgl_pinjam" value="<?= $pinjam; ?>" readonly>
                </div>
                <div class="form-group">
                  <input type="hidden" value="<?= $data['id_user']; ?>" name="id_peminjam">
                  <label class="samll">Tanggal Kembali :</label>
                  <input type="text" class="form-control" name="tgl_kembali" value="<?= $kembali; ?>" readonly>
                </div>
                <div class="form-group">
                  <input type="hidden" value="52">
                  <label class="samll">Keterangan Peminjaman :</label>
                  <textarea name="ket" class="form-control" id="" cols="30" rows="5" required></textarea>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                <button type="submit" name="pinjam" class="btn btn-primary">Pinjam</button>
              </div>
          </div>
          </form>
        </div>
      </div>

    <?php  } ?>
  </tbody>
</table>




<!-- end isinya -->
<?php include "footer.php" ?>