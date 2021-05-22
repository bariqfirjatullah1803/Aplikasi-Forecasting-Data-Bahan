<?php
    for ($i=1; $i <= 12; $i++) { 
        $month[$i] = 0;
        $namabulan[$i] = "Periode ".$i;
    }
?>
<!-- <div class="card">
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Date Created</th>
                    <th scope="col">Type Rumah</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody> -->
<?php $tj=0; $no=1; foreach($transaksi as $t):

                $adate = strtotime($t['date_created']);  
                for ($i=0; $i < 70; $i++) { 
                    $weeks = strtotime('+'.$i.' Days',$adate);
                    $mm = intval(date('m',$weeks));
                    $totalbulanan =  intval($t['total']);
                    $month[$mm] += $totalbulanan;
                  
                ?>
<!-- <tr>
                    <td><?= $no ?></td>
                    <td><?= $t['nama_pembeli'] ?></td>
                    <td><?= date('Y-m-d',$weeks) ?></td>
                    <td><?= $t['type_rumah'] ?></td>
                    <td><?= intval($t['total'])?></td>
                </tr> -->
<?php $no++; } endforeach?>
<!-- </tbody>
        </table>
    </div>
</div> -->
<div class="card">
    <div class="card-body">
        <table class="table table-striped" id="forecast">
            <thead>
                <tr>
                    <th style="display:none" scope="col">#</th>
                    <th scope="col">Periode</th>
                    <th scope="col">Anggaran Data Bahan(Y)</th>
                    <th scope="col">X</th>
                    <th scope="col">XY</th>
                    <th scope="col">X^2</th>
                </tr>
            </thead>
            <tbody>

                <?php 
                $keys =  array_keys($month);
                $ck = count($keys);
                $med = ($ck + 1) / 2;
                $nilwal = (0 - $med) - 2.5 - 2;
                $sigmaY = $sigmaX = $sigmaXY = $sigmaXX = 0;
                ?>
                <?php $no = 1; foreach($namabulan AS $nb):?>
                <tr>
                    <td style="display:none"><?= $no ?></td>
                    <td><?= $nb ?></td>
                    <td><?= $y = $month[$no]?></td>
                    <td><?= $nilwal;?></td>
                    <td><?= $xy = $month[$no] * $nilwal?></td>
                    <td><?= $xx = $nilwal * $nilwal?></td>
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
                    <td><?= $sigmaY?></td>
                    <td><?= $sigmaX?></td>
                    <td><?= $sigmaXY?></td>
                    <td><?= $sigmaXX?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php 
    

?>
<?= implode('**',$month)."<br><br>"?>
<?= intval($tj)?>