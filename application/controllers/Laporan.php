<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

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
        $this->load->view('laporan/forecast_bahan', $data);
    }

    public function penjualan()
    {
        $data['title'] = 'Forecast Penjualan';
        $data['user'] = $this->model_user->getUser();
        $data['penjualan'] = $this->db->query("SELECT YEAR(date_created) as tahun,COUNT(YEAR(date_created)) as terjual FROM tb_transaksi GROUP BY YEAR(date_created)")->result_array();
        $data['minTahun'] = $this->db->query("SELECT MIN(YEAR(date_created)) as tahun FROM tb_transaksi")->row_array();
        $data['maxTahun'] = $this->db->query("SELECT MAX(YEAR(date_created)) as tahun FROM tb_transaksi")->row_array();
        $this->load->view('laporan/forecast_penjualan', $data);
        
    }
	public function bahan()
	{
		$bahan = $this->input->post('bahan');
		$data['date1'] = $this->input->post('date1');
		$data['date2'] = $this->input->post('date2');
		$data['bahan'] = $this->db->query("SELECT * FROM tb_bahan WHERE id_bahan = $bahan")->row_array();
		$data['transaksi'] = $this->db->query("SELECT * FROM tb_transaksi INNER JOIN tb_plan ON tb_transaksi.id_plan = tb_plan.id_plan INNER JOIN tb_rumah ON tb_rumah.id_rumah = tb_transaksi.id_rumah INNER JOIN tb_anggaran ON tb_anggaran.id_rumah = tb_rumah.id_rumah INNER JOIN tb_bahan ON tb_bahan.id_bahan = tb_anggaran.id_bahan WHERE tb_bahan.id_bahan = $bahan")->result_array();
		$this->load->view('laporan/bahan',$data);
	}
	public function transaksi()
	{
		$minDate = $this->input->post('tanggalAwal');
		$maxDate = $this->input->post('tanggalAkhir');
		$data = [
			'title' => 'Laporan Transaksi',
			'transaksi' => $this->db->query("SELECT * FROM tb_transaksi WHERE date_created BETWEEN '$minDate' AND '$maxDate' ORDER BY date_created ASC")->result_array(),
		];
		$this->load->view('laporan/transaksi',$data);
	}
}

/* End of file Laporan.php */
