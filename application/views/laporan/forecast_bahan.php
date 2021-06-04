<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Laporan Forecast Data Bahan Tahun <?=$ft?></title>
</head>

<body>
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
    <h2 class="text-center">Data Bahan <?= $ft?></h2>
    <table class="table table-striped forecast text-center ">
        <thead>
            <tr>
                <th scope="col" style="display:none">#</th>
                <th scope="col">Nama Bahan</th>
                <?php $arrp=''; foreach($periode as $p):?>
                <th scope="col"><?= $p?></th>
                <?php $arrp .= "'$p'". ", ";  endforeach?>
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

    <h2 class="text-center">Hasil Forecast Tahun <?= $ft + 1?></h2>
    <table class="table table-striped forecast">
        <thead>
            <tr>
                <th scope="col" style="display:none">#</th>
                <th scope="col">Nama Bahan</th>
                <?php $cp = count($periode)+1; foreach($periode as $p):?>
                <th scope="col">Periode <?= $cp?></th>
                <?php $arrp .= "'Periode $cp'". ", "; $cp++; endforeach?>
                <!-- <th scope="col">Jumlah Bahan</th> -->
            </tr>
        </thead>
        <tbody>
            <?php 
                $fnumber = 1; 
                $arbahan = '';
                
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
                    $fp = $n + 1;
                    $fsy = $sigmaY[$nbh];
                    $fsxy = $sigmaXY[$nbh];
                    $fsxx = $sigmaXX[$nbh];
                    $fn = 1;
                    $tfsy = 0;
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
                        $tfsy += $fy;
                        $x+= 2;
                        $n++;
                        $fp++;
                        $fsy += $fy;
                        $fsxy += $fxy;
                        $fsxx += $fxx;
                       
                        $fn++;
                    }
                    $sigY2 = round($tfsy);
                        $sy2 .= "$sigY2". ", ";
                    // echo $sigY2.'<br>';
                   ?>
            </tr>
            <?php $fnumber++; endforeach;?>
        </tbody>
    </table>

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