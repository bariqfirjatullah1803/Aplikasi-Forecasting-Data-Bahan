<?php 
$queryTahun = $this->db->query("SELECT YEAR(MIN(date_created)) as minTahun FROM tb_transaksi")->row_array();
$minTahun = $queryTahun['minTahun'];
$tahunMape = $minTahun+1;
$queryPenjualan = $this->db->query("SELECT * FROM tb_transaksi WHERE YEAR(date_created) = $minTahun")->result_array();
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
foreach($arrayBulan as $ab) {
	$ab;
	$arrayPenjualan[$i];
	$dataActual[$i] = $arrayPenjualanMape[$i];
	$x;
	$arrayPenjualan[$i]*$x;
	$x*$x;
	$sigmaY += $arrayPenjualan[$i];
	$sigmaX += $x;
	$sigmaXY += ($arrayPenjualan[$i]*$x);
	$sigmaXX += ($x*$x);
	$i++;
	$x += $xp;
}
$j = 0;
foreach ($arrayBulan as $ab ) {
	$a = $sigmaY/$n;
	$b = $sigmaXY/$sigmaXX;
	$dataForecast[$j] = $Y = $a+$b*$x;
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
    <div class="card-header">MAPE 2019</div>
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
                    <td>Absolute Error/Actual (|(at-ft/ft)|)</td>
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
					$total += abs(($at - $ft)/$ft);
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
					<td><?= $total/count($arrayBulan)*100?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
