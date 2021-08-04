<?php
for ($i = $minTahun['tahun']; $i <= $maxTahun['tahun']; $i++) {
    $total_penjualan[$i] = 0;
    $tahun[$i] = $i;
}
for ($t = 0; $t < count($penjualan); $t++) {
    $tp = $penjualan[$t]['tahun'];
    $total_penjualan[$tp] += $penjualan[$t]['terjual'];
    $arrtp[$t] = $penjualan[$t]['tahun'];
    $arrjp[$t] = $penjualan[$t]['terjual'];
    // echo $penjualan[$t]['tahun'].'|'.$penjualan[$t]['terjual'].'<br>';
}
$total_penjualan;
$gg = count($tahun)%2;
if($gg == 1){
    // echo 'ganjil';
    $median = (count($tahun)-1)/2;
    $na = 0 - $median;
    $plus = 1;
}else{
    // echo 'genap';
    $median = (count($tahun)+1)/2;
    $na = (0 - $median)-0.5;
    $plus = 2;
}
$n = count($tahun);
$sigmaY = $sigmaX = $sigmaXY = $sigmaXX = 0;
?>
<div class="row">
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                Data Penjualan Rumah Per Tahun
                <form action="<?= base_url('laporan/penjualan')?>" style="float:right" target="_blank" method="post">
                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-print"></i> Cetak
                        Laporan</button>
                </form>
            </div>
            <div class="card-body">
                <table class="table table-striped forecast text-center">
                    <thead>
                        <tr>
                            <th class="d-none">#</th>
                            <th>Tahun</th>
                            <th>Total Penjualan</th>
                            <th>Kode Waktu</th>
                            <th>Perkalian Kode waktu dan Total Penjualan </th>
                            <th>Kuadrat Kode Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $indexTahun = 0; $arrtahun = ''; $arrY = ''; $no = 1; foreach($tahun as $thn):?>
                        <tr>
                            <td class="d-none"><?= $no ?></td>
                            <td><?= $thn ?></td>
                            <?php $arrtahun .= "$thn". ", ";?>
                            <td><?= $y=$total_penjualan[$thn]?></td>
                            <?php $arrY .= "$y".", ";?>
                            <td><?= $x=$na ?></td>
                            <td><?= $xy=$x*$y ?></td>
                            <td><?= $xx=$x*$x ?></td>
                        </tr>
                        <?php 
						$forecastSatuan[$indexTahun] = $total_penjualan[$thn];
						$forecastTahunSatuan[$indexTahun] = $thn;
                    $na+=$plus; 
                    $no++;
                    $sigmaX += $x;
                    $sigmaY += $y;
                    $sigmaXY += $xy;
                    $sigmaXX += $xx; 
					$indexTahun++;
                endforeach;
                ?>
                        <tr>
                            <td class="d-none"><?= $no ?></td>
                            <td>Jumlah</td>
                            <td><?= $sigmaY ?></td>
                            <td><?= $sigmaX ?></td>
                            <td><?= $sigmaXY ?></td>
                            <td><?= $sigmaXX ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseHitung"
                aria-expanded="false" aria-controls="collapseHitung">Proses Hitung</button>
        </div>
    </div>
    <div class="col-6">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Keuntungan
                        <a href="<?= base_url('laporan/laba')?>" target="_blank" class="btn btn-sm btn-danger"
                            style="float: right;"><i class="fas fa-print"></i> Cetak Laporan</a>
                    </div>
                    <?php
				$transaksi = $this->db->query("SELECT YEAR(date_created) as tahun,SUM(biaya) as biaya FROM tb_transaksi GROUP BY YEAR(date_created)")->result_array();
			?>
                    <div class="card-body">
                        <table class="table table-striped forecast text-center">
                            <thead>
                                <tr>
                                    <th>Tahun</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($transaksi as $trans):?>
                                <tr>
                                    <td><?= $trans['tahun']?></td>
                                    <td><?= "Rp " . number_format($trans['biaya'],2,',','.');?></td>
                                </tr>
                                <?php endforeach?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-12">
				<div class="card mt-3">
					<div class="card-header">
						Forecast Per Tahun
					</div>
					<div class="card-body">
					<table class="table table-striped forecast text-center">
                            <thead>
                                <tr>
                                    <th>Tahun</th>
                                    <th>Data Aktual</th>
                                    <th>Data Forecast</th>
                                </tr>
                            </thead>
							<tbody>
								<?php for ($i=1; $i < count($forecastSatuan); $i++): ?>

								<tr>
									<td><?= $forecastTahunSatuan[$i]?></td>
									<td><?= $forecastSatuan[$i]?></td>
									<td></td>
								</tr>
								<?php endfor;?>
							</tbody>
					</table>
					</div>
				</div>
            </div>
        </div>

    </div>
</div>

<?php
    $a = $sigmaY / $n;
    $b = $sigmaXY/$sigmaXX;
    $fx = $n+1;
    $fy = round($a + $b * $fx);
    $thn++;
    $arrtahun .= "$thn". ", ";
    $arrY .= "$fy".", ";
    // echo $fy;
?>
<div class="collapse" id="collapseHitung">
    <div class="card card-body">
        <p><b> Keterangan </b></p>
        <p> Y' = a + b.X </p>
        <p> a = ∑Y/N </p>
        <p> b = ∑XY/∑X2 </p>
        <p> dimana</p>
        <p> N = jumlah data </p>
        <p> X = variabel bebas </p>
        <p> Y' = variabel terikat </p>
        <p> a = nilai konstanta </p>
        <p> b = koefidien arah regresi </p>

        a = <?= $sigmaY?> / <?= $n?><br>
        a = <?= $a ?><br>
        b = <?= $sigmaXY?> / <?= $sigmaXX?><br>
        b = <?= $b?><br>
        Y' = <?= $a ?> + <?= $b ?> * <?= $fx?><br>
        Y' = <?= $fy?>
    </div>
</div>
<div class="card mt-3">
    <div class="card-header">
        Forecast
    </div>
    <div class="card-body">
        <div class="card-text">Hasil penjualan pada tahun <?=$thn?> = <?= $fy?> unit rumah</div>
    </div>
</div>
<!-- <div class="card mt-3">
    <div class="card-header">Grafik</div>
    <div class="card-body">
        <canvas id="myChart" width="400" height="100"></canvas>

    </div>
</div>

<script>
var ctx = document.getElementById('myChart');
const tahun = [<?= $arrtahun?>];
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: tahun,
        datasets: [{
                label: 'Penjualan',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [<?= $arrY;?>],
            },

        ]
    },
    options: {}
});
</script> -->
