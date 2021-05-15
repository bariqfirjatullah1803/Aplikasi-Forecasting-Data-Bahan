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
        
    }
    

    public function index()
    {
        $data['user'] = $this->model_user->getUser();
        $data['title'] = 'Dashboard';
        $data['count_bahan'] = $this->model_admin->count('id_bahan','tb_bahan');
        $data['count_rumah'] = $this->model_admin->count('id_rumah','tb_rumah');
        $this->t->load('admin/template','admin/dashboard',$data);
    }
    

}

/* End of file Admin.php */