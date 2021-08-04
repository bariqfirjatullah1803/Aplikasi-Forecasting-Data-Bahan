<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Forecast extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
            
            redirect('auth');
        }
        if($this->session->userdata('role_id') != 1){
            redirect('auth');
        }
        $this->load->model('model_user');
        $this->load->model('model_forecast');
        $this->load->model('model_bahan');

    }

    public function forecast()
    {

        $tahun = $this->input->post('tahun');
        $bahan = $this->input->post('bahan');
        $data['ft'] = $tahun;
        $data['bh'] = $bahan;
        $data['title'] = 'Forecast';
        $data['user'] = $this->model_user->getUser();
        $data['transaksi'] = $this->model_forecast->getAll();
        $data['bahan'] = $this->model_bahan->getBahan();
        $this->t->load('admin/template', 'forecast/hasil', $data);
    }

    public function index()
    {
        $tahun = $this->input->post('tahun');
        $bahan = $this->input->post('bahan');
        $data['ft'] = $tahun;
        $data['bh'] = $bahan;
		// $bahan = '';
		$bahan = $this->input->post('bahan');
		if ($bahan) {
			$bahan;
		}else{
			$bahan = 1;
		}
		$data['hitung'] = $bahan - 1;
		$data['date1'] = $this->input->post('date1');
		$data['date2'] = $this->input->post('date2');
		$data['bahanById'] = $this->db->query("SELECT * FROM tb_bahan WHERE id_bahan = $bahan")->row_array();
		$data['transaksiById'] = $this->db->query("SELECT * FROM tb_transaksi INNER JOIN tb_plan ON tb_transaksi.id_plan = tb_plan.id_plan INNER JOIN tb_rumah ON tb_rumah.id_rumah = tb_transaksi.id_rumah INNER JOIN tb_anggaran ON tb_anggaran.id_rumah = tb_rumah.id_rumah INNER JOIN tb_bahan ON tb_bahan.id_bahan = tb_anggaran.id_bahan WHERE tb_bahan.id_bahan = $bahan")->result_array();
        $data['title'] = 'Forecast';
        $data['user'] = $this->model_user->getUser();
        $data['transaksi'] = $this->model_forecast->getAll();
        $data['bahan'] = $this->model_bahan->getBahan();
        $this->t->load('admin/template', 'forecast/forecast_bahan', $data);
    }

    public function test()
    {
        $tahun = $this->input->post('tahun');
        $bahan = $this->input->post('bahan');
        $data['ft'] = $tahun;
        $data['bh'] = $bahan;
        $data['title'] = 'Forecast';
        $data['user'] = $this->model_user->getUser();
        $data['transaksi'] = $this->model_forecast->getAll();
        $data['bahan'] = $this->model_bahan->getBahan();
        $this->t->load('admin/template', 'forecast/ujicoba', $data);
    }
    public function penjualan()
    {
        $data['title'] = 'Forecast Penjualan';
		$minTahun = $this->db->query("SELECT MIN(YEAR(date_created)) as tahun FROM tb_transaksi")->row_array();
		$tahun = $this->input->post('tahun');
		if ($tahun) {
			$data['tahun'] = $this->input->post('tahun');
		}else {
			$data['tahun'] = $minTahun['tahun'];
		}
		
        $data['user'] = $this->model_user->getUser();
        $data['maxTahun'] = $this->db->query("SELECT MAX(YEAR(date_created)) as tahun FROM tb_transaksi")->row_array();
        $this->t->load('admin/template','forecast/forecast_penjualan',$data);
    }

}

/* End of file Forecast.php */
