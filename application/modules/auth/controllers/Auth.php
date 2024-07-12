<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model','authmodel');		
	}

	public function index()
	{
		if($this->session->status == "logged"){
			switch($this->session->role)
			{
				case '1':
					redirect(base_url('cso'));
				break;
				case '2':
					redirect(base_url('cc'));
				break;
				case '3':
					redirect(base_url('tic'));
				break;
				case '4':
					redirect(base_url('management'));
				break;

			}
		}
		else
		{
			$this->load->view('loginv2');
		}
		
    }
	
    public function cekLogin()
	{
		$data['shift']		= $this->input->post('shift');
		$data['username']	= $this->input->post('username');
		$data['password'] 	= $this->input->post('password');
			
		$rs = $this->authmodel->login($data);

		if(!empty($rs)){

			$data_session = array(
					'user_id'=>$rs->user_id,
					'username' => $rs->username,
					'npp' => $rs->npp,
					'role' => $rs->role,
					'jabatan' => $rs->jabatan,
					'ruas' => $rs->ruas,
					'ruas_group' => $rs->ruas_group,
					'group_name' => $rs->ruas_group>0 ? $rs->group_name : $rs->ruas_name ,
					'status' => 'logged',						
					'time'=> date('d-m-Y H:i:s')
				);
			
			$this->session->set_userdata($data_session);

			switch($rs->role)
			{
				case '1':
					redirect(base_url('cso'));
				break;
				case '2':
					redirect(base_url('cc'));
				break;
				case '3':
					redirect(base_url('tic'));
				break;
				case '4':
					redirect(base_url('management'));
				break;

			}


			}else{

			$this->session->set_flashdata('status', 'error');
			redirect(base_url('auth'));
	
		}


	}
    
    function logout(){
		$this->session->sess_destroy();
		redirect(base_url('auth'));
	}

}