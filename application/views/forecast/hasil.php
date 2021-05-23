<?php
   
    $qtahunawal = $this->db->query("SELECT YEAR(MIN(date_created)) AS tahunawal FROM tb_transaksi")->row_array();
    $qtahunakhir = $this->db->query("SELECT MAX(date_created) AS tahunakhir FROM tb_transaksi")->row_array();
    $tahunawal = date("Y",strtotime($qtahunawal['tahunawal']));
    $tahunakhir = date("Y",strtotime("+10 Weeks",strtotime($qtahunakhir['tahunakhir'])));
    // echo $tahunakhir.'-'.$tahunawal;
    for ($t=$tahunawal; $t <= $tahunakhir; $t++) { 
        $tahun[$t]=$t;
        for ($i=1; $i <= 12; $i++) { 
            $month[$i] = 0;
            $namabulan[$i] = "Periode ".$i;
            $th[$t][$i] = 0;
        }
    }
    // $data3=array_combine($month,$year);
    print_r($th);
?>

<?php 
$tj=0; $no=1; foreach($transaksi as $t){

    $adate = strtotime($t['date_created']);  
    for ($i=0; $i < 70; $i++) { 
        $weeks = strtotime('+'.$i.' Days',$adate);
        $mm = intval(date('m',$weeks));
        $yy = intval(date('Y',$weeks));
        $totalbulanan =  intval($t['total']);
        $month[$mm] += $totalbulanan;
        $th[$yy][$mm] += $totalbulanan;
        $no++; 
    }  
}
?>
<div class="form-group">
    <label for="exampleFormControlSelect1">Example select</label>
    <select class="form-control" id="exampleFormControlSelect1">
        <?php foreach($tahun as $tahunaja):?>
            <option><?= $tahunaja?></option>
        <?php endforeach?>
    </select>
</div>
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
                $ftahun = 2021;
                $keys =  array_keys($th[$ftahun]);
                $ck = count($keys);
                $med = ($ck + 1) / 2;
                $nilwal = (0 - $med) - 2.5 - 2;
                $sigmaY = $sigmaX = $sigmaXY = $sigmaXX = 0;
                ?>
                <?php $no = 1; foreach($namabulan AS $nb):?>
                <tr>
                    <td style="display:none"><?= $no ?></td>
                    <td><?= $nb ?></td>
                    <td><?= $y = $th[$ftahun][$no]?></td>
                    <td><?= $nilwal;?></td>
                    <td><?= $xy = $th[$ftahun][$no] * $nilwal?></td>
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
<?= implode('**',$th[2021])."<br><br>"?>
<?= print_r($th)?>
<?= intval($tj)?>