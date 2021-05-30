<?php 
    foreach($bahan as $b){
        $idbahan = $b['id_bahan'];
        $arrbahan[$idbahan] = $b['nama_bahan'];
      
    }

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

<form action="<?= base_url('forecast/forecast')?>" method="post">
    <div class="row">
        <div class="col-4">
            <div class="form-group row">
                <label for="tahun" class="col-sm-2 col-form-label">Tahun</label>
                <select name="tahun" class="form-control col-sm-10" id="exampleFormControlSelect1">
                    <?php foreach($tahun as $tahunaja):?>
                    <option value="<?= $tahunaja?>" <?php if($ft == $tahunaja){echo "selected";}?>><?= $tahunaja?>
                    </option>
                    <?php endforeach?>
                </select>
            </div>
        </div>
        <div class="col-4">
            <div class="form-group row">
                <label for="bahan" class="col-sm-2 col-form-label">Bahan</label>
                <select name="bahan" class="form-control col-sm-10" id="exampleFormControlSelect1">
                    <?php foreach($bahan as $b):?>
                        <option value="<?= $b['id_bahan']?>" <?php if($bh == $b['id_bahan']){echo "selected";}?>><?= $b['nama_bahan']?></option>
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

<div class="card">
    <div class="card-body">
        <table class="table table-striped forecast" id="forecast">
            <thead>
                <tr>
                    <th scope="col" style="display:none">#</th>
                    <th scope="col">Periode</th>
                    <th scope="col">Jumlah Bahan</th>
                    <th scope="col">X</th>
                    <th scope="col">XY</th>
                    <th scope="col">XX</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $ib = $bh;
                    $bt = $ft;
                    $keys = array_keys($tbb[$ib][$bt]);
                    $ck = count($keys);
                    $med = ($ck + 1) / 2;
                    $nilwal = (0 - $med) - 2.5 - 2;
                    $sigmaY = $sigmaX = $sigmaXY = $sigmaXX = 0;
                    $no = 1; 
                    foreach($periode as $p):
                ?>
                <tr>
                    <td style="display:none"><?= $no; ?></td>
                    <td><?= $p; ?></td>
                    <td><?= $y = $tbb[$ib][$bt][$no]; ?></td>
                    <td><?= $nilwal; ?></td>
                    <td><?= $xy = $tbb[$ib][$bt][$no] * $nilwal; ?></td>
                    <td><?= $xx = $nilwal * $nilwal; ?></td>
                </tr>
                <?php 
                    $nilwal+=2;
                    $no++;
                    $sigmaY += $y;
                    $sigmaX += $nilwal;
                    $sigmaXY += $xy;
                    $sigmaXX += $xx;
                    endforeach;
                ?>
                <tr>
                    <td style="display:none"><?=$no+=1?></td>
                    <td>Jumlah</td>
                    <td><?= intval($sigmaY)?></td>
                    <td><?= intval($sigmaX)?></td>
                    <td><?= intval  ($sigmaXY)?></td>
                    <td><?= intval($sigmaXX)?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php
    $x = $nilwal;
    $n =  count($periode);
    $fp = $n + 1;
    $fsy = $sigmaY;
    $fsxy = $sigmaXY;
    $fsxx = $sigmaXX;
foreach ($periode as $p ) {
    
    $a = $fsy/$n;
    $b = $fsxy/$fsxx;
    $fy = $a+$b*$x;
    echo 'Periode '.$fp.'<br>';
    echo 'a = '.$fsy.'/'.$n.'<br>';
    echo 'a = '.$a.'<br>';
    echo 'b = '.$fsxy.'/'.$fsxx.'<br>';
    echo 'b = '.$b.'<br>';
    echo 'Y = '.$a.' + '.$b.' x '.$x.'<br>';
    echo 'Y = '.$fy.'<br>';
    $fxy = $fy*$x;
    $fxx = $x*$x;
    $tfsy= $fsy;
    echo '--------------------<br>';
    $x+= 2;
    $n++;
    $fp++;
    $fsy += $fy;
    $fsxy += $fxy;
    $fsxx += $fxx;
}
?>