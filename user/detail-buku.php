<?php
include 'sidebar.php';
if ($_GET['kd_buku'] == "") {
  echo "<script>window.location='data-buku.php'</script>";
}

$query = mysqli_query($conn, "SELECT * FROM tb_buku INNER JOIN tb_kategori ON tb_buku.id_kategori = tb_kategori.id_kategori WHERE id_buku='" . $_GET['kd_buku'] . "'");
$data  = mysqli_fetch_array($query);
?>
<!-- isinya -->
<h1 class="h3 mb-0">
  Detail Buku <?= $data['judul']; ?>
  <div class="float-right">
    <p id="date_time" style="font-size: 14px; margin-top:11px"></p>
  </div>
</h1>
<hr>



<!-- Main content -->
<section class="content">

  <div class="row ml-2">
    <div class="col-xs-12">
      <div class="panel">
        <!-- <div class="box-header"> -->
        <!-- <h3 class="box-title">Responsive Hover Table</h3> -->
        <!-- </div> -->
        <div class="panel-body">
          <table id="example" class="table table-hover table-bordered">
            <tr>
              <td>Kode Buku</td>
              <td><?php echo $data['id_buku']; ?></td>
              <td rowspan="9">
                <div class="pull-right image">
                  <img src="../uploads/buku/<?= $data['gambar']; ?>" class="img-rounded" height="300" width="250" alt="User Image" style="border: 3px solid #333333;" />
                </div>
              </td>
            </tr>
            <tr>
              <td width="250">Judul</td>
              <td width="550"><?php echo $data['judul']; ?></td>
            </tr>
            <tr>
              <td>Penulis</td>
              <td><?php echo $data['penulis']; ?></td>
            </tr>
            <tr>
              <td>Penerbit</td>
              <td><?php echo $data['penerbit']; ?></td>
            </tr>
            <tr>
              <td>Tahun Terbit</td>
              <td><?php echo $data['th_terbit']; ?></td>
            </tr>
            <tr>
              <td>Kategori</td>
              <td><?php echo $data['nama_kategori']; ?></td>
            </tr>
            <tr>
              <td>Jumlah</td>
              <td><?php echo $data['jumlah_buku']; ?></td>
            </tr>
            <tr>
              <td>Lokasi</td>
              <td><?php echo $data['lokasi']; ?></td>
            </tr>
            <tr>
              <td>Tanggal Input</td>
              <td><?php echo $data['tgl_input']; ?></td>
            </tr>
          </table>

          <div class="text-right mr-3">
            <button type="button" class="btn btn-sm btn-warning text-left" onclick="history.back(-1)">Kembali <i class="fa fa-arrow-circle-right"></i></button>
          </div>
        </div>
      </div><!-- /.box -->
    </div>
  </div>




  <!-- end isinya -->
  <?php include 'footer.php'; ?>