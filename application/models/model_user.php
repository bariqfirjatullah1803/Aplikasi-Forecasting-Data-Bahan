
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_user extends CI_Model {

    public function getUser()
    {
        return $this->db->get_where('tb_user',['username' => $this->session->userdata('username')])->row_array();
    }

}

/* End of file model_user.php */
