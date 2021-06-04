<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Data_user extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_user');
        
    }
    
    public function index()
    {
        $data['title'] = 'Data User';
        $data['user'] = $this->model_user->getUser();
        $data['data_user'] = $this->db->get('tb_user')->result_array();
        $this->t->load('admin/template','data-user/index',$data);
    }
    public function add()
    {
        $data = [
            'nama_user' => $this->input->post('nama'),
            'username' => $this->input->post('username'),
            'password' => password_hash($this->input->post('password'),PASSWORD_DEFAULT),
            'role_id' => 2
        ];
        $this->db->insert('tb_user', $data);
        $this->session->set_flashdata('message', '<div role="alert" class="alert alert-success">Data berhasil di tambahkan !</div>');
        
        redirect('data_user');
        
    }
    public function edit($id)
    {
        $data = [
            'nama_user' => $this->input->post('nama'),
            'username' => $this->input->post('username'),
            // 'password' => password_hash($this->input->post('password'),PASSWORD_DEFAULT)
        ];
        $this->db->where('id_user', $id);
        
        $this->db->update('tb_user', $data);
        $this->session->set_flashdata('message', '<div role="alert" class="alert alert-success">Data berhasil di edit !</div>');
        
        redirect('data_user');

        
    }
    public function edit_password($id)
    {
        $data = [
            'password' => password_hash($this->input->post('password'),PASSWORD_DEFAULT)
        ];
        $this->db->where('id_user', $id);
        
        $this->db->update('tb_user', $data);
        $this->session->set_flashdata('message', '<div role="alert" class="alert alert-success">Data berhasil di edit !</div>');
        
        redirect('data_user');
    }
    public function delete($id)
    {
        $this->db->where('id_user', $id);
        
        $this->db->delete('tb_user');
        $this->session->set_flashdata('message', '<div role="alert" class="alert alert-success">Data berhasil di delete !</div>');
        
        redirect('data_user');

        
    }

}

/* End of file Data_user.php */
