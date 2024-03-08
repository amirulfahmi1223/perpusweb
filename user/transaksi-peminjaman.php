<?php
include "sidebar.php";
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
  // Periksa jumlah pinjaman yang sedang diproses atau belum dikembalikan oleh pengguna
  $getTotalPinjam = mysqli_query($conn, "SELECT COUNT(*) AS total_pinjam FROM tb_peminjaman WHERE id_peminjam = '" . $peminjam . "' AND status_buku ='Pinjam'");
  $dataTotalPinjam = mysqli_fetch_assoc($getTotalPinjam);
  $totalPinjam = $dataTotalPinjam['total_pinjam'];
  // Batas Jumlah Pinjaman
  $maxPinjaman = 2; // Tentukan batas maksimum pinjaman
  if ($totalPinjam >= $maxPinjaman) {
    echo "<script>alert('Maaf, Anda telah melebihi batas peminjaman.');</script>";
    echo "<script>history.go(-1);</script>";
  } else {
    // Cek apakah buku yang dipilih sudah ada dalam daftar peminjaman yang belum dikembalikan
    $checkDuplicate = mysqli_query($conn, "SELECT * FROM tb_peminjaman WHERE id_buku = '" . $id_buku . "' AND id_peminjam = '" . $peminjam . "' AND status_buku != 'Kembali'");
    if (mysqli_num_rows($checkDuplicate) > 0) {
      echo "<script>alert('Maaf, Anda sudah meminjam buku yang sama.')</script>";
      echo "<script>history.go(-1);</script>";
    } else {
      // Proses peminjaman buku
      $jum = 1;
      $query = mysqli_query($conn, "SELECT * FROM tb_buku WHERE id_buku = '" . $id_buku . "'");
      while ($hasil = mysqli_fetch_array($query)) {
        $sisa = $hasil['jumlah_buku'];
        $tot = $sisa * $jum;
      }
      if ($tot == 0) {
        echo "<script>alert('Stock Buku Habis, Harap tunggu pengembalian buku!');</script>";
        echo "<script>history.go(-1);</script>";
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
          echo "<script>alert('Transaksi Gagal!');</script>";
        }
      }
    }
  }
}

?>
<!-- isinya -->
<h1 class="h3 mb-0">
  Input Peminjaman
  <div class="float-right">
    <p id="date_time" style="font-size: 14px; margin-top:11px"></p>
  </div>
</h1>
<hr>
<div class="modal-content border-0">
  <form method="POST" enctype="multipart/form-data" action="">
    <div class="modal-body">
      <div class="row">
        <div class="form-group col-6">
          <label class="samll">Nama Peminjam :</label>
          <input type="text" name="nama" value="<?= $d['nama']; ?>" class="form-control" readonly>
          <input type="hidden" name="id_peminjam" value="<?= $d['id_anggota']; ?>">
        </div>
        <?php if (!isset($_GET['kd_buku'])) { ?>
          <div class="form-group col-6">
            <label class="samll">Judul Buku :</label>
            <select name="buku" class="form-control" required>
              <option value="">-- Pilih Buku --</option>
              <?php
              $buku = mysqli_query($conn, "SELECT * FROM tb_buku");
              while ($b = mysqli_fetch_array($buku)) {
              ?>
                <option value="<?= $b['id_buku'] ?>"><?= $b['judul']; ?></option>
              <?php } ?>
            </select>
          </div>
        <?php } else { ?>
          <div class="form-group col-6">
            <label class="samll">Judul Buku :</label>
            <?php
            $buku = mysqli_query($conn, "SELECT * FROM tb_buku WHERE id_buku = '" . $_GET['kd_buku'] . "'");
            $b = mysqli_fetch_array($buku);
            ?>
            <input type="text" class="form-control" name="kode" value="<?= $b['judul']; ?>" readonly>
            <input type="hidden" class="form-control" name="buku" value="<?= $b['id_buku']; ?>">
          </div>
        <?php } ?>
        <div class="form-group col-6">
          <label class="samll">Tanggal Pinjam :</label>
          <input type="text" name="tgl_pinjam" value="<?= $pinjam; ?>" class="form-control" readonly>
        </div>
        <div class="form-group col-6">
          <label class="samll">Tanggal Kembali :</label>
          <input type="text" name="tgl_kembali" value="<?= $kembali; ?>" class="form-control" readonly>
        </div>
      </div>
      <div class="form-group">
        <label class="samll">Keterangan Peminjaman :</label>
        <textarea name="ket" id="" class="form-control" cols="20" rows="8">
       </textarea>
      </div>
      <div class="text-left mt-2">
        <button type="button" class="btn btn-secondary text-left" onclick="history.back(-1)">Kembali</button>
        <button type="submit" name="pinjam" class="btn btn-primary">Pinjam Buku</button>
      </div>
    </div>
  </form>
</div>
<!-- end isinya -->
<?php include "footer.php" ?>