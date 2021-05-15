<table border="1">
    <thead>
        <tr>
            <th>Array</th>
            <th>Tahun</th>
            <th>Y</th>
            <th>X</th>
            <th>X^</th>
            <th>XY</th>
        </tr>
    </thead>
    <tbody>
<?php $array=0; foreach ($tahun as $t ) {
    $year = $t['tahun'];
    $count = $this->db->query("SELECT COUNT(date_created) as jumlah FROM tb_transaksi WHERE type_rumah = 45 AND YEAR(date_created) = '$year'")->row_array();
    // var_dump($year);
    // die;
    $an[$array] = $array; 
    echo '<tr>';
    echo '<td>'.$array.'</td>';
    echo '<td>'.$ay[$array]=$year.'</td>';
    echo '<td>'.$count['jumlah'].'</td>';
    echo '<td>'.count($ay).'</td>';
    echo '</tr>';
    $array++;

}?>
</tbody>
</table>
<?php 
$median = (count($ay)-1)/2;
$nilwal = ($an[0] - $median)-0.5;
echo $nilwal;


?>
