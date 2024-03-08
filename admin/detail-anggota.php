<?php
include 'sidebar.php';
if ($_GET['kd_anggota'] == "") {
  echo "<script>window.location='data-anggota.php'</script>";
}
?>
<!-- isinya -->
<h1 class="h3 mb-0">
  Detail Anggota
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
        <?php
        $query = mysqli_query($conn, "SELECT * FROM tb_anggota WHERE id_anggota='" . $_GET['kd_anggota'] . "'");
        $data  = mysqli_fetch_array($query);
        ?>
        <!-- </div> -->
        <div class="panel-body">
          <table id="example" class="table table-hover table-bordered">
            <tr>
              <td>ID Anggota</td>
              <td><?php echo $data['id_anggota']; ?></td>
              <td rowspan="9">
                <div class="pull-right image">
                  <a href="../uploads/profil/<?= $data['foto']; ?>">
                    <img src="../uploads/profil/<?= $data['foto']; ?>" class="img-rounded" height="300" width="250" alt="User Image" style="border: 3px solid #333333;" />
                  </a>
                </div>
              </td>
            </tr>
            <tr>
              <td width="250">Nisn</td>
              <td width="550"><?php echo $data['nisn']; ?></td>
            </tr>
            <tr>
              <td>Nama</td>
              <td><?php echo $data['nama']; ?></td>
            </tr>
            <!-- <tr>
              <td>Jenis Kelamin</td>
              <td><?php echo $data['jk']; ?></td>
            </tr> -->
            <tr>
              <td>Kelas</td>
              <td><?php echo $data['kelas']; ?></td>
            </tr>
            <tr>
              <td>Username</td>
              <td><?php echo $data['username']; ?></td>
            </tr>
            <tr>
              <td>Password</td>
              <td><?php echo $data['password']; ?></td>
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