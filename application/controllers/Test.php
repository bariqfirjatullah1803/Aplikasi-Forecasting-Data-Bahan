<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    public function index()
    {
        $a = 1424036;
        $adate = strtotime('2018-12-15');
        $weeks = strtotime('+1 Weeks',$adate);
        $year = date('Y',$adate);
        $month = date('m',$adate);
        $date = date('d',$adate);
        $enddate = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        echo date('Y-m-d',$adate);
        echo '<br>';
        // echo intval($enddate) - intval($date); 
        echo date('Y-m-d',$weeks);

    }

    public function harga()
    {
        $this->db->query("")
    }
}

/* End of file Test.php */
