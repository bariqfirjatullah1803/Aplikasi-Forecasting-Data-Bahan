<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class model_bahan extends CI_Model {

    public function getBahan()
    {
        return $this->db->get('tb_bahan')->result_array();
    }
    public function validation()
    {
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('nama', 'Nama Bahan', 'trim|required');
        $this->form_validation->set_rules('satuan', 'Satuan Bahan', 'trim|required');
        $this->form_validation->set_rules('harga', 'Harga Bahan', 'trim|required');
        
        
        if ($this->form_validation->run()) {
            return true;
        } else {
            return false;
        }
    }
    public function save()
    {
        $data = [
            'nama_bahan' => $this->input->post('nama'),
            'satuan' => $this->input->post('satuan'),
            'harga' => $this->input->post('harga'),
        ];
        $this->db->insert('tb_bahan', $data);
    }

    public function edit($id)
    {
        $data = [
            'nama_bahan' => $this->input->post('nama'),
            'satuan' => $this->input->post('satuan'),
            'harga' => $this->input->post('harga'),
        ];
        $this->db->where('id_bahan', $id);
        $this->db->update('tb_bahan',$data);
    }
    public function delete($id)
    {
        $this->db->where('id_bahan', $id);
        $this->db->delete('tb_bahan');
    }
}

/* End of file model_bahan.php */
