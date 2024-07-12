<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tic extends MY_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model('Laporan_model','laporan');	
		$this->load->model('Petugas_model','petugas');		
		$this->load->model('Kendaraan_model','kendaraan');
		$this->load->model('Formasi_model','formasi');		
		$this->load->model('Tic_model','tic');	
		if(!$this->session->npp){
			redirect(base_url('auth'));
		};
	}
	
	public function index()
    {

		if($this->session->role == "3"){
			$data['ruasOption']=$this->tic->getRuasOption();
			$data['csOption']=$this->tic->getFormasiKendaraanOption($this->session->ruas,1);
			$data['ambulanceOption']=$this->tic->getFormasiKendaraanOption($this->session->ruas,2);
			$data['rescueOption']=$this->tic->getFormasiKendaraanOption($this->session->ruas,3);
			$data['derekOption']=$this->tic->getFormasiKendaraanOption($this->session->ruas,4);	
			
			$ses['ruas_group'] 	= $this->session->ruas_group;
			$ses['ruas'] 		= $this->session->ruas;
			$data['info'] = $this->tic->getSummaryTICModel($ses);

			$this->template->loadTemplate('tic/laporan',$data);
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

	
	public function petugas()
	{
		$data['ruasOption']=$this->tic->getRuasOptionByGroup($this->session->ruas_group);
		$data['kendaraanJenisOption']=$this->tic->getJenisKendaraan();
		$this->template->loadTemplate('tic/petugas',$data);
	}

	public function kendaraan()
	{
		$data['ruasOption']=$this->tic->getRuasOptionByGroup($this->session->ruas_group);
		$data['kendaraanJenisOption']=$this->tic->getJenisKendaraan();
		$this->template->loadTemplate('tic/kendaraan',$data);
	}

	public function getKendaraan()
	{
		$ruas 			= $this->input->post('ruas');
		$jenis			= $this->input->post('jenis');
		
		$get= $this->tic->getKendaraanOption($ruas,$jenis);
		echo json_encode($get);
	}

	public function getPetugasExisting()
	{
		$data['jenis'] 			= $this->input->post('jenis');
		$data['ruas'] 			= $this->input->post('ruas');
		
		$get= $this->tic->getPetugasExistingOption($data);
		echo json_encode($get);
	}

	
	
	public function getFormasiKendaraan()
	{
		$ruas 			= $this->input->post('ruas');
		$jenis			= $this->input->post('jenis');
		
		$get= $this->tic->getFormasiKendaraanOption($ruas,$jenis);
		echo json_encode($get);
	}

	public function getPetugas()
	{
		$ruas 			= $this->input->post('ruas');
		$jenis			= $this->input->post('jenis');

		$get= $this->tic->getPetugasOption($ruas,$jenis);
		echo json_encode($get);
	}

	public function getPetugasKedua()
	{
		$ruas 			= $this->input->post('ruas');
		$id				= $this->input->post('ex');
		$jenis			= $this->input->post('jenis');

		$get= $this->tic->getPetugasKeduaOption($ruas,$id,$jenis);
		echo json_encode($get);
	}

	public function formasi()
	{
		$data['kendaraanJenisOption']=$this->tic->getJenisKendaraan();
		$data['kendaraadidOption']=$this->tic->getKendaraanOption($this->session->ruas,0);
		$data['ruasOption']=$this->tic->getRuasOptionByGroup($this->session->ruas_group);

		$this->template->loadTemplate('tic/formasi',$data);
	}

	public function getKendaraanAvailable()
	{
		$ruas				= $this->input->post('ruas');		

		$cs = $this->tic->getKendaraanAvailableModel($ruas,1);
		$ambulance = $this->tic->getKendaraanAvailableModel($ruas,2);
		$rescue = $this->tic->getKendaraanAvailableModel($ruas,3);
		$derek = $this->tic->getKendaraanAvailableModel($ruas,4);


		$result=array('cs'=>$cs,'ambulance'=>$ambulance,'rescue'=>$rescue,'derek'=>$derek);

		echo json_encode($result);
	}
	
	public function AddOrEditFormasi()
	{
		$data ['id'] 			= $this->input->post('id');
		$data ['jenis'] 		= $this->input->post('jenis');
		$data ['kendaraan_id'] 	= $this->input->post('kendaraan_id');
		$data ['petugas1'] 		= $this->input->post('petugas_1');
		$data ['petugas2'] 		= $this->input->post('petugas_2');
		$data ['kendaraan_nomor'] 	= $this->input->post('kendaraan_nomor');
		$data ['ruas'] 				= $this->input->post('ruas');
		$data ['group_ruas'] 		= $this->session->ruas_group;

		$insert = $this->tic->AddOrEditFormasiModel($data);
		
		echo json_encode($insert);		

	}

	public function EditFormasi()
	{
		$data ['id'] 			= $this->input->post('id_e');		
		$data ['ruas'] 			= $this->input->post('ruas_e');		
		$data ['petugas1'] 		= $this->input->post('petugas_1_e');
		$data ['petugas2'] 		= $this->input->post('petugas_2_e');
		
		$insert = $this->tic->EditFormasiModel($data);
		
		echo json_encode($insert);		

	}

	public function AddOrEditLaporan()
	{
		$data ['id'] 			= $this->input->post('id');
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
		$data ['user_id'] 		= $this->session->user_id;
		
		$insert = $this->cso->AddOrEditLaporanModel($data);

		echo json_encode($insert);
	}

	public function AddOrEditPetugas()
	{
		$data ['id'] 			= $this->input->post('id');		
		$data ['nama'] 			= $this->input->post('nama');
		$data ['hp'] 			= $this->input->post('hp');
		$data ['jenis'] 		= $this->input->post('jenis');	
		$data ['ruas'] 			= $this->input->post('ruas');
		$data ['group_ruas'] 	= $this->session->ruas_group;
		

		if($this->input->post('status')=='0')
		{
			$data ['nik'] 		= random_int(100000, 999999);
			
		}else
		{
			$data ['nik'] 			= $this->input->post('nik');
		}

		
		$insert = $this->tic->AddOrEditPetugasModel($data);

		echo json_encode($insert);
	}

	public function AddOrEditKendaraan()
	{
		$data ['id'] 				= $this->input->post('id');		
		$data ['jenis'] 			= $this->input->post('jenis');
		$data ['ruas'] 				= $this->input->post('ruas');
		$data ['group_ruas'] 		= $this->session->ruas_group;
		$data ['kode'] 				= $this->input->post('kode');	
		
		$insert = $this->tic->AddOrEditKendaraanModel($data);

		echo json_encode($insert);
	}

	public function getKendaraanExisting()
	{
		
		$data ['id'] 				= $this->input->post('id');
		
		$select = $this->tic->getKendaraanExistingModel($data);

		$kendaraan_list=[];
		if($select != null)
		{
			$data=json_decode($select);

			foreach($data as $row)
			{
			$take=$this->tic->getKendaraanNumberModel($row);

			$result=array(
					'jenis'=>$take->kendaraan_jenis,
					'id'=>$take->kendaraan_id,
					'nomor'=>$take->kendaraan_nomor
				);

			array_push($kendaraan_list, $result);
			}
		}
		else
		{
			$result=array(
				'jenis'=>0,
				'id'=>0,
				'nomor'=>0
			);

			array_push($kendaraan_list, $result);
		}
		
		
		echo json_encode($kendaraan_list);
	}

	public function getKendaraanDetail()
	{
		$data ['id'] 				= $this->input->post('id');
		$data ['ruas'] 				= $this->input->post('ruas');

		$select = $this->tic->getKendaraanDetailModel($data);

		echo json_encode($select);
	}

	public function getFormasiDetail()
	{
		$data ['id'] 				= $this->input->post('id');
	
		$select = $this->tic->getFormasiDetailModel($data);

		echo json_encode($select);
	}

	

	public function getPetugasDetail()
	{
		$data ['npp'] 				= $this->input->post('npp');
		$data ['ruas'] 				= $this->input->post('ruas');

		$select = $this->tic->getPetugasDetailModel($data);

		echo json_encode($select);
	}
	
	public function getDetailLaporan()
	{
		$data ['waktu'] 			= $this->input->post('waktu');
		$data ['hp'] 				= $this->input->post('hp');
		$data ['nopol'] 			= $this->input->post('nopol');

		$select = $this->cso->getDetailLaporanModel($data);

		echo json_encode($select);
	}

	public function assignFormasi()
	{
		$data ['id'] 			= $this->input->post('laporan_id');
		$data ['ruas_id'] 		= $this->input->post('ruas_id');
		$data ['cs'] 			= $this->input->post('cs');
		$data ['ambulance'] 	= $this->input->post('ambulance');
		$data ['rescue'] 		= $this->input->post('rescue');
		$data ['derek'] 		= $this->input->post('derek');
		$data ['user_id'] 		= $this->session->user_id;
		
		$laporan=$this->tic->assignFormasiModel($data);

		echo json_encode($laporan);
	}

	public function petugasArrived()
	{
		$data ['laporan_id'] 		= $this->input->post('laporan_id');
		$data ['ruas_id'] 			= $this->input->post('ruas');
		$data ['user_id'] 			= $this->input->post('user_id');
		
		$laporan=$this->tic->petugasArrivedModel($data);

		echo json_encode($data);
	}

	
	public function petugasDone()
	{
		$data ['laporan_id'] 		= $this->input->post('laporan_id');
		$data ['ruas_id'] 			= $this->input->post('ruas');
		$data ['user_id'] 			= $this->input->post('user_id');
		
		$laporan=$this->tic->petugasDoneModel($data);

		echo json_encode($laporan);
	}

	public function deleteKendaraan()
	{
		$data ['id'] 				= $this->input->post('id');
		$data ['ruas_id'] 			= $this->input->post('ruas');
			
		$laporan=$this->tic->deleteKendaraanModel($data);

		echo json_encode($laporan);
	}

	public function deletePetugas()
	{
		$data ['npp'] 			= $this->input->post('npp');
		$data ['ruas'] 			= $this->input->post('ruas');
			
		$laporan=$this->tic->deletePetugasModel($data);

		echo json_encode($laporan);
	}

	public function deleteFormasi()
	{
		$data ['id'] 			= $this->input->post('id');
					
		$laporan=$this->tic->deleteFormasiModel($data);

		echo json_encode($laporan);
	}

	public function resetFormasi()
	{
		$data ['ruas'] 			= $this->input->post('ruas');
		$data ['ruas_group'] 	= $this->input->post('ruas_group');
					
		$laporan=$this->tic->resetFormasiModel($data);

		echo json_encode($laporan);
	}

	
	public function ajax_list_formasi_petugas()
	{
		$list = $this->formasi->make_datatables();

		$data = array(); 
        $no=1;

        foreach ($list as $item) {
			
			$button='<div class="btn-group" role="group" aria-label="Basic example">
						
						<button type="button" onclick="deleteFormasi('.$item->data_petugas_id.','.$item->status.')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
					</div>';
					//<button type="button" onclick="editFormasi('.$item->data_petugas_id.','.$item->status.')" class="btn btn-warning"><i class="fa fa-edit"></i></button>
			if($item->status==0){
				$status='<span class="badge bg-success">Available</span>';
			}else
			{
				$status='<span class="badge bg-danger">On Duty</span>';
			}
			
            $row = array();
			$row[] = $no;

			$row[] = $item->jenis_kendaraan;
			$row[] = $item->kendaraan_nomor;
			$row[] = $item->ruas_name;
			$row[] = $item->pt1==''?'-':$item->pt1;
			$row[] = $item->pt2==''?'-':$item->pt2;
			$row[] = $status;
			$row[] = $button;
		
            $data[] = $row;
			$no++;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->formasi->get_all_data(),
			"recordsFiltered" => $this->formasi->get_filtered_data(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	public function ajax_list_petugas()
	{
		$list = $this->petugas->make_datatables();

		$data = array(); 
        $no=1;

        foreach ($list as $item) {
			
			$button='<div class="btn-group" role="group" aria-label="Basic example">
						<button type="button" onclick="editPetugas(`'.$item->npp_petugas.'`,'.$item->ruas_id.')" class="btn btn-warning"><i class="fa fa-edit"></i></button>
						<button type="button" onclick="deletePetugas(`'.$item->npp_petugas.'`,'.$item->ruas_id.')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
					</div>';
			
			if($item->status==0){
				$status='<span class="badge bg-success">Available</span>';
			}else
			{
				$status='<span class="badge bg-danger">On Duty</span>';
			}

            $row = array();
			$row[] = $no;

			$row[] = $item->npp_petugas;
			$row[] = $item->nama_petugas;
			$row[] = $item->jenis_kendaraan;
			$row[] = $item->ruas_name;
			$row[] = $item->no_hp;
			$row[] = $status;
			$row[] = $button;
		
            $data[] = $row;
			$no++;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->petugas->get_all_data(),
			"recordsFiltered" => $this->petugas->get_filtered_data(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	public function ajax_list_kendaraan()
	{
		$list = $this->kendaraan->make_datatables();

		$data = array(); 
        $no=1;

        foreach ($list as $item) {
			
			$button='<div class="btn-group" role="group" aria-label="Basic example">
						<button type="button" onclick="editKendaraan('.$item->kendaraan_id.','.$item->ruas_id.','.$item->status.')" class="btn btn-warning"><i class="fa fa-edit"></i></button>
						<button type="button" onclick="deleteKendaraan('.$item->kendaraan_id.','.$item->ruas_id.','.$item->status.')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
					</div>';
			
			if($item->status==0)
			{
				$status='<span class="badge bg-success">Available</span>';
			}
			else
			{
				$status='<span class="badge bg-danger">Assigned</span>';
			}	

            $row = array();
			$row[] = $no;

			$row[] = $item->jenis_kendaraan;
			$row[] = $item->kendaraan_nomor;			
			$row[] = $item->ruas_name;
			$row[] = $status;
			$row[] = $button;
		
            $data[] = $row;
			$no++;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->kendaraan->get_all_data(),
			"recordsFiltered" => $this->kendaraan->get_filtered_data(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	public function ajax_list_laporan_tic_bd()
	{
		$list = $this->laporan->make_datatables(1);

		$data = array(); 
        
        foreach ($list as $item) {
			
			$waktu=explode(" ",$item->laporan_created_timestamp);
			$waktu_str=$waktu[0]."</br>".$waktu[1];
			$kendaraan = $this->tic->getDetailKendaraanModel($item->kendaraan_assigned);

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
			$row[] = '<button id="assignButton" onClick="assignRuas('.$item->laporan_ruas_id.','.$item->laporan_id.')" class="btn btn-sm btn-primary">Assign</button>';
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

	public function ajax_list_laporan_tic_dt()
	{
		$list = $this->laporan->make_datatables(2);

		$data = array(); 
        
        foreach ($list as $item) {
			
			$waktu=explode(" ",$item->laporan_created_timestamp);
			$waktu_str=$waktu[0]."</br>".$waktu[1];
			
			if($item->status_id=='4')
			{
				$dis='disabled';
			}
			else
			{
				$dis='';
			}

			$button='<div class="btn-group mb-3 btn-group-sm" role="group" aria-label="Basic example">
				<button onClick="reAssignPetugas('.$item->laporan_ruas_id.','.$item->laporan_id.')" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Bantuan Petugas" class="btn btn-danger"><i class="fa fa-share"></i></button>
				<button '.$dis.' onClick="petugasArrived('.$item->laporan_ruas_id.','.$item->laporan_id.')" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Petugas Sampai Di Lokasi"  class="btn btn-primary"><i class="fa fa-user"></i></button>
				<button onClick="petugasDone('.$item->laporan_ruas_id.','.$item->laporan_id.')" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="Selesai Ditindak"  class="btn btn-success"><i class="fa fa-check"></i></button>
			</div>';
			
			$kendaraan = $this->tic->getDetailKendaraanModel($item->kendaraan_assigned);

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
			$row[] = $button;
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
	
	public function ajax_list_laporan_tic_sd()
	{
		$list = $this->laporan->make_datatables(3);

		$data = array(); 
        
        foreach ($list as $item) {
			
			$waktu=explode(" ",$item->laporan_created_timestamp);
			$waktu_str=$waktu[0]."</br>".$waktu[1];
			$kendaraan = $this->tic->getDetailKendaraanModel($item->kendaraan_assigned);

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