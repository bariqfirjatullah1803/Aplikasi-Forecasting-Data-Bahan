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
            'user' => $this->model_user->getUser(),
            'plan' => $this->db->get('tb_plan')->result_array(),
            'type_rumah' => $this->db->get('tb_rumah')->result_array(),
            'transaksi' => $this->db->get('tb_transaksi')->result_array(),
        ];
        $this->t->load('admin/template','transaksi/pembayaran',$data);
    }
    public function save()
    {
        $nama_pembeli = $this->input->post('nama_pembeli');
        $unit = $this->input->post('unit');
        $plan = $this->input->post('plan');
        $rumah = $this->input->post('rumah');
        $harga = $this->input->post('harga');
        $data = array();

        $index = 0;
        foreach ($unit as $u ) {
            array_push($data,array(
                'id_transaksi' => time(),
                'nama_pembeli' => $nama_pembeli,
                'unit' => $u,
                'id_plan' => $plan,
                'harga' => $harga,
                'id_rumah' => $rumah,
                'date_created' => date("Y-m-d",time())

            ));
            $index++;
        }
        $this->db->insert_batch('tb_transaksi',$data);
        $this->session->set_flashdata('message', '<div ="alert alert-success" role="alert">Data berhasil ditambahkan !</div>');
        
    }

}

/* End of file Transaksi.php */
