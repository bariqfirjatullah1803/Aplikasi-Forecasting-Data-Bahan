<?php 
    // Query
    $qtahunawal = $this->db->query("SELECT MIN(date_created) AS tahunawal FROM tb_transaksi")->row_array();
    $qtahunakhir = $this->db->query("SELECT MAX(date_created) AS tahunakhir FROM tb_transaksi")->row_array();
    $tahunawal = date("Y",strtotime($qtahunawal['tahunawal']));
    $tahunakhir = date("Y",strtotime("+10 Weeks",strtotime($qtahunakhir['tahunakhir'])));
	$minTanggal = date("Y-m-d",strtotime($qtahunawal['tahunawal']));
    $maxTanggal = date("Y-m-d",strtotime("+10 Weeks",strtotime($qtahunakhir['tahunakhir'])));

    for ($j=1; $j <= count($bahan); $j++) { 
        for ($t=$tahunawal; $t <= $tahunakhir; $t++) { 
            $tahun[$t]=$t;
            for ($i=1; $i <= 12; $i++) { 
                $month[$i] = 0;
                $periode[$i] = "Periode ".$i;
                // echo $t.' '.$i.' '.$bahan[$j]['nama_bahan'].'<br>';
                $tbb[$j][$t][$i] = 0;
            }
        }
    }
	$arrayBulan=['Januari','Febuari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
?>

<?php foreach ($transaksi as $trns ) :?>

<?php
    $adate = strtotime($trns['date_created']);
    for ($i=0; $i <= 70; $i++) { 
        $weeks = strtotime('+'.$i.' Days',$adate);
        $mm = intval(date('m',$weeks));
        $yy = intval(date('Y',$weeks));
        $bb = $trns['id_bahan'];
        $total =  $trns['harga']*$trns['jumlah'];
        $tbb[$bb][$yy][$mm] += $total;

    }
    if($ft){

        $ft;
    }else{
		$ft = $tahunawal;
	}
    if($bh){

    }else{
        $minBahan = $this->db->query("SELECT MIN(id_bahan) as minid FROM tb_bahan")->row_array();
        $bh = $minBahan['minid'];
    }
?>
<?php endforeach?>
<!-- <div class="row my-4">
    <div class="col-12">
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseForecast"
            aria-expanded="false" aria-controls="collapseLaporan">Forecast</button>
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseLaporan"
            aria-expanded="false" aria-controls="collapseLaporan">Laporan</button>
    </div>
</div> -->
<div class="card">
    <div class="card-header">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                    aria-controls="pills-home" aria-selected="true">Forecast</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab"
                    aria-controls="pills-contact" aria-selected="false">Laporan</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <form action="<?= base_url('forecast')?>" method="post">
                    <div class="row">
                        <div class="col-5">
                            <div class="form-group row">
                                <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
                                <select name="tahun" class="form-control col-sm-10" id="exampleFormControlSelect1">
                                    <?php foreach($tahun as $tahunaja):?>
                                    <option value="<?= $tahunaja?>" <?php if($ft == $tahunaja){echo "selected";}?>>
                                        <?= $tahunaja?>
                                    </option>
                                    <?php endforeach?>
                                </select>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group row">
                                <label for="bahan" class="col-sm-2 col-form-label">Bahan</label>
                                <select name="bahan" class="form-control col-sm-10" id="exampleFormControlSelect1">
                                    <?php foreach($bahan as $item):?>
                                    <option value="<?= $item['id_bahan']?>"
                                        <?php if($bahanById['id_bahan'] == $item['id_bahan']){echo 'selected';}?>>
                                        <?= $item['nama_bahan']?>
                                    </option>
                                    <?php endforeach?>
                                </select>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="Hitung">
                            </div>
                        </div>
                    </div>
                </form>
                <table class="table table-striped forecast text-center">
                    <thead>
                        <tr>
                            <th style="display: none;">#</th>
                            <th>Index Waktu</th>
                            <th>Total Bahan</th>
                            <th>Kode Waktu</th>
                            <th>Perkalian Kode waktu dan Total Bahan</th>
                            <th>Kuadrat Kode Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
						$ib = $bahanById['id_bahan'];
						$bt = $ft;
						$keys = array_keys($tbb[$ib][$bt]);
						$ck = count($keys);
						$med = ($ck + 1) / 2;
						$nilwal = (0 - $med) - 2.5 - 2;
						$sigmaY[$ib] = $sigmaX[$ib] = $sigmaXY[$ib] = $sigmaXX[$ib] = 0;
						$iw = 0; 
						$no = 1;
						$sy1='';
						foreach($arrayBulan as $ab):?>
                        <tr>
                            <?php 
							$y = $tbb[$ib][$bt][$no];
							$xy = $tbb[$ib][$bt][$no] * $nilwal; 
							$xx = $nilwal * $nilwal; 
							?>
                            <td style="display: none;"><?= $iw; ?></td>
                            <td><?= $ab; ?></td>
                            <td><?= round($y).' '.$bahanById['satuan']?></td>
                            <td><?= $nilwal?></td>
                            <td><?= round($xy)?></td>
                            <td><?= $xx?></td>
                        </tr>
                        <?php 
							$iw++;
							$sigmaX[$ib] += $nilwal;
							$nilwal+=2;
							$no++;
							$sigmaY[$ib] += $y;
							$sigmaXY[$ib] += $xy;
							$sigmaXX[$ib] += $xx;
							$sigY = round($sigmaY[$ib]);
							$sy1 .= "$sigY". ", ";
							intval($sigmaX[$ib]);
							intval  ($sigmaXY[$ib]);
							intval($sigmaXX[$ib]);
						endforeach;?>
                        <tr>
                            <td style="display: none;"><?= $iw?></td>
                            <td>Sigma</td>
                            <td><?= round($sigmaY[$ib])?></td>
                            <td><?= $sigmaX[$ib]?></td>
                            <td><?= round($sigmaXY[$ib])?></td>
                            <td><?= $sigmaXX[$ib]?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-striped forecast text-center mt-5">
                    <thead>
                        <tr>
                            <th style="display: none;">#</th>
                            <th>Index Waktu</th>
                            <th>Data Actual</th>
                            <th>Data Forecast</th>
                            <th>Error</th>
                            <th>Absolute Error</th>
                            <th>Absolute Error/Actual</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
							$iw = 1; 
							$nbh = $bahanById['id_bahan'];
							// $x = $nilwal;
							if ($no%2 == 0) {
								$x = -($no-1);
								$xp = 2;
							}else {
								$x = -($no/2-0.5);
								$xp = 1;
							}
							$n =  count($periode);
							$fp = 0;
							$fsy = $sigmaY[$nbh];
							$fsxy = $sigmaXY[$nbh];
							$fsxx = $sigmaXX[$nbh];
							$tfsy = 0;
							$hasilforecast = 0;
							$i = 0; 
							$total = 0;
							$a = $fsy/$n;
							$b = $fsxy/$fsxx;
							$fy = $a+$b*$no; 
							$hfh = 0;
							foreach($arrayBulan as $ab):
								$tbb[$ib][$bt][$no] = $fy;
								$sigmaX = $fsy = $fsxy = $fsxx = 0;
								if ($n%2 == 0) {
									$x = -($n-1);
									$xp = 2;
								}else {
									$x = -($n/2-0.5);
									$xp = 1;
								}

								for ($z=1; $z <= $n; $z++) { 
									$XY = $tbb[$ib][$bt][$z] * $x;
									$XX = $x*$x;
									$fsy += $tbb[$ib][$bt][$z];
									$fsxy += $XY;
									$sigmaX += $x;
									$fsxx += $XX;		
									$x+= $xp;
								} 	
								$a = $fsy/$n;
								$b = $fsxy/$fsxx;
								$dataForecast[$j] = $fy = abs($a+$b*$x);
								$arrayForecast[$i]['bulan'] = $ab;
								$arrayForecast[$i]['a'] = 'a = '.$fsy.'/'.$n;
								$arrayForecast[$i]['hasilA'] = 'a = '.$a;
								$arrayForecast[$i]['b']='b = '.$fsxy.'/'.$fsxx;
								$arrayForecast[$i]['hasilB'] = 'b = '.$b;
								$arrayForecast[$i]['Y'] = 'Y` = '.$a.' + '.$b.' x '.$x;
								$arrayForecast[$i]['hasilY'] = 'Y` = '.$fy;
							?>
                        <tr>
                            <td style="display: none;"><?= $iw?></td>
                            <td><?= $ab?></td>
                            <td><?= $at = round($tbb[$ib][$bt+1][$iw]);?></td>
                            <td><?= $fd = round($fy)?></td>
                            <td><?= $e = $at - $fd ?></td>
                            <td><?= $ae = abs($at-$fd) ?></td>
                            <?php if($at != 0):?>
                            <td><?= abs(($at - $fd)/$at)?></td>
                            <?php else:?>
                            <td><?= 0?></td>
                            <?php endif?>
                        </tr>
                        <?php 
						 $hfh += $fd;
							$iw++;
							// $fxy = $fy*$x;
							// $fxx = $x*$x;
							// $tfsy += $fy;
							$n++;
							$fp++;
							// $fsy += $fy;
							// $fsxy += $fxy;
							// $fsxx += $fxx;
							if ($at != 0) {
								$total += abs(($at - $fd)/$at);
							}else {
								$total += 0;
							}
							$hasilforecast += $fd;
							$i++; 
							$no++;
							 endforeach?>
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
                            <td><?= number_format($total/count($arrayBulan),2)?> %</td>
                        </tr>
                    </tbody>
                </table>
                <button class="btn btn-primary btn-block" type="button" data-toggle="collapse"
                    data-target="#collapseHitung" aria-expanded="false" aria-controls="collapseHitung">Proses
                    Hitung</button>
                <div class="card mt-3">
                    <div class="card-body">
                        Hasil forecast <?= $bahanById['nama_bahan']?> pada tahun <?= $ft+1?> <?= $hfh?>
                        <?= $bahanById['satuan']?>
                    </div>
                </div>
                <div class="collapse" id="collapseHitung">
                    <div class="card card-body">
                        <div class="alert alert-secondary" role="alert">
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


                        </div>
                        <?php 
			echo $bahanById['nama_bahan'].'<br>';
			for ($i=0; $i < 12; $i++) {  
				echo $arrayForecast[$i]['bulan'].'<br>';
				echo $arrayForecast[$i]['a'].'<br>';
				echo $arrayForecast[$i]['hasilA'].'<br>';
				echo $arrayForecast[$i]['b'].'<br>';
				echo $arrayForecast[$i]['hasilB'].'<br>';
				echo $arrayForecast[$i]['Y'].'<br>';
				echo $arrayForecast[$i]['hasilY'].'<br>';
			}
			?>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <?php
					if ($date1) {
						$date1;
					}else {
						$date1 = $minTanggal;
					}
					if ($date2) {
						$date2;
					}else {
						$date2 = $maxTanggal;
					}
					$tanggal1 = new DateTime($minTanggal);
					$tanggal2 = new DateTime($maxTanggal);
					$selisih = $tanggal1->diff($tanggal2)->days;
					// echo $selisih.'<br>';
					for ($i=0; $i < $selisih; $i++) { 
						$tgl = date("Y-m-d",strtotime('+'.$i.' Days',strtotime($minTanggal)));
						$arrayTgl[$tgl] = 0;
					}
					// $str = strtotime('+'.$selisih->days.' Days',strtotime($minTanggal));
					foreach ($transaksiById as $item ) {
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
				?>

                <form action="<?= base_url('forecast')?>" method="post" class="mb-3">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group row">
                                <label for="bahan" class="col-sm-4 col-form-label">Bahan</label>
                                <select name="bahan" class="form-control col-sm-8" id="exampleFormControlSelect1">
                                    <?php foreach($bahan as $item):?>
                                    <option value="<?= $item['id_bahan']?>"
                                        <?php if($bahanById['id_bahan'] == $item['id_bahan']){echo 'selected';}?>>
                                        <?= $item['nama_bahan']?>
                                    </option>
                                    <?php endforeach?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group row">
                                <label for="startDate" class="col-sm-4 col-form-label">Tanggal Mulai</label>
                                <input name="date1" type="date" class="form-control col-sm-8" min="<?= $minTanggal?>"
                                    max="<?= $maxTanggal?>" value="<?= $date1?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group row">
                                <label for="startDate" class="col-sm-4 col-form-label">Sampai Tanggal</label>
                                <input name="date2" type="date" class="form-control col-sm-8" min="<?= $minTanggal?>"
                                    max="<?= $maxTanggal?>" value="<?= $date2?>">
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary btn-block" value="Tampilkan">
                </form>
                <form class="mb-3" action="<?= base_url('laporan/bahan')?>" target="_blank" method="post">
                    <input type="hidden" name="bahan" value="<?= $bahanById['id_bahan']?>">
                    <input type="hidden" name="date1" value="<?= $date1?>">
                    <input type="hidden" name="date2" value="<?= $date2?>">
                    <button type="submit" class="btn btn-danger btn-block"><i class="fas fa-print"></i>
                        Cetak</button>
                </form>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Bahan</th>
                            <th>Tanggal</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
							for ($i=0; $i < $selisih2; $i++) { 
								$tt = date("Y-m-d",strtotime('+'.$i.' Days',strtotime($date1)));
								echo '<tr>';
								echo '<td>'.$bahanById['nama_bahan'].'</td>';
								echo '<td>'.$tt.'</td>';
								echo '<td>'.ceil($arrayTgl[$tt]).' '.$bahanById['satuan'].'</td>';
								echo '</tr>';
							}
							// echo $arrayTgl['2021-08-15'];
						?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!--  <div class="card mt-3">
        <div class="card-header">Grafik</div>
        <div class="card-body">
            <canvas id="myChart" width="400" height="100"></canvas>

        </div>
    </div>
</div>
<script>
var ctx = document.getElementById('myChart');
// const labels = [<?= $arrp?>];
const bahan = [<?= $arbahan?>];
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: bahan,
        datasets: [{
                label: <?= $ft?>,
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: [<?= $sy1?>],
            },
            {
                label: <?= $ft + 1?>,
                backgroundColor: 'blue',
                borderColor: 'blue',
                data: [<?= $sy2?>],
            },

        ]
    },
    options: {}
});
</script> -->
