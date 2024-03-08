<?php
include "../connection/koneksi.php";
session_start();
error_reporting(0);
if ($_COOKIE['id_admin'] == "") {
    header("location:login.php");
}
if ($_SESSION['status_login'] != "true") {
    header("location:login.php");
}
date_default_timezone_set("Asia/jakarta");
//input data
$uid = $_COOKIE['id_admin'];
$filename = $_FILES['file']['name'];
$tmpname = $_FILES['file']['tmp_name'];
$filesize = $_FILES['file']['size'];
$currdate = date('Y-m-d H:i:s');
//pembuatan nama file
$formatfile = pathinfo($filename, PATHINFO_EXTENSION);
//generate filename
$rename = 'profil' . time() . '.' . $formatfile;
//validasi file yang boleh masuk
$allowedtype = array('png', 'jpg', 'jpeg', 'jfif', 'gif', 'JPG', 'PNG', 'JPEG', 'JIFIF', 'webp');


//cek filesize
if ($filesize > 2000000) {
    $_SESSION['info'] = 'Ukuran File Terlalu Besar';
    echo '<script>history.go(-1);</script>';
}
//cek data
if (!in_array($formatfile, $allowedtype)) {
    $_SESSION['info'] = 'Ekstensi File Yang Di Upload Tidak di Perbolehkan';
    echo '<script>history.go(-1);</script>';
} else {
    $gambar = mysqli_query($conn, "SELECT foto FROM tb_admin WHERE id ='" . $uid . "' ");
    //mengecek data di table
    if (mysqli_num_rows($gambar) > 0) {
        $d = mysqli_fetch_object($gambar);
        //mengecek data difolder
        if (file_exists("../uploads/profil/" . $_POST['foto2'])) {
            if ($_POST['foto2'] != "new-default.png") {
                unlink("../uploads/profil/" . $_POST['foto2']);
            }
        }
        move_uploaded_file($tmpname, '../uploads/profil/' . $rename);
        $query =  mysqli_query($conn, "UPDATE tb_admin SET 
        foto ='" . $rename . "',
        updated_at = '" . $currdate . "' 
        WHERE id ='" . $uid . "'") or die(mysqli_connect_error());
        if ($query) {
            echo '<script>history.go(-1);</script>';
        } else {
            $_SESSION['info'] = 'Gagal Mengupload Gambar';
            echo '<script>history.go(-1);</script>';
        }
    }
}
