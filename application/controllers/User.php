<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function index()
    {
        
    }
    public function siteplan()
    {
        $data['title'] = 'Site Plan';
        $this->t->load('user/template','user/siteplan',$data);
    }

}

/* End of file User.php */
