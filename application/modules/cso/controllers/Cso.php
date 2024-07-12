<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cso extends MY_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model('cso_model','cso');	
		$this->load->model('Laporan_model','laporan');		
	}
	
	public function index()
    {
        if($this->session->role == "1"){
           $this->dashboard();
		}
		else
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
			$this->load->view('template/error-403',$data);
		}       
    }

	public function dashboard()
	{
		$data['ruasOption']=$this->cso->getRuasOption();
		$data['kendalaOption']=$this->cso->getKendalaOption();

		$this->template->loadTemplate('cso/laporan',$data);
	}

	public function AddOrEditLaporan()
	{
		$data ['id'] 			= $this->input->post('id');
		$data ['ruas_group'] 	= $this->input->post('ruas_group');
		$data ['priority_id'] 	= $this->input->post('priority_id');
		$data ['nama'] 			= $this->input->post('nama');
		$data ['hp'] 			= $this->input->post('hp');
		$data ['jenis'] 		= $this->input->post('jenis');
		$data ['nopol'] 		= $this->input->post('nopol');
		$data ['kendala'] 		= $this->input->post('kendala');
		$data ['ruas'] 			= $this->input->post('ruas');
		$data ['km'] 			= $this->input->post('km');
		$data ['jalur'] 		= $this->input->post('jalur');
		$data ['keterangan'] 	= $this->input->post('keterangan');
		$data ['status_id'] 	= $this->input->post('status_id');
		$data ['warna'] 		= $this->input->post('warna');
		$data ['user_id'] 		= $this->session->npp;
		
		$insert = $this->cso->AddOrEditLaporanModel($data);

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

	public function cancelLaporan()
	{
		$data ['id'] 				= $this->input->post('laporan_id');
		$data ['user'] 				= $this->input->post('user_id');
	
		$select = $this->cso->cancelLaporanModel($data);

		echo json_encode($select);
	}

	public function getRuasGroup()
	{
		$data ['id'] 				= $this->input->post('id');
	
		$select = $this->cso->getRuasGroupModel($data);

		echo json_encode($select);
	}

	public function ajax_list_laporan_cso_bd()
	{
		$list = $this->laporan->make_datatables(1);

		$data = array(); 
        
        foreach ($list as $item) {

			$lket=strlen($item->laporan_description);
			if(($lket != '') && ($lket > 20))
			{
				$lket=substr($item->laporan_description, 0, 35);
				$lket .=' <btn onClick="showDetailKeterangan(`'.$item->laporan_description.'`);" class="btn icon btn-dark"><i data-feather="edit"></i></btn>';
			}else
			{
				$lket=$item->laporan_description;
			}

			
			$waktu=explode(" ",$item->laporan_created_timestamp);
			$waktu_str=$waktu[0]."</br>".$waktu[1];
			
			$kendaraan = $this->cso->getDetailKendaraanModel($item->kendaraan_assigned);

            $row = array();
			$row[] = $item->laporan_priority_status_id;
			$row[] = $item->status_id;
			$row[] = $waktu_str;
			$row[] = $item->laporan_name;
			$row[] = $item->laporan_phone_no;
			$row[] = $item->ruas_name;
			$row[] = $item->laporan_km;
			$row[] = $item->laporan_jalur;
			$row[] = $item->laporan_vehicle_category;
			$row[] = $item->laporan_plat_no;
			$row[] = $item->kendala;
			$row[] = $lket;
			$row[] = $item->status_name;			
			$row[] = $item->normal_priority_name=='' ? '-' : ucfirst($item->normal_priority_name);
			$row[] = $item->normal_priority_time==null?'-':$item->normal_priority_time;
			$row[] = ucfirst($item->medium_priority_name)=='' ? '-' : ucfirst($item->medium_priority_name);
			$row[] = $item->medium_priority_time==null?'-':$item->medium_priority_time;
			$row[] = ucfirst($item->high_priority_name)=='' ? '-' : ucfirst($item->high_priority_name);
			$row[] = $item->high_priority_time==null?'-':$item->high_priority_time;
			$row[] = $kendaraan;
		
		
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

	public function ajax_list_laporan_cso_dt()
	{
		$list = $this->laporan->make_datatables(2);

		$data = array(); 
        
        foreach ($list as $item) {

			$lket=strlen($item->laporan_description);
			if(($lket != '') && ($lket > 20))
			{
				$lket=substr($item->laporan_description, 0, 35);
				$lket .=' <btn onClick="showDetailKeterangan(`'.$item->laporan_description.'`);" class="btn icon btn-dark"><i data-feather="edit"></i></btn>';
			}else
			{
				$lket=$item->laporan_description;
			}

			
			$waktu=explode(" ",$item->laporan_created_timestamp);
			$waktu_str=$waktu[0]."</br>".$waktu[1];
			
			$kendaraan = $this->cso->getDetailKendaraanModel($item->kendaraan_assigned);

            $row = array();
			$row[] = $item->laporan_priority_status_id;
			$row[] = $item->status_id;
			$row[] = $waktu_str;
			$row[] = $item->laporan_name;
			$row[] = $item->laporan_phone_no;
			$row[] = $item->ruas_name;
			$row[] = $item->laporan_km;
			$row[] = $item->laporan_jalur;
			$row[] = $item->laporan_vehicle_category;
			$row[] = $item->laporan_plat_no;
			$row[] = $item->kendala;
			$row[] = $lket;
			$row[] = $item->status_name;			
			$row[] = $item->normal_priority_name=='' ? '-' : ucfirst($item->normal_priority_name);
			$row[] = $item->normal_priority_time==null?'-':$item->normal_priority_time;
			$row[] = ucfirst($item->medium_priority_name)=='' ? '-' : ucfirst($item->medium_priority_name);
			$row[] = $item->medium_priority_time==null?'-':$item->medium_priority_time;
			$row[] = ucfirst($item->high_priority_name)=='' ? '-' : ucfirst($item->high_priority_name);
			$row[] = $item->high_priority_time==null?'-':$item->high_priority_time;
			$row[] = $kendaraan;
		
		
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

	public function ajax_list_laporan_cso_sd()
	{
		$list = $this->laporan->make_datatables(3);

		$data = array(); 
        
        foreach ($list as $item) {

			$lket=strlen($item->laporan_description);
			if(($lket != '') && ($lket > 20))
			{
				$lket=substr($item->laporan_description, 0, 35);
				$lket .=' <btn onClick="showDetailKeterangan(`'.$item->laporan_description.'`);" class="btn icon btn-dark"><i data-feather="edit"></i></btn>';
			}else
			{
				$lket=$item->laporan_description;
			}

			
			$waktu=explode(" ",$item->laporan_created_timestamp);
			$waktu_str=$waktu[0]."</br>".$waktu[1];
			
			$kendaraan = $this->cso->getDetailKendaraanModel($item->kendaraan_assigned);

            $row = array();
			$row[] = $item->laporan_priority_status_id;
			$row[] = $item->status_id;
			$row[] = $waktu_str;
			$row[] = $item->laporan_name;
			$row[] = $item->laporan_phone_no;
			$row[] = $item->ruas_name;
			$row[] = $item->laporan_km;
			$row[] = $item->laporan_jalur;
			$row[] = $item->laporan_vehicle_category;
			$row[] = $item->laporan_plat_no;
			$row[] = $item->kendala;
			$row[] = $lket;
			$row[] = $item->status_name;			
			$row[] = $item->normal_priority_name=='' ? '-' : ucfirst($item->normal_priority_name);
			$row[] = $item->normal_priority_time==null?'-':$item->normal_priority_time;
			$row[] = ucfirst($item->medium_priority_name)=='' ? '-' : ucfirst($item->medium_priority_name);
			$row[] = $item->medium_priority_time==null?'-':$item->medium_priority_time;
			$row[] = ucfirst($item->high_priority_name)=='' ? '-' : ucfirst($item->high_priority_name);
			$row[] = $item->high_priority_time==null?'-':$item->high_priority_time;
			$row[] = $kendaraan;
		
		
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