<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class model_anggaran extends CI_Model {

    public function getAll($type)
    {
        return $this->db->query("SELECT * FROM tb_anggaran INNER JOIN tb_bahan ON tb_bahan.id_bahan = tb_anggaran.id_bahan
        INNER JOIN tb_rumah ON tb_anggaran.id_rumah = tb_rumah.id_rumah WHERE type_rumah = $type")->result_array();
        
    }
    public function type($type)
    {
        return $this->db->query("SELECT * FROM tb_rumah WHERE type_rumah = $type")->row_array();
    }
    public function save()
    {
        $data = [
            'id_bahan' => $this->input->post('id_bahan'),
            'id_rumah' => $this->input->post('id_rumah'),
            'jumlah' => $this->input->post('jumlah'),
        ];
        $this->db->insert('tb_anggaran', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di simpan !</div>');
    }
    public function edit($id)
    {
        $data = [
            'id_bahan' => $this->input->post('id_bahan'),
            'id_rumah' => $this->input->post('id_rumah'),
            'jumlah' => $this->input->post('jumlah'),
        ];
        $this->db->where('id_anggaran', $id);
        $this->db->update('tb_anggaran', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di edit !</div>');
        
    }
    public function delete($id)
    {
        $this->db->where('id_anggaran', $id);
        $this->db->delete('tb_anggaran');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil di hapus !</div>');
    }
    public function count($id)
    {
        return $this->db->query("SELECT COUNT(id_anggaran) as jumlah FROM tb_anggaran WHERE id_rumah = $id")->row_array();
    }

}

/* End of file model_anggaran.php */
