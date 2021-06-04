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
        $data['user'] = $this->model_user->getUser();
        $data['title'] = 'Dashboard';
        $data['count_bahan'] = $this->model_admin->count('id_bahan','tb_bahan');
        $data['count_rumah'] = $this->model_admin->count('id_rumah','tb_rumah');
        $this->t->load('admin/template','admin/dashboard',$data);
    }
    public function proyek()
    {
        $data['title'] = 'Forecast';
        $data['user'] = $this->model_user->getUser();
        $data['transaksi'] = $this->db->query("SELECT * FROM tb_transaksi WHERE id = 11")->result_array();
        $data['bahan'] = $this->model_bahan->getBahan();
        $this->t->load('admin/template','proyek/proses-proyek',$data);
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