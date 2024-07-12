<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model('Dashboard_model','dashboard');		
	}
	
	public function index()
    {
        if($this->session->status == "logged"){
           $this->dashboard();
		}
		else
		{
			redirect(base_url('auth'));
		}       
    }

	public function dashboard()
	{
		$this->template->loadTemplate('dashboard/v_dashboard');
	}
	
}