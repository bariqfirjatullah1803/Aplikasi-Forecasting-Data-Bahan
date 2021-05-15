<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bahan extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('username')) {
           
            redirect('auth');
         }
        $this->load->model('model_bahan');
        $this->load->model('model_user');

    }
    

    public function index()
    {
        if ($this->model_bahan->validation()) {

            
            $this->model_bahan->save();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di simpan ! </div>');
            // $this->bahan();            
            redirect('bahan','refresh');
            
        }else {
            $data = [
                'user' => $this->model_user->getUser(),
                'title' => 'Data Bahan',
                'data_bahan' => $this->model_bahan->getBahan()
            ];
            $this->t->load('admin/template','bahan/data-bahan',$data);
        }

    }
    public function edit()
    {
        $id = $this->input->post('id_bahan');
        $this->model_bahan->edit($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di edit ! </div>');

        redirect('bahan','refresh');
        
    }
    public function delete($id)
    {
        $this->model_bahan->delete($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di hapus ! </div>');

        redirect('bahan','refresh');

    }
    

}

/* End of file Bahan.php */
