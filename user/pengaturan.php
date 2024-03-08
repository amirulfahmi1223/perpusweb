<!-- isinya -->
<?php
include 'sidebar.php';
if (isset($_POST['SimpanEdit'])) {
    $uname = htmlspecialchars($_POST['nama']);
    $user = htmlspecialchars($_POST['username']);
    $nisn = htmlspecialchars($_POST['nisn']);
    $kelas = htmlspecialchars($_POST['kelas']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);
    $currdate = date('Y-m-d H:i:s');
    $queryuser = mysqli_query($conn, "SELECT * FROM tb_anggota WHERE id_anggota='" . $_COOKIE['id'] . "'");
    $cariuser = mysqli_fetch_assoc($queryuser);

    if ($cariuser['password'] == $pass) {
        if ($cariuser) {
            $cekDataUpdate =  mysqli_query($conn, "UPDATE tb_anggota SET 
            nama = '" . $uname . "',
            username ='" . $user . "',
            kelas = '" . $kelas . "',
            nisn ='" . $nisn . "',
            updated_at = '" . $currdate . "'
            WHERE id_anggota='" . $_COOKIE['id'] . "'") or die(mysqli_connect_error());
            if ($cekDataUpdate) {
                // $_SESSION['info'] = 'Profil Berhasil di Update';
                echo '<script>history.go(-1);</script>';
            } else {
                $_SESSION['info'] = 'Gagal Edit';
            }
        }
    } else {
        $_SESSION['info'] = 'Maaf password salah';
        echo '<script>;history.go(-1);</script>';
    }
};

if (isset($_POST['UpdatePass'])) {
    $pass1 = mysqli_real_escape_string($conn, $_POST['pswd1']);
    $currdate = date('Y-m-d H:i:s');
    $querypass = mysqli_query($conn, "SELECT * FROM tb_anggota  WHERE id_anggota='" . $_COOKIE['id'] . "'");
    $caripass = mysqli_fetch_assoc($querypass);

    if ($pass1 == $caripass['password']) {
        if ($caripass) {

            $pass2 = $_POST['pswd2'];
            $pass3 = $_POST['pswd3'];

            if ($pass2 == $pass3) {
                $cekPass =  mysqli_query($conn, "UPDATE tb_anggota SET password='$pass3',
                updated_at = '$currdate' 
                WHERE id_anggota ='" . $_COOKIE['id'] . "'") or die(mysqli_connect_error());
                if ($cekPass) {
                    $_SESSION['info'] = 'Password Berhasil di Update';
                    echo '<script>history.go(-1);</script>';
                } else {
                    $_SESSION['info'] = 'Gagal update password';
                    echo '<script>history.go(-1);</script>';
                }
            } else {
                $_SESSION['info'] = 'Password yang Anda Masukan Tidak Sama';
                echo "<script>history.go(-1)</script>";
            }
        }
    } else {
        $_SESSION['info'] = 'Maaf password salah';
        echo '<script>history.go(-1);</script>';
    }
};
?>

<h1 class="h3 mb-2">Account Settings</h1>
<!-- Profile widget -->
<div class="bg-white shadow rounded overflow-hidden">
    <div class="px-4 bg-purple" style="border-radius:0.25rem;">
        <div class="media align-items-end profile-header">
            <form method="POST" action="proses-logo.php" enctype="multipart/form-data">
                <div class="profile mr-3">
                    <label for="logo"><img src="../uploads/profil/<?= $d['foto']; ?>" alt="logo" class="img-cover-profile rounded mb-2 img-thumbnail"></label>
                    <input type="file" class="d-none" id="logo" onchange="form.submit()" name="file" />
                    <input type="hidden" value="<?= $d['foto']; ?>" class="d-none" name="foto2" />
                </div>
            </form>
            <div class="media-body mb-5 text-white">
                <h4 class="mt-0 mb-0"><?php echo $d['nama']; ?></h4>
                <p class="small mb-4">Member</p>
            </div>
        </div>
    </div>

    <div class="py-4 px-4 mt-5">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#PageProfile" style="letter-spacing: 1px;">
                    <i class="fa fa-user mr-1"></i> Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#PagePassword" style="letter-spacing: 1px;">
                    <i class="fa fa-lock mr-1"></i> Password</a>
            </li>
        </ul>
        <div class="tab-content py-3">
            <div id="PageProfile" class="tab-pane active">
                <form method="post">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 mb-2">
                            <label for="namatoko">Nama Lengkap<span class="text-danger">*</span></label>
                            <input name="nama" type="text" class="form-control" value="<?php echo $d['nama'] ?>" id="namatoko" placeholder="Nama Anda" required>
                        </div>
                        <div class="col-sm-6 col-md-6 mb-2">
                            <label for="username">Username<span class="text-danger">*</span></label>
                            <input name="username" type="text" class="form-control" name="username" value="<?php echo $d['username'] ?>" id="username" placeholder="username" readonly>
                        </div>
                        <div class="col-sm-6 col-md-6 mb-2">
                            <label for="email">Nisn<span class="text-danger">*</span></label>
                            <input name="nisn" type="text" class="form-control" value="<?= $d['nisn']; ?>" id="email" placeholder="Nisn Anda" required>
                        </div>
                        <div class="col-sm-6 col-md-6 mb-2">
                            <label for="aplikasi">Kelas<span class="text-danger">*</span></label>
                            <input type="text" name="kelas" class="form-control" value="<?= $d['kelas']; ?>" id="aplikasi" placeholder="Kelas Anda" required>
                        </div>

                        <div class="col-sm-6 col-md-6 col-lg-6"></div>
                        <div class="col-sm-6 col-md-6 col-lg-6 text-right mt-3">
                            <div id="Ada1">
                                <button type="button" class="btn btn-primary px-4" onclick="GetVerif()">Update</button>
                            </div>
                            <div style="display:none;width: 100%;" class="cuss" id="Tambah1">
                                <div class="tengah-tengah px-3">
                                    <div class="input-group">
                                        <input name="password" type="password" placeholder="Verifikasi Password" class="form-control mr-2" required>
                                        <div class="input-group-append">
                                            <button type="submit" name="SimpanEdit" class="btn btn-primary px-3">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

            <div id="PagePassword" class="tab-pane fade"><br>
                <form method="POST">
                    <div class="form-group row">
                        <label class="col-sm-4 col-md-4 col-lg-3 col-form-label">Password Lama<span class="text-danger">*</span></label>
                        <div class="col-sm-8 col-md-7 col-lg-4">
                            <input type="password" name="pswd1" placeholder="********" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-md-4 col-lg-3 col-form-label">Password Baru<span class="text-danger">*</span></label>
                        <div class="col-sm-8 col-md-7 col-lg-4">
                            <input type="password" name="pswd2" placeholder="********" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-md-4 col-lg-3 col-form-label">Konfirmasi Password<span class="text-danger">*</span></label>
                        <div class="col-sm-8 col-md-7 col-lg-4">
                            <input type="password" name="pswd3" placeholder="********" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-11 col-lg-7 text-right">
                            <button type="submit" name="UpdatePass" class="btn btn-primary px-4">Update</button>
                        </div>
                    </div>

                </form>
            </div>

        </div><!-- End tab -->
    </div>
</div><!-- End profile widget -->

<!-- end isinya -->
</div><!-- end container-fluid" -->
</main><!-- end page-content" -->
</div><!-- end page-wrapper -->

<!-- Modal Exit -->
<div class="modal fade" id="Exit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-0">
            <div class="modal-body text-center">
                <i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i>
                <h3 class="mb-4">Apakah anda yakin ingin keluar ?</h3>
                <button type="button" class="btn btn-secondary px-4 mr-2" data-dismiss="modal">Batal</button>
                <a href="../keluar.php" class="btn btn-primary px-4">Keluar</a>
            </div>
        </div>
    </div>
    <!-- end Modal Exit -->
    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>
    <!-- Swal -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.15.2/dist/sweetalert2.all.min.js"></script>
    <!-- Optional: include a polyfill for ES6 Promises for IE11 -->
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>
    <script>
        function GetVerif() {
            var x = document.getElementById("Ada1");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
            var y = document.getElementById("Tambah1");
            if (y.style.display === "block") {
                y.style.display = "none";
            } else {
                y.style.display = "block";
            }
        }
        const notifikasi = $('.info-data').data('infodata');
        if (notifikasi == "Maaf password salah") {
            Swal.fire({
                icon: 'error',
                title: 'GAGAL',
                text: notifikasi,
            })
        } else if (notifikasi == "Ekstensi File Yang Di Upload Tidak di Perbolehkan" || notifikasi == "Gagal update password") {
            Swal.fire({
                icon: 'error',
                title: 'GAGAL',
                text: notifikasi,
            })
        } else if (notifikasi == "Ukuran File Terlalu Besar" || notifikasi == "Password yang Anda Masukan Tidak Sama") {
            Swal.fire({
                icon: 'error',
                title: 'GAGAL',
                text: notifikasi,
            })
        } else if (notifikasi == "Password Berhasil di Update") {
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: notifikasi,
            })
        }
    </script>
    </body>

    </html>