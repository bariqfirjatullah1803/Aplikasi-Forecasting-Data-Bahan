<?php 
    // Query
    $qtahunawal = $this->db->query("SELECT MIN(date_created) AS tahunawal FROM tb_transaksi")->row_array();
    $qtahunakhir = $this->db->query("SELECT MAX(date_created) AS tahunakhir FROM tb_transaksi")->row_array();
    $tahunawal = date("Y",strtotime($qtahunawal['tahunawal']));
    $tahunakhir = date("Y",strtotime("+10 Weeks",strtotime($qtahunakhir['tahunakhir'])));

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
    </div>
    <div class="card-body" style="overflow-x: scroll">
        <table class="table table-striped forecast">
            <thead>
                <tr>
                    <th scope="col" style="display:none">#</th>
                    <th scope="col">Nama Bahan</th>
                    <?php foreach($periode as $p):?>
                    <th scope="col"><?= $p?></th>
                    <?php endforeach?>
                    <!-- <th scope="col">Jumlah Bahan</th> -->
                    <!-- <th scope="col">X</th>
                    <th scope="col">XY</th>
                    <th scope="col">XX</th> -->
                </tr>
            </thead>
            <tbody>
                <?php $number = 1; foreach ($bahan as $b):?>
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
                    <?php $cp = count($periode)+1; foreach($periode as $p):?>
                    <th scope="col">Periode <?= $cp?></th>
                    <?php $cp++; endforeach?>
                    <!-- <th scope="col">Jumlah Bahan</th> -->
                </tr>
            </thead>
            <tbody>
                <?php 
                $fnumber = 1; 
                foreach ($bahan as $bh ) :?>
                <tr>
                    <td style="display:none"><?= $fnumber; ?></td>
                    <td><?= $bh['nama_bahan']?></td>

                    <?php 
                    $nbh = $bh['id_bahan'];
                    $x = $nilwal;
                    $n =  count($periode);
                    $fp = $n + 1;
                    $fsy = $sigmaY[$nbh];
                    $fsxy = $sigmaXY[$nbh];
                    $fsxx = $sigmaXX[$nbh];
                    $fn = 1;
                    foreach ($periode as $p ) {
                        
                        $a = $fsy/$n;
                        $b = $fsxy/$fsxx;
                        $fy = $a+$b*$x;
                        // echo 'Periode '.$fp.'<br>';
                        // echo 'a = '.$fsy.'/'.$n.'<br>';
                        // echo 'a = '.$a.'<br>';
                        // echo 'b = '.$fsxy.'/'.$fsxx.'<br>';
                        // echo 'b = '.$b.'<br>';
                        // echo 'Y = '.$a.' + '.$b.' x '.$x.'<br>';
                        // echo 'Y = '.$fy.'<br>';
                        ?>
                    <td><?= round($fy).' '.$bh['satuan']?></td>
                    <?php
                        $fxy = $fy*$x;
                        $fxx = $x*$x;
                        $tfsy= $fsy;
                        // echo '--------------------<br>';
                        $x+= 2;
                        $n++;
                        $fp++;
                        $fsy += $fy;
                        $fsxy += $fxy;
                        $fsxx += $fxx;
                       
                        $fn++;
                    }
                   ?>
                </tr>
                <?php $fnumber++; endforeach;?>
            </tbody>
        </table>
    </div>
</div>
<!-- <canvas id="myChart" width="400" height="100"></canvas> -->