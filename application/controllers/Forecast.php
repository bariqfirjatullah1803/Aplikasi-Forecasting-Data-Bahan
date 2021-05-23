<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Forecast extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_user');
        $this->load->model('model_forecast');
        
    }
    
    public function index()
    {
        $tahun = $this->input->post('tahun');
        $data['ft'] = $tahun;
        $data['title'] = 'Forecast';
        $data['user'] = $this->model_user->getUser();
        $data['transaksi'] = $this->model_forecast->getAll();
        $this->t->load('admin/template','forecast/hasil',$data);
    }

}

/* End of file Forecast.php */
