<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    public function index()
    {
        $a = 1424036;
        $adate = strtotime('2021-05-27');
        $year = date('Y',$adate);
        $month = date('m',$adate);
        $date = date('d',$adate);
        $enddate = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        // echo date('Y-m-d',$adate);
        // echo '<br>';
        // // echo intval($enddate) - intval($date);
        // for ($i=1; $i <= 70; $i++) { 
        //     $weeks = strtotime('+'.$i.' Days',$adate);
        //     echo date('Y-m-d',$weeks).'<br>';

        // } 
        echo date("Y-m-d",strtotime("+10 Weeks",$adate));

    }

    public function forecast()
    {
        $query = $this->db->query("SELECT * FROM tb_transaksi INNER JOIN tb_plan ON tb_transaksi.id_plan = tb_plan.id_plan INNER JOIN tb_rumah ON tb_rumah.id_rumah = tb_transaksi.id_rumah INNER JOIN tb_anggaran ON tb_anggaran.id_rumah = tb_rumah.id_rumah INNER JOIN tb_bahan ON tb_bahan.id_bahan = tb_anggaran.id_bahan")->result_array();
        echo '<table border="1">';
        foreach ($query as $q ) {
            echo '<tr>';
            echo '<td>'.$q['id_transaksi'].'<br></td>';
            echo '<td>'.$q['date_created'].'<br></td>';
            echo '<td>'.$q['nama_bahan'].'<br></td>';
            echo '<td>'.$q['jumlah'].'<br></td>';
            echo '<td>'.$q['harga'].'<br></td>';
            $total = $q['jumlah']*$q['harga'];
            echo '<td>'.$total.'<br></td>';
            echo '</tr>';
        }
        echo '</table>';
    }
    public function harga()
    {
        // $this->db->query("")
    }
}

/* End of file Test.php */
