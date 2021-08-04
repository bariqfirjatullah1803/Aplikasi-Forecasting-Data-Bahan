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
        $this->proyek();
    }
    public function proyek()
    {
        $date = date("Y-m-d",time());
        $data['title'] = 'Pembangunan hari ini tanggal : '.$date;
        $data['user'] = $this->model_user->getUser();
        $data['transaksi'] = $this->model_forecast->getAll();
        $data['bahan'] = $this->model_bahan->getBahan();
        $this->t->load('admin/template','proyek/proses-proyek',$data);
    }
    public function pengerjaan()
    {
        $data = [
            'id_transaksi' => $this->input->post('id'),
            'date_now' => $this->input->post('date'),
            'status' => $this->input->post('status')
        ];
        $this->db->insert('tb_pengerjaan', $data);
        $spk = [
			'nama_pemilik' => $this->input->post('pemilik'),
			'jabatan_pemilik' => $this->input->post('jabatanpemilik'),
			'nama_pekerja' => $this->input->post('pelaksana'),
			'jabatan_pekerja' => $this->input->post('jabatanpelaksana'),
			'alamat_pekerja' => $this->input->post('alamatpelaksana'),
			'id_transaksi' => $this->input->post('id'), 
			'date_created' => $this->input->post('date'),
		];
		$this->db->insert('tb_spk', $spk);
		
		$id_rumah = $this->input->post('rumah');
        $queryAnggaran = $this->db->query("SELECT * FROM tb_anggaran WHERE id_rumah = $id_rumah")->result_array();
        $queryBahan = $this->db->query("SELECT * FROM tb_bahan")->result_array();
        $bahan = array();
        for ($i=0; $i < count($queryAnggaran); $i++) { 
            $bahan[] = array(
                'id_bahan' => $queryBahan[$i]['id_bahan'],
                'stok' => $queryBahan[$i]['stok'] - $queryAnggaran[$i]['jumlah'],

            );
        }
        $this->db->update_batch('tb_bahan',$bahan,'id_bahan');
        $this->session->set_flashdata('message', '<div role="alert" class="alert alert-success">Pembangunan teproses !</div>');
        
        redirect('admin/proyek');
        
        
    }
    public function pembatalan()
    {
        
        $id_pengerjaan = $this->input->post('id_pengerjaan');
        $this->db->where('id_pengerjaan',$id_pengerjaan);
        $this->db->delete('tb_pengerjaan');
        $id_spk = $this->input->post('id_spk');
        $this->db->where('id_spk',$id_spk);
        $this->db->delete('tb_spk');

        $id_rumah = $this->input->post('rumah');
        $queryAnggaran = $this->db->query("SELECT * FROM tb_anggaran WHERE id_rumah = $id_rumah")->result_array();
        $queryBahan = $this->db->query("SELECT * FROM tb_bahan")->result_array();
        $bahan = array();
        for ($i=0; $i < count($queryAnggaran); $i++) { 
            $bahan[] = array(
                'id_bahan' => $queryBahan[$i]['id_bahan'],
                'stok' => $queryBahan[$i]['stok'] + $queryAnggaran[$i]['jumlah'],

            );
        }
        $this->db->update_batch('tb_bahan',$bahan,'id_bahan');
        
        $this->session->set_flashdata('message', '<div role="alert" class="alert alert-success">Pembangunan di batalkan !</div>');
        
        redirect('admin/proyek');
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
	public function cetakspk($id_spk)
	{
		
		$data['querySpk']=$this->db->query("SELECT * FROM tb_spk WHERE id_spk = $id_spk")->row_array();
		$id_transaksi =  $data['querySpk']['id_transaksi'];
		$data['queryTransaksi'] = $this->db->query("SELECT * FROM tb_transaksi INNER JOIN tb_plan ON tb_transaksi.id_plan = tb_plan.id_plan INNER JOIN tb_rumah ON tb_transaksi.id_rumah = tb_rumah.id_rumah WHERE tb_transaksi.id = $id_transaksi")->row_array();
		$this->load->view('admin/spk',$data);
	}

}

/* End of file Admin.php */
