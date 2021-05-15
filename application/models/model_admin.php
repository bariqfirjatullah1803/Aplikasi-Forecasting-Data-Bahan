<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class model_admin extends CI_Model {

    public function count($id,$table)
    {
        return $this->db->query("SELECT COUNT($id) as jumlah FROM $table")->row_array();
    }

}

/* End of file model_admin.php */
