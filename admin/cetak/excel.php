<?php
// Set header untuk file Excel
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Daftar-Laporan-Buku-" . date('d-m-Y') . ".xls");

header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private", false);

// Include file function.php
include "../../connection/koneksi.php";

// Query data dari database
$select = mysqli_query($conn, "SELECT * FROM tb_buku JOIN tb_kategori ON tb_buku.id_kategori = tb_kategori.id_kategori ORDER BY tb_buku.tgl_input DESC ");

// Mulai session
session_start();

// Cek apakah sudah login
if (!isset($_SESSION["status_login"])) {
  echo '<script>window.location="../login.php"</script>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Buku Perpustakaan</title>
</head>

<body>
  <!-- Tampilan data dalam bentuk tabel -->
  <div>
    <h2 style="text-align:center; font-family: Arial, Helvetica, sans-serif;">DAFTAR BUKU PERPUSTAKAAN <?= date('Y') ?></h2>
    <table border="1" cellpadding="8">
      <thead>
        <tr style="background-color: yellow;">
          <th>No</th>
          <th>Kode Buku</th>
          <th>Judul Buku</th>
          <th>Kategori</th>
          <th>Pengarang</th>
          <th>Penerbit</th>
          <th>Tahun Terbit</th>
          <th>Tanggal Input</th>
          <th>Jumlah</th>
          <th>Lokasi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $no = 1;
        // Mengecek apakah terdapat data
        if (mysqli_num_rows($select) > 0) {
          while ($data = mysqli_fetch_assoc($select)) {
        ?>
            <tr>
              <td><?= $no++; ?></td>
              <td><?= $data['id_buku']; ?></td>
              <td><?= $data['judul']; ?></td>
              <td><?= $data['nama_kategori']; ?></td>
              <td><?= $data['penulis']; ?></td>
              <td><?= $data['penerbit']; ?></td>
              <td><?= $data['th_terbit']; ?></td>
              <td><?= $data['tgl_input']; ?></td>
              <td><?= $data['jumlah_buku']; ?></td>
              <td><?= $data['lokasi']; ?></td>
            </tr>
        <?php
          }
        } else {
          // Jika tidak ada data
          echo "<tr><td colspan='10'>Tidak ada data yang ditemukan</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
</body>

</html>