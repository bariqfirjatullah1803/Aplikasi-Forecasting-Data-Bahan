<?php 
$queryTahun = $this->db->query("SELECT YEAR(date_created) as tahun FROM tb_transaksi GROUP BY YEAR(date_created)")->result_array();
$tahunMape = $tahun+1;
$queryPenjualan = $this->db->query("SELECT * FROM tb_transaksi WHERE YEAR(date_created) = $tahun")->result_array();
$queryPenjualanMape = $this->db->query("SELECT * FROM tb_transaksi WHERE YEAR(date_created) = $tahunMape")->result_array();
$arrayBulan=['Januari','Febuari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
for ($i=0; $i < 12; $i++) { 
	$arrayPenjualan[$i] = 0;
	$arrayPenjualanMape[$i] = 0;
}
foreach ($queryPenjualan as $qp ) {
	$arrayPenjualan[date("n",strtotime($qp['date_created']))-1]++;
}
foreach ($queryPenjualanMape as $qpm ) {
	$arrayPenjualanMape[date("n",strtotime($qpm['date_created']))-1]++;
}
if (count($arrayPenjualan)%2 == 0) {
	$x = -(count($arrayPenjualan)-1);
	$xp = 2;
}else {
	$x = -(count($arrayPenjualan)/2-0.5);
	$xp = 1;
}
$n = count($arrayPenjualan); 
$i = $sigmaY =$sigmaX = $sigmaXY = $sigmaXX = 0; 
?>
<div class="card">
    <div class="card-header">
        Data Penjualan <?= $tahun?>
    </div>
    <div class="card-body">
        <form class="mb-3" action="<?= base_url('forecast/penjualan')?>" method="POST">
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tahun</label>
                <div class="col-sm-10">
                    <select id="tahun" name="tahun" class="form-control">
                        <?php foreach ($queryTahun as $qt ) :?>
                        <option <?php echo $qt['tahun'] == $tahun ? 'selected':'';?> value="<?= $qt['tahun']?>">
                            <?= $qt['tahun']?></option>
                        <?php endforeach?>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Hitung</button>
        </form>
        <table class="table table-striped forecast text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Index Waktu</th>
                    <th>Total Penjualan</th>
                    <th>Kode Waktu</th>
                    <th>Perkalian Kode waktu dan Total Penjualan</th>
                    <th>Kuadrat Kode Waktu</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($arrayBulan as $ab):?>
                <tr>
                    <td><?= $i; ?></td>
                    <td><?= $ab; ?></td>
                    <td><?= $arrayPenjualan[$i]; ?></td>
                    <td><?= $x ?></td>
                    <td><?= $arrayPenjualan[$i]*$x; ?></td>
                    <td><?= $x*$x ?></td>
                </tr>
                <?php 
					$dataActual[$i] = $arrayPenjualanMape[$i];
					$sigmaY += $arrayPenjualan[$i];
					$sigmaX += $x;
					$sigmaXY += ($arrayPenjualan[$i]*$x);
					$sigmaXX += ($x*$x);
					$i++;
					$x += $xp;
				endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<?php
$j = 0;
foreach ($arrayBulan as $ab ) {
	$a = $sigmaY/$n;
	$b = $sigmaXY/$sigmaXX;
	$dataForecast[$j] = $Y = abs($a+$b*$x);
	// echo 'SigmaY = '.$sigmaY;
	// echo '<br>';
	// echo 'SigmaX = '.$sigmaX;
	// echo '<br>';
	// echo 'SigmaXY = '.$sigmaXY;
	// echo '<br>';
	// echo 'SigmaXX = '.$sigmaXX;
	// echo '<br>';
	// echo 'X = '.$x;
	// echo '<br>';
	// echo 'a = '.$sigmaY.'/'.$n;
	// echo '<br>';
	// echo 'a = '.$a;
	// echo '<br>';
	// echo 'b = '.$sigmaXY.'/'.$sigmaXX;
	// echo '<br>';
	// echo 'b = '.$b;
	// echo '<br>';
	// echo 'Y = '.$Y;
	// echo '<br>';
	// echo '-----------------------------';
	// echo '<br>';
	$sigmaXX += ($x*$x);
	$x+= $xp;
	$i++;
	$j++;
	$n++;
	$sigmaY += $Y;
	$sigmaXY += ($Y*$x);
}
?>
<div class="card">
    <div class="card-header">Forecast</div>
    <div class="card-body">
        <table class="table table-striped forecast text-center">
            <thead>
                <tr>
                    <td style="display: none;">#</td>
                    <td>Index Waktu (t)</td>
                    <td>Data Actual (at)</td>
                    <td>Data Forecast (ft)</td>
                    <td>Error (at-ft)</td>
                    <td>Absolute Error (|at-ft|)</td>
                    <td>Absolute Error/Actual (|(at-ft/at)|)</td>
                </tr>
            </thead>
            <tbody>
                <?php
				$i = 0; 
				$total = 0;
				foreach($arrayBulan as $ab):?>
                <tr>
                    <td style="display: none;"><?= $i?></td>
                    <td><?= $ab?></td>
                    <td><?= $at = $dataActual[$i]?></td>
                    <td><?= $ft = round($dataForecast[$i])?></td>
                    <td><?= $at - $ft?></td>
                    <td><?= abs($at - $ft)?></td>
                    <?php if($at != 0):?>
                    <td><?= abs(($at - $ft)/$at)?></td>
                    <?php else:?>
                    <td><?= abs(($at - $ft))?></td>
                    <?php endif?>
                </tr>
                <?php
				if ($at != 0) {
					$total += abs(($at - $ft)/$at);
				}else {
					$total += abs(($at - $ft));
				}
				$i++; 
				endforeach;?>
                <tr style="text-align: right">
                    <td style="display: none;"><?= $i?></td>
                    <td colspan="5">Jumlah</td>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>
                    <td><?= $total?></td>
                </tr>
                <tr style="text-align: right">
                    <td style="display: none;"><?= $i?></td>
                    <td colspan="5">n</td>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>
                    <td><?= count($arrayBulan)?></td>
                </tr>
                <tr style="text-align: right">
                    <td style="display: none;"><?= $i?></td>
                    <td colspan="5">MAPE</td>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>
                    <td style="display: none;"></td>
                    <td><?= $total/count($arrayBulan)?>%</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="card">
    <div class="card-header">
        Keuntungan
        <a href="<?= base_url('laporan/laba')?>" target="_blank" class="btn btn-sm btn-danger" style="float: right;"><i
                class="fas fa-print"></i> Cetak Laporan</a>
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
