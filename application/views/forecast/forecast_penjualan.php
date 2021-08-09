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
                    <th style="display: none;">#</th>
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
                    <td style="display: none;"><?= $i; ?></td>
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
        <button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#collapseHitung"
            aria-expanded="false" aria-controls="collapseHitung">Proses Hitung</button>
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

                <?php
					$j = 0;
					$a = $sigmaY/$n;
					$b = $sigmaXY/$sigmaXX;
					$dataForecast[$j] = $Y = abs($a+$b*$x);
					foreach ($arrayBulan as $ab ) {
						$arrayPenjualan[$n] = $Y;
						$sigmaY = $sigmaXY = $sigmaXX = 0;
						// $sigmaXX += ($x*$x);
						if ($n%2 == 0) {
							$x = -($n-1);
							$xp = 2;
						}else {
							$x = -($n/2-0.5);
							$xp = 1;
						}
						// echo '<table class="table table-striped forecast text-center">
						// <thead>
						// <tr>
						// <th>#</th>
						// <th>Y</th>
						// <th>X</th>
						// <th>XY</th>
						// <th>XX</th>
						// </tr>
						// </thead>
						// <tbody>';
						for ($z=0; $z < $n; $z++) { 
							// echo'<tr>';
							// echo '<td>'.$z.'</td>';
							// echo '<td>'.$arrayPenjualan[$z].'</td>';
							// echo '<td>'.$x.'</td>';
							$XY = $arrayPenjualan[$z]*$x;
							$XX = $x*$x;
							$sigmaY += $arrayPenjualan[$z];
							$sigmaXY += $XY;
							// echo '<td>'.$XY.'</td>';
							// echo '<td>'.$XX.'</td>';
							$sigmaX += $x;
							$sigmaXX += $XX;
							$x+= $xp;
							// echo '</tr>';
						}
						// echo '<tr>
						// <td>'.$z.'</td>
						// <td>'.$sigmaY.'</td>
						// <td>'.$sigmaX.'</td>
						// <td>'.$sigmaXY.'</td>
						// <td>'.$sigmaXX.'</td>
						// </tr>';
						// echo '</tbody></table>';
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
						// echo $ab;
						// echo '<br>';
						echo 'a = '.$sigmaY.'/'.$n;
						echo '<br>';
						echo 'a = '.$a;
						echo '<br>';
						echo 'b = '.$sigmaXY.'/'.$sigmaXX;
						echo '<br>';
						echo 'b = '.$b;
						echo '<br>';
						echo 'Y = '.$a.'+'.$b.'*'.$x;
						echo '<br>';
						echo 'Y = '.$Y;
						echo '<br>';
						echo '-----------------------------';
						echo '<br>';
						$a = $sigmaY/$n;
						$b = $sigmaXY/$sigmaXX;
						$dataForecast[$j] = $Y = abs($a+$b*$x);
						$i++;
						$j++;
						$n++;
						// $sigmaY += $Y;
						// $sigmaXY += ($Y*$x);
					}
					?>
               
            </div>
        </div>
    </div>
</div>
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
                $hasilforecast = 0;
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
                    <td><?= number_format(abs(($at - $ft)/$at),2)?></td>
                    <?php else:?>
                    <td><?= 0?></td>
                    <?php endif?>
                </tr>
                <?php
				if ($at != 0) {
					$total += abs(($at - $ft)/$at);
				}else {
					$total += 0;
				}
                $hasilforecast += $ft;
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
                    <td><?= number_format($total/count($arrayBulan)*100,2)?> %</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="card">
    <div class="card-header">
        Hasil Forecast Pada Tahun <?= $tahun+1?>
    </div>
    <div class="card-body">
        Terjual <?= $hasilforecast?> unit rumah
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
