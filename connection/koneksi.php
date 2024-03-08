<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'db_ukk2024';
$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
  echo 'Koneksi Gagal :' . mysqli_connect_error($conn);
}
