<?php 
        
defined('BASEPATH') OR exit('No direct script access allowed');
        
class Bantuan extends CI_Controller {

public function __construct()
{
	parent::__construct();
	$this->load->model('model_user');
}

public function index()
{
	$data['user'] = $this->model_user->getUser();
   $data['title'] = "Panduan";
   $this->t->load('admin/template','bantuan/panduan',$data);

}
        
}
        
    /* End of file  Bantuan.php */
        
                            