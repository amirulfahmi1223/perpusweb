<?php
include "sidebar.php";
if ($_GET['id_tanggapan'] == "") {
  echo "<script>window.location='data-ulasan.php'</script>";
}
if (isset($_POST['tanggapi'])) {
  $tanggapan    =  $_POST['tanggapan'];
  $id  = $_POST['id_ulasan'];
  $currdate = date('d-m-Y h:i');
  $update = mysqli_query($conn, "UPDATE tb_ulasan SET 
  balasan = '" . $tanggapan . "',
  tgl_balasan = '" . $currdate . "'
  WHERE id_ulasan = '" . $id . "'
  ");
  if ($update) {
    echo "<script>alert('Tanggapan Berhasil diKirim')</script>";
    echo '<script>history.go(-1);</script>';
  } else {
    echo "<script>alert('Tanggapan Gagal diKirim')</script>";
    echo '<script>history.go(-1);</script>';
  }
}
//menampilkan data
$query = mysqli_query($conn, "SELECT * FROM tb_ulasan WHERE id_ulasan = '" . $_GET['id_tanggapan'] . "'");
$data = mysqli_fetch_assoc($query);
?>
<!-- isinya -->
<h1 class="h3 mb-0">
  Tanggapi Ulasan
  <div class="float-right">
    <p id="date_time" style="font-size: 14px; margin-top:11px"></p>
  </div>
</h1>
<hr>
<div class="modal-content border-0">
  <form method="POST" enctype="multipart/form-data" action="">
    <div class="modal-body">

      <div class="form-group">
        <label class="samll">Ulasan Peminjam :</label>
        <textarea name="" id="" class="form-control" cols="20" rows="8" readonly><?= $data['ulasan']; ?>
       </textarea>
      </div>
      <div class="form-group">
        <label class="samll">Balas Ulasan :</label>
        <textarea name="tanggapan" id="" class="form-control" cols="20" rows="7">
          <?= $data['balasan']; ?>
       </textarea>
      </div>
      <input type="hidden" name="id_ulasan" value="<?= $data['id_ulasan']; ?>">
      <div class="text-left mt-2">
        <button type="button" class="btn btn-secondary text-left" onclick="history.back(-1)">Kembali</button>
        <button type="submit" name="tanggapi" class="btn btn-primary">Kirim Balasan</button>
      </div>
    </div>
  </form>
</div>
<!-- end isinya -->
<?php include "footer.php" ?>