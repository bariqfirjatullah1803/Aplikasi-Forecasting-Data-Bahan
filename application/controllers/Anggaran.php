<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Anggaran extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
           
            redirect('auth');
         }
        $this->load->model('model_user');
        $this->load->model('model_anggaran');
        $this->load->model('model_rumah');
        $this->load->model('model_bahan');
        
        
    }
    public function index()
    {
        $data = [
            'title' => 'Data Anggaran',
            'user' => $this->model_user->getUser(),
            'count_36' => $this->model_anggaran->count(1),
            'count_40' => $this->model_anggaran->count(2),
            'count_45' => $this->model_anggaran->count(3),
            'count_60' => $this->model_anggaran->count(4),
        ];
        $this->t->load('admin/template','anggaran/data-anggaran',$data);

    }
    public function type($type)
    {
        $this->form_validation->set_rules('filter', 'Filter', 'trim|required|');
        
        if ($this->form_validation->run() == FALSE) {
            $data = [
                'title' => 'Data Anggaran',
                'user' => $this->model_user->getUser(),
                'data_anggaran' => $this->model_anggaran->getAll($type),
                'type' => $this->model_anggaran->type($type),
                'data_rumah' => $this->model_rumah->getAll(),
            ];
            $this->t->load('admin/template','anggaran/data-anggaran-type',$data);
        } else {
            
        }
        
        
    }
    public function save()
    {
        
        $this->model_anggaran->save();
        $type = $this->input->post('type_rumah');
        redirect('anggaran/type/'.$type,'refresh');
        
    }
    public function edit()
    {
        $id = $this->input->post('id_anggaran');
        $this->model_anggaran->edit($id);
        
        redirect('anggaran','refresh');
    }
    public function delete($id)
    {
        $this->model_anggaran->delete();
        
        redirect('anggaran','refresh');
        
    }

}

/* End of file Anggaran.php */