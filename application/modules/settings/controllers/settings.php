<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_Controller {

    public function __construct()
	{
		parent::__construct();
		//$this->load->model('Dashboard_model','dashboard');		
	}
	
	public function index()
    {
        if($this->session->status == "logged"){
           $this->setting_page();
		}
		else
		{
			redirect(base_url('auth'));
		}       
    }

	public function setting_page()
	{
		$this->load->view('settings/v_settings');
	}
	
}