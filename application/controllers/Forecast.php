<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Forecast extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_user');
        $this->load->model('model_forecast');
        $this->load->model('model_bahan');
        
    }
    
    public function forecast()
    {
        $tahun = $this->input->post('tahun');
        $data['ft'] = $tahun;
        $data['title'] = 'Forecast';
        $data['user'] = $this->model_user->getUser();
        $data['transaksi'] = $this->model_forecast->getAllByTotal();
        $this->t->load('admin/template','forecast/hasil',$data);
    }

    public function index()
    {
        $tahun = $this->input->post('tahun');
        $bahan = $this->input->post('bahan');
        $data['ft'] = $tahun;
        $data['bh'] = $bahan;
        $data['title'] = 'Forecast';
        $data['user'] = $this->model_user->getUser();
        $data['transaksi'] = $this->model_forecast->getAll();
        $data['bahan'] = $this->model_bahan->getBahan();
        $this->t->load('admin/template','forecast/forecast_bahan',$data);
    }

}

/* End of file Forecast.php */
