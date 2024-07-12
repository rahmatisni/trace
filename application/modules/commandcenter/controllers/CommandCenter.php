<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Commandcenter extends MY_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model('CommandCenter_model','cc');	
		$this->load->model('LaporanCommandCenter_model','laporan');		
		if(!$this->session->npp){
			redirect(base_url('auth'));
		};
	}
	
	public function index()
    {
        $data['ruasOption']=$this->cc->getRuasOption();
		//$data['kendalaOption']=$this->cso->getKendalaOption();

		$this->template->loadTemplate('commandcenter/laporan',$data);
    }

	public function assignRuas()
	{
		$data ['id'] 			= $this->input->post('id');
		$data ['ruas'] 			= $this->input->post('ruas');	
		$data ['user_id'] 		= $this->session->npp;
		
		$insert = $this->cc->assignRuasModel($data);

		echo json_encode($insert);
	}

	public function getDetailLaporan()
	{
		$data ['waktu'] 			= $this->input->post('waktu');
		$data ['hp'] 				= $this->input->post('hp');
		$data ['nopol'] 			= $this->input->post('nopol');

		$select = $this->cso->getDetailLaporanModel($data);

		echo json_encode($select);
	}

	public function ajax_list_laporan_commandcenter_bd()
	{
		$list = $this->laporan->make_datatables(1);

		$data = array(); 
        
        foreach ($list as $item) {
			
			$waktu=explode(" ",$item->laporan_created_timestamp);
			$waktu_str=$waktu[0]."</br>".$waktu[1];
			
            $row = array();
			$row[] = $item->laporan_priority_status_id;
			$row[] = $waktu_str;
			$row[] = $item->laporan_name;
			$row[] = $item->laporan_phone_no;
			$row[] = $item->ruas_name;
			$row[] = $item->laporan_km;
			$row[] = $item->laporan_jalur;
			$row[] = $item->laporan_vehicle_category;
			$row[] = $item->laporan_plat_no;
			$row[] = $item->kendala;
			$row[] = $item->laporan_description;
			$row[] = $item->status_name;			
			$row[] = '<button id="assignButton" onClick="assignRuas('.$item->laporan_ruas_id.','.$item->laporan_id.')" class="btn btn-sm btn-primary">Forward</button>';
			$row[] = $item->normal_priority_name=='' ? '-' : ucfirst($item->normal_priority_name);
			$row[] = $item->normal_priority_time==null?'-':$item->normal_priority_time;
			$row[] = ucfirst($item->medium_priority_name)=='' ? '-' : ucfirst($item->medium_priority_name);
			$row[] = $item->medium_priority_time==null?'-':$item->medium_priority_time;
			$row[] = ucfirst($item->high_priority_name)=='' ? '-' : ucfirst($item->high_priority_name);
			$row[] = $item->high_priority_time==null?'-':$item->high_priority_time;
		
		
            $data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->laporan->get_all_data(),
			"recordsFiltered" => $this->laporan->get_filtered_data(1),
			"data" => $data,
		);

		echo json_encode($output);
	}

	public function ajax_list_laporan_commandcenter_dt()
	{
		$list = $this->laporan->make_datatables(2);

		$data = array(); 
        
        foreach ($list as $item) {
			
			$waktu=explode(" ",$item->laporan_created_timestamp);
			$waktu_str=$waktu[0]."</br>".$waktu[1];
			
            $row = array();
			$row[] = $item->laporan_priority_status_id;
			$row[] = $waktu_str;
			$row[] = $item->laporan_name;
			$row[] = $item->laporan_phone_no;
			$row[] = $item->ruas_name;
			$row[] = $item->laporan_km;
			$row[] = $item->laporan_jalur;
			$row[] = $item->laporan_vehicle_category;
			$row[] = $item->laporan_plat_no;
			$row[] = $item->kendala;
			$row[] = $item->laporan_description;
			$row[] = $item->status_name;			
			$row[] = '<button id="assignButton" onClick="assignRuas('.$item->laporan_ruas_id.','.$item->laporan_id.')" class="btn btn-sm btn-primary">Forward</button>';
			$row[] = $item->normal_priority_name=='' ? '-' : ucfirst($item->normal_priority_name);
			$row[] = $item->normal_priority_time==null?'-':$item->normal_priority_time;
			$row[] = ucfirst($item->medium_priority_name)=='' ? '-' : ucfirst($item->medium_priority_name);
			$row[] = $item->medium_priority_time==null?'-':$item->medium_priority_time;
			$row[] = ucfirst($item->high_priority_name)=='' ? '-' : ucfirst($item->high_priority_name);
			$row[] = $item->high_priority_time==null?'-':$item->high_priority_time;
		
		
            $data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->laporan->get_all_data(),
			"recordsFiltered" => $this->laporan->get_filtered_data(2),
			"data" => $data,
		);

		echo json_encode($output);
	}
	
	public function ajax_list_laporan_commandcenter_sd()
	{
		$list = $this->laporan->make_datatables(3);

		$data = array(); 
        
        foreach ($list as $item) {
			
			$waktu=explode(" ",$item->laporan_created_timestamp);
			$waktu_str=$waktu[0]."</br>".$waktu[1];
			
            $row = array();
			$row[] = $item->laporan_priority_status_id;
			$row[] = $waktu_str;
			$row[] = $item->laporan_name;
			$row[] = $item->laporan_phone_no;
			$row[] = $item->ruas_name;
			$row[] = $item->laporan_km;
			$row[] = $item->laporan_jalur;
			$row[] = $item->laporan_vehicle_category;
			$row[] = $item->laporan_plat_no;
			$row[] = $item->kendala;
			$row[] = $item->laporan_description;
			$row[] = $item->status_name;			
			$row[] = '<button id="assignButton" onClick="assignRuas('.$item->laporan_ruas_id.','.$item->laporan_id.')" class="btn btn-sm btn-primary">Forward</button>';
			$row[] = $item->normal_priority_name=='' ? '-' : ucfirst($item->normal_priority_name);
			$row[] = $item->normal_priority_time==null?'-':$item->normal_priority_time;
			$row[] = ucfirst($item->medium_priority_name)=='' ? '-' : ucfirst($item->medium_priority_name);
			$row[] = $item->medium_priority_time==null?'-':$item->medium_priority_time;
			$row[] = ucfirst($item->high_priority_name)=='' ? '-' : ucfirst($item->high_priority_name);
			$row[] = $item->high_priority_time==null?'-':$item->high_priority_time;
		
		
            $data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->laporan->get_all_data(),
			"recordsFiltered" => $this->laporan->get_filtered_data(3),
			"data" => $data,
		);

		echo json_encode($output);
	}
}