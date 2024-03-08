<?php
include "sidebar.php";
if ($_GET['id_trans'] == "") {
  echo "<script>window.location='data-proses.php'</script>";
}
$query = mysqli_query($conn, "SELECT * FROM tb_peminjaman JOIN tb_buku ON tb_peminjaman.id_buku = tb_buku.id_buku JOIN tb_anggota ON tb_peminjaman.id_peminjam = tb_anggota.id_anggota WHERE tb_peminjaman.id_peminjaman='" . $_GET['id_trans'] . "' ");
$da = mysqli_fetch_assoc($query);
if (isset($_POST['edit'])) {
  $buku = $_POST['buku'];
  $ket = $_POST['ket'];
  $id = $_POST['id'];
  $update = mysqli_query($conn, "UPDATE tb_peminjaman SET
    id_buku = '" . $buku . "',
    ket = '" . $ket . "'
    WHERE id_peminjaman =  '" . $id . "'
  ");
  if ($update) {
    $_SESSION['info'] = 'Edit Projek Berhasil';
    echo "<script>window.location = 'data-proses.php'</script>";
  } else {
    $_SESSION['info'] = 'Edit Projek Gagal';
    echo '<script>history.go(-1);</script>';
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
          <input type="text" name="nama" value="<?= $da['nama']; ?>" class="form-control" readonly>
          <input type="hidden" name="id" value="<?= $da['id_peminjaman']; ?>">
        </div>
        <div class="form-group col-6">
          <label class="samll">Judul Buku :</label>
          <select name="buku" class="form-control" required>
            <option value="">-- Pilih Buku --</option>
            <?php
            $buku = mysqli_query($conn, "SELECT * FROM tb_buku WHERE jumlah_buku != 0");
            while ($b = mysqli_fetch_array($buku)) {
            ?>
              <option value="<?php echo $b['id_buku'] ?>" <?= ($da['id_buku'] == $b['id_buku']) ? 'selected' : ''; ?>><?php echo $b['judul'] ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group col-6">
          <label class="samll">Tanggal Pinjam :</label>
          <input type="text" name="tgl_pinjam" value="<?= $da['tgl_pinjam']; ?>" class="form-control" readonly>
        </div>
        <div class="form-group col-6">
          <label class="samll">Tanggal Kembali :</label>
          <input type="text" name="tgl_kembali" value="<?= $da['tgl_kembali']; ?>" class="form-control" readonly>
        </div>
      </div>
      <div class="form-group">
        <label class="samll">Keterangan Peminjaman :</label>
        <textarea name="ket" id="" class="form-control" cols="20" rows="8">
          <?= $da['ket']; ?>
       </textarea>
      </div>
      <div class="text-left mt-2">
        <button type="button" class="btn btn-secondary text-left" onclick="history.back(-1)">Kembali</button>
        <button type="submit" name="edit" class="btn btn-primary">Edit Pinjaman</button>
      </div>
    </div>
  </form>
</div>
<!-- end isinya -->
<?php include "footer.php" ?>