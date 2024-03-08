<?php
include "../../connection/koneksi.php";
date_default_timezone_set("Asia/jakarta");
$tanggal = date('d-m-Y');
$peminjaman = mysqli_query($conn, "SELECT * FROM tb_peminjaman JOIN tb_buku ON tb_peminjaman.id_buku = tb_buku.id_buku JOIN tb_anggota ON tb_peminjaman.id_peminjam = tb_anggota.id_anggota WHERE tb_peminjaman.status_buku = 'Pinjam'");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peminjaman <?= $tanggal ?></title>
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
                    <font size="4">LAPORAN PEMINJAMAN BUKU PERPUSTAKAAN</font><br>
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
                <th>No</th>
                <th>Kode Pinjam</th>
                <th>Kode Buku</th>
                <th>Peminjam</th>
                <th>Kelas</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
            </tr>
            <?php
            $no = 1;
            foreach ($peminjaman as $data) { ?>
                <tr align="center">
                    <td><?= $no++; ?></td>
                    <td><?= $data['id_peminjaman']; ?></td>
                    <td><?= $data['id_buku']; ?></td>
                    <td><?= $data['nama']; ?></td>
                    <td><?= $data['kelas']; ?></td>
                    <td><?= $data['tgl_pinjam']; ?></td>
                    <td><?= $data['tgl_kembali']; ?></td>
                </tr>
            <?php } ?>
        </table>
    </table>
    <br>

</body>

</html>