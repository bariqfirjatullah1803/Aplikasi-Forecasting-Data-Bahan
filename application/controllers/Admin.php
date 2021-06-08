<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
           
            redirect('auth');
         }
        $this->load->model('model_user');
        $this->load->model('model_admin');
        $this->load->model('model_forecast');
        $this->load->model('model_bahan');
    } 
    

    public function index()
    {
        $this->proyek();
    }
    public function proyek()
    {
        $date = date("Y-m-d",time());
        $data['title'] = 'Pembangunan hari ini tanggal : '.$date;
        $data['user'] = $this->model_user->getUser();
        $data['transaksi'] = $this->model_forecast->getAll();
        $data['bahan'] = $this->model_bahan->getBahan();
        $this->t->load('admin/template','proyek/proses-proyek',$data);
    }
    public function pengerjaan()
    {
        $data = [
            'id_transaksi' => $this->input->post('id'),
            'date_now' => $this->input->post('date'),
            'status' => $this->input->post('status')
        ];
        $this->db->insert('tb_pengerjaan', $data);
        $id_rumah = $this->input->post('rumah');
        $queryAnggaran = $this->db->query("SELECT * FROM tb_anggaran WHERE id_rumah = $id_rumah")->result_array();
        $queryBahan = $this->db->query("SELECT * FROM tb_bahan")->result_array();
        $bahan = array();
        for ($i=0; $i < count($queryAnggaran); $i++) { 
            $bahan[] = array(
                'id_bahan' => $queryBahan[$i]['id_bahan'],
                'stok' => $queryBahan[$i]['stok'] - $queryAnggaran[$i]['jumlah'],

            );
        }
        $this->db->update_batch('tb_bahan',$bahan,'id_bahan');
        $this->session->set_flashdata('message', '<div role="alert" class="alert alert-success">Pembangunan teproses !</div>');
        
        redirect('admin/proyek');
        
        
    }
    public function password()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->model_user->getUser();
        $this->t->load('admin/template','admin/change-password',$data);
    }
    public function change($id)
    {
        $data = [
            'password' => password_hash($this->input->post('password'),PASSWORD_DEFAULT)
        ];
        $this->db->where('id_user', $id);
        
        $this->db->update('tb_user', $data);
        $this->session->set_flashdata('message', '<div role="alert" class="alert alert-success">Password berhasil di ganti harap login kembali !</div>');
        $this->session->unset_userdata('username');
        
        redirect('auth');
        
    }

}

/* End of file Admin.php */