<?php
$minDateQuery = $this->db->query("SELECT MIN(date_created) as date_created FROM tb_transaksi")->row_array();
$maxDateQuery = $this->db->query("SELECT MAX(date_created) as date_created FROM tb_transaksi")->row_array();
$dateFirst = date("Y-m-d", strtotime($minDateQuery['date_created']));
$dateLast = date("Y-m-d", strtotime("+10 Weeks", strtotime($maxDateQuery['date_created'])));
$typeRumahQuery = $this->db->get('tb_rumah')->result_array();
$strDateMin = new DateTime($dateFirst);
$strDateMax = new DateTime($dateLast);
$selsihTanggal = $strDateMax->diff($strDateMin)->days;
$queryTransaksi = $this->db->get('tb_transaksi')->result_array();
for ($d=0; $d <= $selsihTanggal; $d++) { 
    // echo $d.'<br>';
    $days = strtotime('+ '.$d.'Days',strtotime($dateFirst));
    $date = date("Y-m-d",$days);
    foreach ($queryTransaksi as $qt ) {
        $idRumah = $qt['id_rumah'];
        $idTransaksi = $qt['id'];
        $anggaranQuery = $this->db->query("SELECT * FROM tb_anggaran INNER JOIN tb_bahan ON tb_anggaran.id_bahan = tb_bahan.id_bahan WHERE id_rumah = $idRumah")->result_array();
        foreach ($anggaranQuery as $aq ) {
            $idBahan = $aq['id_bahan'];
            $tra[$date][$idTransaksi][$idBahan] = 0;
            $arrBahan[$date][$idBahan] = 0;
        }
    }   
}
$now = date("Y-m-d",time());
foreach ($transaksi as $tq ) {
    $dateCreatedTransaksi = strtotime($tq['date_created']);
    $idtq = $tq['id'];
    $idBahanTransaksi = $tq['id_bahan'];
    for ($i=0; $i <= 70; $i++) { 
        $daysTransaksi = strtotime('+'.$i.' Days',$dateCreatedTransaksi);
        // $mm = intval(date('m',$dateTransaksi));
        // $yy = intval(date('Y',$dateTransaksi));
        $dateTransaksi = date("Y-m-d",$daysTransaksi);
        $jumlahBahan =  $tq['jumlah'];
        $tra[$dateTransaksi][$idtq][$idBahanTransaksi] += $jumlahBahan;
        $arrBahan[$dateTransaksi][$idBahanTransaksi] += $jumlahBahan;
    }
    // echo $idBahanTransaksi.'|'.$bahan[$idBahanTransaksi].'<br>';
    // echo $idtq.'|'.$tra[$now][$idtq][$idBahanTransaksi].'<br>';
}
foreach ($queryTransaksi as $qt ) {

    foreach ($bahan as $b ) {
        if ($tra[$now][$qt['id']][$b['id_bahan']] != 0) {
            echo $qt['nama_pembeli'].'|'.$tra[$now][$qt['id']][$b['id_bahan']].'<br>';
        }
    }
}
// echo $arrBahan[$now][1];
// foreach ($typeRumahQuery as $trq ) {
//     // echo $trq['id_rumah'];
//     foreach ($bahan as $b) {
//         $tras = $tra[$now][$trq['id_rumah']][$b['id_bahan']];
//         if ($tras != 0) {
//             echo $trq['type_rumah'].'|'.$tras.'<br>';
//         }
//     }
// }