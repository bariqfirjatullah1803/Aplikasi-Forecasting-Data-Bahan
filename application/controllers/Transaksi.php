<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_user');
        
    }
    
    public function index()
    {
        $data = [
            'title' => 'Pembayaran',
            'user' => $this->model_user->getUser()
        ];
        $this->t->load('admin/template','transaksi/pembayaran',$data);
    }

}

/* End of file Transaksi.php */
