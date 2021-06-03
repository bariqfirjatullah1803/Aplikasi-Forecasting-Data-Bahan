<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rumah extends CI_Controller {

    
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
        $this->load->model('model_rumah');
    }
    
    public function index()
    {
        $data = [
            'title' => 'Data Rumah',
            'user' => $this->model_user->getUser(),
            'data_rumah' => $this->model_rumah->getAll()
        ];
        $this->t->load('admin/template','rumah/data-rumah',$data);
    }
    public function save()
    {
        $this->model_rumah->save();
        
        redirect('rumah','refresh');
        
    }
    public function edit()
    {
        $id = $this->input->post('id_rumah');
        $this->model_rumah->edit($id);
        
        redirect('rumah','refresh');
        
    }
    public function delete($id)
    {
        $this->model_rumah->delete($id);
        
        redirect('rumah','refresh');
        
    }

}

/* End of file Rumah.php */
