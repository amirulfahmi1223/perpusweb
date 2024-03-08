<?php
include 'sidebar.php';
if ($d['level'] == "Member" || $d['level'] == "Leader") {
  $_SESSION['info'] = 'Maaf Akses di Tolak';
  echo '<script>window.location="index.php"</script>';
}

$query = "SELECT * FROM tb_pengguna ORDER BY id ASC";
$run = mysqli_query($conn, $query);
//tambah pengguna
if (isset($_POST['tambah'])) {
  $nama = htmlspecialchars($_POST["nama"]);
  $user = htmlspecialchars($_POST["user"]);
  $email = htmlspecialchars($_POST["email"]);
  $tlpn = htmlspecialchars($_POST["telepon"]);
  $password = htmlspecialchars($_POST["password"]);
  $level = htmlspecialchars($_POST["level"]);
  $foto = "new-default.png";
  $status = 1;
  $defaul_projek = 0;
  $result = mysqli_query($conn, "SELECT username FROM tb_pengguna WHERE username = '$user'");
  if (mysqli_fetch_assoc($result)) {
    $_SESSION['info'] = 'Username Sudah Terdaftar!';
    echo '<script>window.location="pengguna.php"</script>';
  } else {
    $insert = mysqli_query($conn, "INSERT INTO tb_pengguna VALUES(
        null,
        '" . $nama . "',
        '" . $user . "',
        '" . $password . "',
        '" . $email . "',
        '" . $tlpn . "',
        '" . $level . "',
        '" . $foto . "',
        '" . $status . "',
        '" . $defaul_projek . "',
        null,
        null
      )");
    if ($insert) {
      $_SESSION['info'] = 'Tambah Pengguna Berhasil';
      echo '<script>history.go(-1);</script>';
    } else {
      $_SESSION['info'] = 'Tambah Pengguna Gagal';
      echo '<script>history.go(-1);</script>';
    }
  }
}
//edit
if (isset($_POST['edit'])) {
  $password = htmlspecialchars($_POST["password"]);
  $level = htmlspecialchars($_POST["level"]);
  $status = htmlspecialchars($_POST["status"]);
  $id = $_POST["id"];
  $currdate = date('Y-m-d H:i:s');
  $update = mysqli_query($conn, "UPDATE tb_pengguna SET
    password = '" . $password . "',
    level = '" . $level . "',
    status = '" . $status . "',
    update_at = '" . $currdate . "'
    WHERE id = '" . $id . "'
  ");
  if ($update) {
    $_SESSION['info'] = 'Edit Pengguna Berhasil';
    echo '<script>history.go(-1);</script>';
  } else {
    $_SESSION['info'] = 'Edit Pengguna Gagal';
    echo '<script>history.go(-1);</script>';
  }
}
?>
<!-- isinya -->
<h1 class="h3 mb-0">
  Data Pengguna
  <button class="btn btn-primary btn-sm border-0 float-right" type="button" data-toggle="modal" data-target="#Tambah"><i class="fa fa-plus"></i> Tambah Pengguna</button>
</h1>
<hr>
<table class="table table-striped table-sm table-bordered dt-responsive nowrap text-center" id="table" width="100%">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama Lengkap</th>
      <th>Username</th>
      <th>Level</th>
      <th>Foto</th>
      <th>Status</th>
      <th>Opsi</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1;
    while ($p = mysqli_fetch_array($run)) {
    ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= $p['nama']; ?></td>
        <td><?= $p['username']; ?></td>
        <td><?= $p['level']; ?></td>
        <td><a href="../uploads/profil/<?= $p['logo']; ?>" target="_blank"><img src="../uploads/profil/<?= $p['logo']; ?>" height="50px" width="50px" alt=""></a></td>
        <td><?= $p['status'] == "1" ? "Aktif" : "Tidak Aktif"; ?></td>
        <td>
          <a href="detail-pengguna.php?id=<?= $p['id']; ?>" class="btn btn-warning btn-xs mr-1">
            <i class="fa fa-eye mr-1"></i>Detail
          </a>
          <button type="button" class="btn btn-primary btn-xs mr-1" data-toggle="modal" data-target="#EditPengguna<?= $p['id'] ?>">
            <i class="fas fa-pencil-alt fa-xs mr-1"></i>Edit
          </button>
          <a class="btn btn-danger btn-xs delete-data" href="delete/hapus-pengguna.php?id=<?= $p['id']; ?>">
            <i class="fas fa-trash-alt fa-xs mr-1"></i>Hapus</a>
        </td>
      </tr>


      <!-- Modal edit -->
      <div class="modal fade" id="EditPengguna<?= $p['id'] ?>" tabindex=" -1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content border-0">
            <form action="" method="POST">
              <div class="modal-header bg-purple">
                <h5 class="modal-title text-white">Edit Pengguna</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <?php if ($p['level'] == "Administrator") { ?>
                  <div class="form-group">
                    <input type="hidden" value="<?= $p['id']; ?>">
                    <label class="samll">Username :</label>
                    <input type="text" name="username" value="<?= $p['username']; ?>" placeholder="Masukkan Username" class="form-control" readonly>
                  </div>
                  <div class="form-group">
                    <label class="samll">Password :</label>
                    <input type="password" value="<?= $p['password']; ?>" class="form-control" readonly>
                  </div>
                  <div class="form-group">
                    <label class="samll">Level :</label>
                    <input type="text" value="<?= $p['level']; ?>" class="form-control" readonly>
                  </div>
                  <div class="form-group">
                    <label class="samll">Status :</label>
                    <input type="text" class="form-control" value="<?= $p['status'] == "1" ? "Aktif" : "Tidak Aktif" ?>" readonly>
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                <button type="submit" name="#" class="btn btn-primary">Ubah</button>
              </div>
          </div>
        <?php } else { ?>
          <div class="form-group">
            <input type="hidden" name="id" value="<?= $p['id']; ?>">
            <label class="samll">Username :</label>
            <input type="text" name="username" value="<?= $p['username']; ?>" placeholder="Masukkan Username" class="form-control" readonly>
          </div>
          <div class="form-group">
            <label class="samll">Password :</label>
            <input type="password" name="password" value="<?= $p['password']; ?>" class="form-control" required>
          </div>
          <div class="form-group">
            <label class="samll">Level :</label>
            <select name="level" id="" class="form-control" required>
              <option value="">-- Pilih --</option>
              <option value="Member" <?= $p['level'] == "Member" ? "selected" : "" ?>>Member</option>
              <option value="Leader" <?= $p['level'] == "Leader" ? "selected" : "" ?>>Leader</option>
              <option value="Administrator" <?= $p['level'] == "Administrator" ? "selected" : "" ?>>Administrator</option>
            </select>
          </div>
          <div class="form-group">
            <label class="samll">Status :</label>
            <select name="status" id="" class="form-control" required>
              <option value="">-- Pilih --</option>
              <option value="1" <?= $p['status'] == "1" ? "selected" : "" ?>>Aktif</option>
              <option value="0" <?= $p['status'] == "0" ? "selected" : "" ?>>Tidak Aktif</option>
            </select>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
          <button type="submit" name="edit" class="btn btn-primary">Ubah</button>
        </div>
      </div>
    <?php } ?>
    </form>
    </div>
    </div>
    <!-- end Modal edit -->
  <?php } ?>

  </tbody>
</table>

<!-- Modal Tambah pengguna -->
<div class="modal fade" id="Tambah" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content border-0">
      <form method="POST">
        <div class="modal-header bg-purple">
          <h5 class="modal-title text-white">Tambah Pengguna</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label class="samll">Nama Pengguna :</label>
            <input type="text" name="nama" placeholder="Masukkan Nama" class="form-control" required>
          </div>
          <div class="form-group">
            <label class="samll">Username :</label>
            <input type="text" name="user" placeholder="Masukkan Username" class="form-control" required>
          </div>
          <div class="form-group">
            <label class="samll">Email Pengguna :</label>
            <input type="email" placeholder="Masukkan Email" name="email" class="form-control" required>
          </div>
          <div class="form-group">
            <label class="samll">No.Tlpn :</label>
            <input type="number" placeholder="0" name="telepon" class="form-control" required>
          </div>
          <div class="form-group">
            <label class="samll">Password :</label>
            <input type="password" placeholder="Password" name="password" class="form-control" required>
          </div>
          <div class="form-group">
            <label class="samll">Level :</label>
            <select name="level" id="" class="form-control" required>
              <option value="">-- Pilih --</option>
              <option value="Member">Member</option>
              <option value="Leader">Leader</option>
              <option value="Administrator">Administrator</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" name="tambah" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- end Modal Pengguna -->


<!-- end isinya -->
<?php include "footer.php" ?>