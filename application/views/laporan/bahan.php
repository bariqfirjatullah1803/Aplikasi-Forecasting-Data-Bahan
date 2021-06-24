<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Laporan Data Bahan</title>
</head>

<body>
    <div class="container">
        <h1 style="text-transform: capitalize;">Data <span style="text-transform: lowercase;"><?= $bahan['nama_bahan']?></span></h1>
		<h2><?= $date1?> sampai <?= $date2?></h2>
        <?php
		$qtahunawal = $this->db->query("SELECT MIN(date_created) AS tahunawal FROM tb_transaksi")->row_array();
		$qtahunakhir = $this->db->query("SELECT MAX(date_created) AS tahunakhir FROM tb_transaksi")->row_array();
		$minTanggal = date("Y-m-d",strtotime($qtahunawal['tahunawal']));
		$maxTanggal = date("Y-m-d",strtotime("+10 Weeks",strtotime($qtahunakhir['tahunakhir'])));
		$tanggal1 = new DateTime($minTanggal);
		$tanggal2 = new DateTime($maxTanggal);
		$selisih = $tanggal1->diff($tanggal2)->days;
		// echo $selisih.'<br>';
		for ($i=0; $i < $selisih; $i++) { 
			$tgl = date("Y-m-d",strtotime('+'.$i.' Days',strtotime($minTanggal)));
			$arrayTgl[$tgl] = 0;
		}
		// $str = strtotime('+'.$selisih->days.' Days',strtotime($minTanggal));
		foreach ($transaksi as $item ) {
			$adate = strtotime($item['date_created']);
			for ($i=0; $i < 70; $i++) { 
				$tanggalTransaksi = date("Y-m-d",strtotime('+'.$i.' Days',$adate));
				$total = $item['jumlah'];
				$arrayTgl[$tanggalTransaksi] += $total;
			}
		}
		$d1 = new DateTime($date1);
		$d2 = new DateTime($date2);
		$selisih2 = $d1->diff($d2)->days;
		// echo $selisih2
	?>
        <table class="table table-striped forecast text-center">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <?php
				for ($i=0; $i < $selisih2; $i++) { 
					$tt = date("Y-m-d",strtotime('+'.$i.' Days',strtotime($date1)));
					echo '<tr>';
					echo '<td>'.$tt.'</td>';
					echo '<td>'.$arrayTgl[$tt].' '.$bahan['satuan'].'</td>';
					echo '</tr>';
				}
				// echo $arrayTgl['2021-08-15'];
			?>
            </tbody>
        </table>
    </div>
    <!-- <?= $sy2?> -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
    <script>
    window.print();
    setTimeout(window.close, 0);
    </script>
</body>

</html>
