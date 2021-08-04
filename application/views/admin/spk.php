<?php
$now = date("Y-m-d",time());
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Perintah Kerja</title>
    <style>
    .container {
        padding: 30px;
    }

    .kop-surat {
        text-align: center;
        line-height: 5px;
		border-bottom: 3px solid #000;
    }

    .kop-surat img {
        width: 100px;
        margin-bottom: 20px;
    }

    .kop-surat b {
        font-size: 20px;
    }

    .kop-surat h5 {
        font-size: 16px;
        font-weight: 300;
    }

    .title {
        text-align: center;
        font-size: 20px;
    }

    .ttd {
        float: right;
        text-align: center;
        margin-right: 20px;
		margin-bottom: 50px;
    }

    .ttd .tgl {
        margin-bottom: 100px;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="kop-surat">
            <img src="<?= base_url('assets/img/')?>logopt.jpeg" alt="" srcset="">
            <br><b>PT TANIYA MULTI PROPERTI</b>
            <h5>JL.RAYA CURUNGREJO KEC.KEPANJEN KAB.MALANG</h5>
            <h5>NO. HP 081358695449</h5>
        </div>
        <div class="container">

            <div class="info-surat">
                <div class="title"><b><u>Surat Perintah</u></b></div>
                <p>Nama : <?= $querySpk['nama_pemilik']?></p>
                <p>Jabatan : <?= $querySpk['jabatan_pemilik']?></p>
            </div>
            <div class="isi-surat">
                <div class="title"><b><u>Memerintahkan</u></b></div>
                <p>Kepada,</p>
                <dl>
                    <dd>Nama : <?= $querySpk['nama_pekerja']?></dd>
                    <dd>Jabatan : <?= $querySpk['jabatan_pekerja']?></dd>
                    <dd>Alamat : <?= $querySpk['alamat_pekerja']?></dd>
                    <dd>Tanggal Pelaksanaan : <?= $querySpk['date_created']?></dd>
            </div>
            <p>Untuk,</p>
            <div class="info">
                <ol>
                    <li>Memproses pengerjaan lahan di desa Pidek RT/RW 009/003 Pkisaji -
                        Kab.Malang</li>
                    <li>Proses pembangunan sebanyak 1 unit.</li>
                    <li>Pembangunan dilakukan pada blok berikut :
                        <ul>
                            <li>Kavling <?= $queryTransaksi['unit']?> (<?= $queryTransaksi['nama_plan']?>) type rumah
                                <?= $queryTransaksi['type_rumah']?> A.n <?= $queryTransaksi['nama_pembeli']?></li>
                        </ul>
                    </li>
                </ol>
            </div>
        </div>
        <div class="ttd">
            <div class="tgl">Malang, <?= $now?></div>
            <div class="nama"><?= $querySpk['nama_pemilik']?></div>
        </div>
    </div>
    <script>
    window.print();
    setTimeout(window.close, 0);
    </script>

</body>

</html>
