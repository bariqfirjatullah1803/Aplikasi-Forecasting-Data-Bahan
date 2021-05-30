<?php
$qtahunawal = $this->db->query("SELECT MIN(date_created) AS tahunawal FROM tb_transaksi")->row_array();
$qtahunakhir = $this->db->query("SELECT MAX(date_created) AS tahunakhir FROM tb_transaksi")->row_array();
$tahunawal = date("Y", strtotime($qtahunawal['tahunawal']));
$tahunakhir = date("Y", strtotime("+10 Weeks", strtotime($qtahunakhir['tahunakhir'])));
for ($t = $tahunawal; $t <= $tahunakhir; $t++) {
    $tahun[$t] = $t;
    for ($b = 1; $b <= 12; $b++) {
        for ($j = 1; $j <= count($bahan); $j++) {
            $month[$b] = 0;
            $periode[$b] = "Periode " . $b;
            // echo $t . ' ' . $b . ' ' . $bahan[$j]['nama_bahan'] . '<br>';
            $tbb[$t][$b][$j] = 0;
        }
    }
}

foreach ($transaksi as $trns) {
    $adate = strtotime($trns['date_created']);
    for ($i = 0; $i <= 70; $i++) {
        $weeks = strtotime('+' . $i . ' Days', $adate);
        $mm = intval(date('m', $weeks));
        $tt = intval(date('Y', $weeks));
        $bb = $trns['id_bahan'];
        $total = $trns['harga'] * $trns['jumlah'];
        $tbb[$tt][$mm][$bb] += $total;

    }
}
// print_r($tbb[2018]);
$i = 1;
$cp = count($periode);
$med = ($cp + 1)/2;
$x = (0 - $med) - 2.5 - 2;
$sigmaY = $sigmaX = $sigmaXY = $sigmaXX = 0;

foreach ($periode as $p ) {
    

    echo $p;

    echo '<br>';
    foreach ($bahan as $bhn) {
        $j = $bhn['id_bahan'];
        $y[$j][$i] = $tbb[2019][$i][$j];
        $xy = $y[$j][$i] * $x;
        $xx = $x * $x;
        $ax[$i] = $x;
        $axy[$j][$i] = $xy;
        $axx[$j][$i] = $xx;
        echo 'Bahan : ' . $bhn['nama_bahan'] . '<br>';
        echo 'Y : '.$y[$j][$i]. '<br>';
        echo 'X : '.$x.'<br>';
        echo 'XY : '.$xy.'<br>';
        echo 'XX : '.$xx.'<br>';
    }
    $i++;
    $x+=2;
    echo '<br>';
}
