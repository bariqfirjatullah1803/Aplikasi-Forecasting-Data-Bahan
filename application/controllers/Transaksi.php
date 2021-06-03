<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
           
            redirect('auth');
         }
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
        $this->t->load('admin/template', 'transaksi/pembayaran', $data);
    }
    public function save()
    {
        $nama_pembeli = $this->input->post('nama_pembeli');
        $unit = $this->input->post('unit');
        $plan = $this->input->post('plan');
        $rumah = $this->input->post('rumah');
        $harga = $this->input->post('harga');
        $data = array();
        $query_anggaran = $this->db->query("SELECT * FROM tb_anggaran INNER JOIN tb_bahan ON tb_anggaran.id_bahan = tb_bahan.id_bahan WHERE id_rumah = $rumah")->result_array();
        foreach ($query_anggaran as $qa) {
            $id_bahan = $qa['id_bahan'];
            $qb = $this->db->query("SELECT * FROM tb_bahan WHERE id_bahan = $id_bahan")->row_array();
            $stok[$id_bahan] = $qb['stok'] - round($qa['jumlah'] * 70);

        }
        $na = 1;
        foreach ($stok as $s) {
            if ($stok[$na] < 0) {
                $nama_bahan[] = $this->db->query("SELECT nama_bahan FROM tb_bahan WHERE id_bahan = $na")->row_array();
            }
            $na++;
        }
        if (empty($nama_bahan)) {
            // var_dump(count($stok));
            // die;
            for ($n=1; $n <= count($stok); $n++) { 
                $stok_bahan = [
                    'stok' => $stok[$n]
                ];
                $this->db->where('id_bahan', $n);
                $this->db->update('tb_bahan', $stok_bahan);
            }
            $index = 0;
            foreach ($unit as $u) {
                array_push($data, array(
                    'id_transaksi' => time(),
                    'nama_pembeli' => $nama_pembeli,
                    'unit' => $u,
                    'id_plan' => $plan,
                    'biaya' => $harga,
                    'id_rumah' => $rumah,
                    'date_created' => date("Y-m-d", time()),

                ));
                $index++;
            }
            $this->db->insert_batch('tb_transaksi',$data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan !</div>');
            redirect('transaksi');

        } else {
            $no = 0;
            $msg = '';
            foreach ($nama_bahan as $nb) {
                $msg .= $nama_bahan[$no]['nama_bahan'] . ' , ';
                $no++;
            }
            $this->session->set_flashdata('message', '<div class="alert alert-danger" style="text-transform:lowercase" role="alert"><span style="text-transform:capitalize">Bahan : </span> ' . substr($msg, 0, -1) . ' Kurang !</div>');

            redirect('bahan/stok');

        }

        // redirect('transaksi','refresh');

    }

}

/* End of file Transaksi.php */
