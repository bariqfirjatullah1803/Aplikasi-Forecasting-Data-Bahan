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
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-10">
                <form action="<?= base_url('forecast')?>" method="post">
                    <div class="row">
                        <div class="col-6">
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
                        <div class="col-2">
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="Hitung">
                            </div>
                        </div>
                    </div>
                </form>
                <!-- Data Bahan Tahun <?= $ft?> -->
            </div>
            <div class="col-2">
                <button class="btn btn-danger btn-block" type="button" data-toggle="collapse"
                    data-target="#collapseLaporan" aria-expanded="false" aria-controls="collapseLaporan"><i
                        class="fas fa-print"></i>Laporan</button>
                <!-- <form action="<?= base_url('laporan')?>" target="_blank" method="post">
                    <input type="hidden" value="<?= $ft?>" name="tahun">
                    <button type="submit" class="btn btn-danger"><i class="fas fa-print"></i> Cetak Laporan</button>
                </form> -->
            </div>
        </div>
    </div>
    <div class="card-body" style="overflow-x: scroll">
        <div class="collapse" id="collapseLaporan">
            <form action="<?= base_url('laporan/bahan')?>" target="_blank" method="post" class="mb-3">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group row">
                            <label for="bahan" class="col-sm-4 col-form-label">Bahan</label>
                            <select name="bahan" class="form-control col-sm-8" id="exampleFormControlSelect1">
                                <?php foreach($bahan as $item):?>
                                <option value="<?= $item['id_bahan']?>">
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
                                max="<?= $maxTanggal?>" value="<?= $minTanggal?>">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group row">
                            <label for="startDate" class="col-sm-4 col-form-label">Sampai Tanggal</label>
                            <input name="date2" type="date" class="form-control col-sm-8" min="<?= $minTanggal?>"
                                max="<?= $maxTanggal?>"value="<?= $maxTanggal?>">
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary btn-block" value="Print">
            </form>
        </div>
        <table class="table table-striped forecast text-center ">
            <thead>
                <tr>
                    <th scope="col" style="display:none">#</th>
                    <th scope="col">Nama Bahan</th>
                    <?php $arrp=''; foreach($arrayBulan as $ab):?>
                    <th scope="col"><?= $ab?></th>
                    <?php $arrp .= "'$ab'". ", ";  endforeach?>
                </tr>
            </thead>
            <tbody>
                <?php $sy1=''; $number = 1; foreach ($bahan as $b):?>
                <tr>
                    <td style="display:none"><?= $number; ?></td>
                    <td><?= $b['nama_bahan']?></td>

                    <?php 
                        $ib = $b['id_bahan'];
                        $bt = $ft;
                        $keys = array_keys($tbb[$ib][$bt]);
                        $ck = count($keys);
                        $med = ($ck + 1) / 2;
                        $nilwal = (0 - $med) - 2.5 - 2;
                        $sigmaY[$ib] = $sigmaX[$ib] = $sigmaXY[$ib] = $sigmaXX[$ib] = 0;
                        $no = 1; 
                        foreach($periode as $p):
                            $y = $tbb[$ib][$bt][$no];
                    ?>
                    <td><?= round($y).' '.$b['satuan']?></td>
                    <?php 
                        $nilwal; 
                        $xy = $tbb[$ib][$bt][$no] * $nilwal; 
                        $xx = $nilwal * $nilwal; 
                        $nilwal+=2;
                        $no++;
                        $sigmaY[$ib] += $y;
                        $sigmaX[$ib] += $nilwal;
                        $sigmaXY[$ib] += $xy;
                        $sigmaXX[$ib] += $xx;
                        endforeach;
                    ?>
                    <!-- <td><?= round($sigmaY[$ib]).' '.$b['satuan'] ?></td> -->
                </tr>
                <?php
                $sigY = round($sigmaY[$ib]);
               $sy1 .= "$sigY". ", ";
               intval($sigmaX[$ib]);
               intval  ($sigmaXY[$ib]);
               intval($sigmaXX[$ib]);
                ?>

                <?php $number++; endforeach?>
            </tbody>
        </table>
    </div>
</div>
<div class="card mt-3">
    <div class="card-header">
        Forecast Tahun <?= $ft + 1?>
    </div>
    <div class="card-body" style="overflow-x: scroll">
        <table class="table table-striped forecast">
            <thead>
                <tr>
                    <th scope="col" style="display:none">#</th>
                    <th scope="col">Nama Bahan</th>
                    <?php foreach($arrayBulan as $ab):?>
                    <th scope="col"><?= $ab?></th>
                    <?php endforeach?>
                    <!-- <th scope="col">Jumlah Bahan</th> -->
                </tr>
            </thead>
            <tbody>
                <?php 
                $fnumber = 1; 
                $arbahan = '';
				$fn = 0;
                
                $sy2 = '';
                foreach ($bahan as $bh ) :?>
                <tr>
                    <?php 
                    $nbahan = $bh['nama_bahan'];
                    $arbahan .= "'$nbahan'". ", ";
                    ?>
                    <td style="display:none"><?= $fnumber; ?></td>
                    <td><?= $nbahan?></td>

                    <?php 
                    $nbh = $bh['id_bahan'];
                    $x = $nilwal;
                    $n =  count($periode);
                    $fp = 0;
                    $fsy = $sigmaY[$nbh];
                    $fsxy = $sigmaXY[$nbh];
                    $fsxx = $sigmaXX[$nbh];
                    $tfsy = 0;
					$arrayForecast[$fn]['nama_bahan'] = $nbahan;
                    foreach ($arrayBulan as $ab ) {
                        
                        $a = $fsy/$n;
                        $b = $fsxy/$fsxx;
                        $fy = $a+$b*$x;
                        $arrayForecast[$fn]['bulan'][$fp] = $ab;
                        $arrayForecast[$fn]['a'][$fp] = 'a = '.$fsy.'/'.$n;
                        $arrayForecast[$fn]['hasilA'][$fp] = 'a = '.$a;
                        $arrayForecast[$fn]['b'][$fp]='b = '.$fsxy.'/'.$fsxx;
                        $arrayForecast[$fn]['hasilB'][$fp] = 'b = '.$b;
                        $arrayForecast[$fn]['Y'][$fp] = 'Y = '.$a.' + '.$b.' x '.$x;
                        $arrayForecast[$fn]['hasilY'][$fp] = 'Y = '.$fy;
                        ?>
                    <?php if ($fy >= 0 ):?>
                    <td><?= round($fy).' '.$bh['satuan']?></td>
                    <?php else:?>
                    <td>0<?= $bh['satuan']?></td>
                    <?php endif?>
                    <?php
                        $fxy = $fy*$x;
                        $fxx = $x*$x;
                        $tfsy += $fy;
                        $x+= 2;
                        $n++;
                        $fp++;
                        $fsy += $fy;
                        $fsxy += $fxy;
                        $fsxx += $fxx;
                       
                        
                    }
                    $sigY2 = round($tfsy);
                        $sy2 .= "$sigY2". ", ";
                    // echo $sigY2.'<br>';
                   ?>
                </tr>
                <?php $fn++;$fnumber++; endforeach;?>
            </tbody>
        </table>
    </div>
    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseHitung"
        aria-expanded="false" aria-controls="collapseHitung">Proses Hitung</button>
    <div class="collapse" id="collapseHitung">
        <div class="card card-body">
            <?php 
			echo $arrayForecast[0]['nama_bahan'].'<br>';
			for ($i=0; $i < 12; $i++) { 
				echo $arrayForecast[0]['bulan'][$i].'<br>';
				echo $arrayForecast[0]['a'][$i].'<br>';
				echo $arrayForecast[0]['hasilA'][$i].'<br>';
				echo $arrayForecast[0]['b'][$i].'<br>';
				echo $arrayForecast[0]['hasilB'][$i].'<br>';
				echo $arrayForecast[0]['Y'][$i].'<br>';
				echo $arrayForecast[0]['hasilY'][$i].'<br>';
			}
			?>
        </div>
    </div>
</div>
<div class="card mt-3">
    <div class="card-header">Grafik</div>
    <div class="card-body">
        <canvas id="myChart" width="400" height="100"></canvas>

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
</script>
