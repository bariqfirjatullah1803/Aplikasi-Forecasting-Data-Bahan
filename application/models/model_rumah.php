<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class model_rumah extends CI_Model {

    public function getAll()
    {
        return $this->db->get('tb_rumah')->result_array();
    }
    public function save()
    {
        $data = [
            'type_rumah' => $this->input->post('type_rumah')
        ];
        $this->db->insert('tb_rumah',$data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di simpan !</div>');
        
    }
    public function edit($id)
    {
        $data = [
            'type_rumah' => $this->input->post('type_rumah')
        ];
        $this->db->where('id_rumah', $id);
        $this->db->update('tb_rumah', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di edit !</div>');
    }
    public function delete($id)
    {
        $this->db->where('id_rumah', $id);
        $this->db->delete('tb_rumah');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di hapus !</div>');        
    }

}

/* End of file model_rumah.php */
