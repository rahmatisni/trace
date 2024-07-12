<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Template extends MY_Controller {
    public $CI = NULL;

    public function __construct()
	{
		parent::__construct();
        //$this->CI = &get_instance();
	}

	
	public function index()
	{
		$this->load->view('v_login');
    }

    public function loadTemplate($content, $data= null)
    {
        $data['include']    = $this->load->view("partial/include",$data,TRUE);
        $data['head']       = $this->load->view("partial/head",$data,TRUE);
        $data['sidebar']    = $this->load->view("partial/sidebar",$data,TRUE);
        $data['navbar']     = $this->load->view("partial/navbar",$data,TRUE);
        $data['footer']     = $this->load->view("partial/footer", $data, TRUE);
        $data['content']    = $this->load->view($content, $data, TRUE);
           
        $this->load->view('template/template', $data);

    }
	
    public function getCurrentActiveSidebar($controller1,$controller2)
    {
        $uri_0=$this->uri->segment(1);
        $uri_1=$this->uri->segment(0);
        
        if(($uri_0==$controller1 && $uri_1==''))
        {
            return 'active';
        }
        elseif (($uri_0==$controller1 && $uri_1==$controller2))
        {
            return 'active';
        }else
        {
            return '';
        }
    
    }   

    public function show_404()
    {
       
			$opsi='';
			
			switch($this->session->role)
			{
				case 1 :
					$opsi='cso';
					break;
				case 2 :
					$opsi='cc';
					break;
				case 3 :
					$opsi='tic';
					break;
				case 4 :
					$opsi='management';
					break;
			}

			$data['menu']=$opsi;
			$this->load->view('template/error-404',$data);
    }
}