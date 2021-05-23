<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function index()
    {
        $data['title'] = 'Index';
        $this->t->load('user/template','user/index',$data);
    }
    public function about()
    {
        $data['title'] = 'About';
        $this->t->load('user/template','user/about',$data);
    }
    public function property_grid()
    {
        $data['title'] = 'Property Grid';
        $this->t->load('user/template','user/property-grid',$data);
    }
    public function blog_grid()
    {
        $data['title'] = 'Blog Grid';
        $this->t->load('user/template','user/blog-grid',$data);
    }

    public function agents_grid()
    {
        $data['title'] = 'Agents Grid';
        $this->t->load('user/template','user/agents-grid',$data);
    }

    public function agent_single()
    {
        $data['title'] = 'Agents Single';
        $this->t->load('user/template','user/agents-single',$data);
    }

    public function blog_single()
    {
        $data['title'] = 'Blog Single';
        $this->t->load('user/template','user/blog-single',$data);
    }

    public function property_single()
    {
        $data['title'] = 'Property Single';
        $this->t->load('user/template','user/property-single',$data);
    }

    public function contact()
    {
        $data['title'] = 'Contact';
        $this->t->load('user/template','user/contact',$data);
    }
}

/* End of file User.php */