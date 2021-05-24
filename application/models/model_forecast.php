<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class model_forecast extends CI_Model {

    public function getAllByTotal()
    {
        // return $this->db->query("SELECT * FROM tb_transaksi INNER JOIN tb_plan ON tb_transaksi.id_plan = tb_plan.id_plan INNER JOIN tb_rumah ON tb_rumah.id_rumah = tb_transaksi.id_rumah INNER JOIN tb_anggaran ON tb_anggaran.id_rumah = tb_rumah.id_rumah INNER JOIN tb_bahan ON tb_bahan.id_bahan = tb_anggaran.id_bahan WHERE tb_transaksi.id_transaksi = 1")->result_array();
        return $this->db->query("SELECT *,sum(tb_anggaran.jumlah*tb_bahan.harga) as total
        FROM tb_transaksi INNER JOIN tb_plan ON tb_transaksi.id_plan = tb_plan.id_plan INNER JOIN tb_rumah ON tb_rumah.id_rumah = tb_transaksi.id_rumah INNER JOIN tb_anggaran ON tb_anggaran.id_rumah = tb_rumah.id_rumah INNER JOIN tb_bahan ON tb_bahan.id_bahan = tb_anggaran.id_bahan group by tb_transaksi.id_transaksi;
        ")->result_array();
    }
    public function getAll()
    {
        return $this->db->query("SELECT * FROM tb_transaksi INNER JOIN tb_plan ON tb_transaksi.id_plan = tb_plan.id_plan INNER JOIN tb_rumah ON tb_rumah.id_rumah = tb_transaksi.id_rumah INNER JOIN tb_anggaran ON tb_anggaran.id_rumah = tb_rumah.id_rumah INNER JOIN tb_bahan ON tb_bahan.id_bahan = tb_anggaran.id_bahan")->result_array();
    }

}

/* End of file model_forecast.php */
