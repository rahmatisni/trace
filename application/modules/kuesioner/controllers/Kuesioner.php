<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kuesioner extends MY_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model('Kuesioner_model','kuesioner');		
	}
	
	public function index()
    {
		$token=$this->input->get('token');

		if($token=='')
		{
			$this->load->view('survey_no_access');
			
		}else
		{
			$data['profile']=$this->kuesioner->cekActiveToken($token);
			
			if(!empty($data['profile'])){
				$this->load->view('survey',$data);
			}else
			{
				$this->load->view('survey_no_access');
			}
			
		}		

    }


	public function submitFeedback()
	{
		$id 		= $this->input->post('id');
		$rating		= $this->input->post('rating');
		$feedback	= $this->input->post('feedback');
		$saran		= $this->input->post('saran');
		$keluhan	= $this->input->post('keluhan');

		$submit = $this->kuesioner->submitFeedbackModel($id,$rating,$feedback,$saran,$keluhan);

		echo json_encode($submit);

	}
	
}