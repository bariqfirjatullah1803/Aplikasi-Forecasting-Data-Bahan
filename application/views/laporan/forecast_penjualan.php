<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Laporan Data Forecast Penjualan Per Tahun</title>
</head>

<body>
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
    <div class="card">
        <div class="card-header">
            Data Penjualan Rumah Per Tahun
        </div>
        <div class="card-body">
            <table class="table table-striped forecast text-center">
                <thead>
                    <tr>
                        <th class="d-none">#</th>
                        <th>Tahun</th>
                        <th>Total Penjualan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $arrtahun = ''; $arrY = ''; $no = 1; foreach($tahun as $thn):?>
                    <tr>
                        <td class="d-none"><?= $no ?></td>
                        <td><?= $thn ?></td>
                        <?php $arrtahun .= "$thn". ", ";?>
                        <td><?= $y=$total_penjualan[$thn]?></td>
                        <?php $arrY .= "$y".", ";?>
                        <?php 
                        $x=$na; 
                         $xy=$x*$y; 
                         $xx=$x*$x ;
                         ?>
                    </tr>
                    <?php 
                    $na+=$plus; 
                    $no++;
                    $sigmaX += $x;
                    $sigmaY += $y;
                    $sigmaXY += $xy;
                    $sigmaXX += $xx; 
                endforeach;
                ?>
                    <tr>
                        <td class="d-none"><?= $no ?></td>
                        <td>Jumlah</td>
                        <td><?= $sigmaY ?></td>
                        <?php $sigmaX ?>
                        <?php $sigmaXY ?>
                        <?php $sigmaXX ?>
                    </tr>
                </tbody>
            </table>
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
    <div class="card mt-3">
        <div class="card-header">
            Forecast
        </div>
        <div class="card-body">
            <div class="card-text">Hasil penjualan pada tahun <?=$thn?> = <?= $fy?> unit rumah</div>
        </div>
    </div>
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