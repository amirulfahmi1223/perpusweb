<?php
include "../../connection/koneksi.php";
date_default_timezone_set("Asia/jakarta");
$tanggal = date('d-m-Y');
$peminjaman = mysqli_query($conn, "SELECT * FROM tb_peminjaman JOIN tb_buku ON tb_peminjaman.id_buku = tb_buku.id_buku JOIN tb_anggota ON tb_peminjaman.id_peminjam = tb_anggota.id_anggota WHERE tb_peminjaman.status_buku = 'Kembali'");
//fungsi pinjaman buku terlambat    
function terlambat($tgl_dateline, $tgl_kembali)
{

  $tgl_dateline_pcs = explode("-", $tgl_dateline);
  $tgl_dateline_pcs = $tgl_dateline_pcs[2] . "-" . $tgl_dateline_pcs[1] . "-" . $tgl_dateline_pcs[0];

  $tgl_kembali_pcs = explode("-", $tgl_kembali);
  $tgl_kembali_pcs = $tgl_kembali_pcs[2] . "-" . $tgl_kembali_pcs[1] . "-" . $tgl_kembali_pcs[0];

  $selisih = strtotime($tgl_kembali_pcs) - strtotime($tgl_dateline_pcs);

  $selisih = $selisih / 86400;

  if ($selisih >= 1) {
    $hasil_tgl = floor($selisih);
  } else {
    $hasil_tgl = 0;
  }
  return $hasil_tgl;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Laporan Pengembalian <?= $tanggal ?></title>
  <link rel="icon" href="../../image/background/favicon.ico">
  <link rel="icon" href="../../image/background/favicon.ico" type="image/ico">
</head>

<body>
  <style type="text/css">
    .daftar-pesanan,
    .daftar-pesanan tr>td,
    .daftar-pesanan tr>th {
      border: 1px solid black;
      border-collapse: collapse;
      width: 100%;
    }

    .pembayaran tr>th {
      text-align: start;
    }

    .pembayaran {
      float: right;
    }

    table {
      border-style: double;
      border-width: 3px;
      border-color: white;
    }

    table tr .text2 {
      text-align: right;
      font-size: 13px;
    }

    table tr .text {
      text-align: center;
      font-size: 13px;
    }

    table tr td {
      font-size: 13px;
    }
  </style>
  <table class="data-pelanggan">
    <tr>
      <td><img src="../../image/download.jfif" width="100" height="120"></td>
      <td>
        <center>
          <font size="4">LAPORAN PENGEMBALIAN BUKU PERPUSTAKAAN</font><br>
          <font size="5"><b>SMK NEGERI 4 BOJONEGORO</b></font><br>
          <font size="2">Bidang Keahlian : Bisnis dan Menejemen - Teknologi informasi dan Komunikasi</font><br>
          <font size="2"><i>Jln Raya Sokowati Kode Pos : 68173 Telp./Fax (0331)758005 Sukowati Bojonegoro Jawa
              Timur</i></font>
        </center>
      </td>
    </tr>
    <!-- <table>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <tr>
                <td>Atas Nama</td>
                <td>:</td>
                <td><?= "jawa" ?></td>
            </tr>
            <tr>
                <td>Waktu</td>
                <td>:</td>
                <td><?= "jawa"; ?></td>
            </tr>
        </table><br> -->
    <table class="daftar-pesanan" cellpadding="5">
      <tr>
        <th>Kode Pinjam</th>
        <th>Kode Buku</th>
        <th>Peminjam</th>
        <th>Kelas</th>
        <th>Tgl Pinjam</th>
        <th>Tgl Kembali</th>
        <th>Denda</th>
      </tr>
      <?php
      $no = 1;
      foreach ($peminjaman as $data) {
        $tgl_dateline = $data['tgl_kembali'];
        $tgl_kembali = date('Y-m-d');
        $lambat = terlambat($tgl_dateline, $tgl_kembali);
        $denda1 = 1000;
        $denda = $lambat * $denda1;
      ?>
        <tr align="center">
          <td><?= $data['id_peminjaman']; ?></td>
          <td><?= $data['id_buku']; ?></td>
          <td><?= $data['nama']; ?></td>
          <td><?= $data['kelas']; ?></td>
          <td><?= $data['tgl_pinjam']; ?></td>
          <td><?= $data['tgl_kembali']; ?></td>
          <td>Rp. <?= $denda; ?></td>
        </tr>
      <?php } ?>
    </table>
  </table>
  <br>

</body>

</html>