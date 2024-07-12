<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

defined('BASEPATH') OR exit('No direct script access allowed');

class Management extends MY_Controller {

    public function __construct()
	{
		parent::__construct();
		$this->load->model('Management_model','management');
		$this->load->model('Laporan_model','laporan');	
		$this->load->model('User_model','user');	
	}
	
	public function index()
    {
		if($this->session->role == "4"){
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

	public function laporan()
	{
		$data ['ruasOption'] = $this->management->getRuasOption();
		$this->template->loadTemplate('management/laporan',$data);
	}

	public function credit()
	{
		$this->load->view('management/credit');
	}

	public function getSummaryGrafikLaporanMasuk()
	{
		$tahun=$this->input->post('tahun');
		$record = $this->management->getSummaryGrafikLaporanMasukByTahun($tahun);
		$item = [];
   
		foreach($record as $row) {
			  $item['label'][] = $row->id;
			  $item['data'][] = $row->jumlah;
		}

		echo json_encode($item);

	}

	public function dashboard()
	{
		
		$record = $this->management->getSummaryGrafikLaporanMasukByTahun(date("Y"));
		$rating = $this->management->getSummaryRatingLaporanMasuk();
		$blast = $this->management->getSummaryBlastStatus();
		$itemGrafik = [];
		$itemRating = [];

		foreach($record as $row) {
			  $itemGrafik['label'][] = $row->id;
			  $itemGrafik['data'][] = $row->jumlah;
		}

		foreach($rating as $row) {
			  $itemRating['label'][] = $row->rating . ' Stars' ;
			  $itemRating['data'][] = (int)$row->jumlah;
		}

	
		
		$data ['summary_grafik_laporan_masuk'] = json_encode($itemGrafik);
		$data ['summary_rating_laporan_masuk'] = json_encode($itemRating);
		$data ['summary_blast_status'] = json_encode($blast);
		
		$record = $this->management->getSummaryAllruasPetugas();
		$item = [];
   
		foreach($record as $row) {
			  $item['label'][] = $row->jenis_petugas;
			  $item['data'][] = $row->jumlah;
		}
		
		$data ['summary_allruas_petugas'] = json_encode($item);

		$record = $this->management->getSummaryAllruasAgent();
		$item = [];
   
		foreach($record as $row) {
			  $item['label'][] = $row->role;
			  $item['data'][] = $row->jumlah;
		}
		
		$data ['summary_allruas_agent'] = json_encode($item);

		$record = $this->management->getSummaryAllruasKendaraan();
		$item = [];
   
		foreach($record as $row) {
			  $item['label'][] = $row->kendaraan_jenis;
			  $item['data'][] = $row->jumlah;
		}
		
		$data ['summary_allruas_kendaraan'] = json_encode($item);
		
		$data ['summary_top'] = $this->management->getSummaryDataTop();
		$this->template->loadTemplate('management/dashboard',$data);
	}

	public function rekapitulasi()
	{
		$data ['ruasOption'] = $this->management->getRuasOption();
		$this->template->loadTemplate('management/rekapitulasi',$data);
	}

	public function user()
	{
		$data ['roleOption'] = $this->management->getRoleOption();
		$data ['ruasOption'] = $this->management->getRuasOption();
		$this->template->loadTemplate('management/user',$data);
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


	public function cekNPP()
	{
		$data ['npp'] 		= $this->input->post('npp');
		$data ['ruas'] 		= $this->input->post('ruas');
		
		$get = $this->management->cekNPPmodel($data);

		echo json_encode($get);
	}

	public function getDetailLaporan()
	{
		$data ['waktu'] 			= $this->input->post('waktu');
		$data ['hp'] 				= $this->input->post('hp');
		$data ['nopol'] 			= $this->input->post('nopol');

		$select = $this->cso->getDetailLaporanModel($data);

		echo json_encode($select);
	}

	public function getDetailLaporanByID()
	{
		$data ['id'] 				= $this->input->post('id');

		$select = $this->management->getDetailLaporanByIDModel($data);

		echo json_encode($select);
	}
	
	public function getPetugasName()
	{
		$data 				= $this->input->post('data');
		
		$get = $this->management->getPetugasNameModel($data);
		
		echo json_encode($get);
	}

	public function reporting_export()
	{
			$data['tgl1'] 	 = $this->input->post('tgl1');
			$data['tgl2'] 	 = $this->input->post('tgl2');
			$data['ruas'] 	 = $this->input->post('ruas');
			$data['jenis'] 	 = $this->input->post('jenis');
			
			switch($data['jenis'])
			{
				case '1' :
					$this->report_laporan_masuk($data);
				break;
				case '2' :
					$this->report_detail_petugas($data);
				break;
				case '3' :
					$this->report_summary_petugas($data);
				break;
				case '4' :
					
				break;
				case '5' :
					
				break;
			}

			
	}

	public function AddOrEditUser()
	{
		$data ['id'] 			= $this->input->post('id');
		$data ['ruas_group'] 	= $this->input->post('ruas_group');
		$data ['nama'] 			= $this->input->post('nama');
		$data ['npp'] 			= $this->input->post('npp');
		$data ['role'] 			= $this->input->post('role');
		$data ['ruas'] 			= $this->input->post('ruas');
		$data ['password'] 		= $this->input->post('password1');
		
		$insert = $this->management->AddOrEditUserModel($data);

		echo json_encode($insert);


	}

	public function report_laporan_masuk($data)
	{
		
		$data['option']	 = 'Laporan Masuk';

		$judul=$data['option'];
		$tanggal_search=$data['tgl1'].' s/d '.$data['tgl2'];
		$get=$this->management->getRuasName($data['ruas']);		
		
		//constructor
		$spreadsheet = new Spreadsheet();
		
		$sheet = $spreadsheet->getActiveSheet($data);
		$sheet->setCellValue('A1', 'Judul :');
		$sheet->setCellValue('B1', $judul);
		$sheet->setCellValue('A2', 'Tanggal :');
		$sheet->setCellValue('B2', $tanggal_search);
		$sheet->setCellValue('A3', 'Ruas :');
		$sheet->setCellValue('B3', $get);
		
		//Header
		$sheet->setCellValue('A5', 'No');
		$sheet->setCellValue('B5', 'Nama');
		$sheet->setCellValue('C5', 'No Hp');
		$sheet->setCellValue('D5', 'Ruas');
		$sheet->setCellValue('E5', 'KM');
		$sheet->setCellValue('F5', 'Jalur');
		$sheet->setCellValue('G5', 'Jenis Kedala');
		$sheet->setCellValue('H5', 'Kendaraan');
		$sheet->setCellValue('I5', 'Agent CSO');
		$sheet->setCellValue('J5', 'Command Center');
		$sheet->setCellValue('K5', 'TIC');
		$sheet->setCellValue('L5', 'Waktu Laporan (T1)');
		$sheet->setCellValue('M5', 'Waktu Forward (T2)');
		$sheet->setCellValue('N5', 'Waktu Assign (T3)');
		$sheet->setCellValue('O5', 'Waktu Petugas Tiba (T4)');
		$sheet->setCellValue('P5', 'Waktu Selesai Penaganan (T5)');
		$sheet->setCellValue('Q5', 'Durasi Forward (T2-T1)');
		$sheet->setCellValue('R5', 'Durasi Assign (T3-T2)');
		$sheet->setCellValue('S5', 'Response Time Petugas (T4-T3)');
		$sheet->setCellValue('T5', 'Durasi Response Time (T4-T1)');
		$sheet->setCellValue('U5', 'Waktu Penanganan (T5-T4)');
		$sheet->setCellValue('V5', 'Total Waktu Pelayanan (T5-T1)');
		$sheet->setCellValue('W5', 'Kendaraan');
		$sheet->setCellValue('X5', 'Petugas');
		$sheet->setCellValue('Y5', 'Rating Pelanggan');
		$sheet->setCellValue('Z5', 'Ulasan');
		$sheet->setCellValue('AA5', 'Saran Perbaikan');
	
		//data model
		$item=$this->management->getReportingLaporanMasuk($data);		

		$no = 1;
		$x = 6;
		foreach($item as $row)
		{

			if($row->data_petugas_id != '[]')
			{
						
				$petugas=$this->management->getPetugasNameModel($row->data_petugas_id);
				$petugas= implode(",",$petugas);
				
			}else
			{
				$petugas='-';
			}

			if($row->kendaraan_assigned != '[]')
			{
						
				$kendaraan=$this->management->getNomoKendaraanModel($row->kendaraan_assigned);
				$kendaraan= implode(",",$kendaraan);
				
			}else
			{
				$kendaraan='-';
			}


			$sheet->setCellValue('A'.$x, $no++);
			$sheet->setCellValue('B'.$x, $row->laporan_name);
			$sheet->setCellValue('C'.$x, $row->laporan_phone_no);
			$sheet->setCellValue('D'.$x, $row->ruas_name);
			$sheet->setCellValueExplicit('E'.$x, $row->laporan_km,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$sheet->setCellValue('F'.$x, $row->laporan_jalur);
			$sheet->setCellValue('G'.$x, $row->kendala);
			$sheet->setCellValue('H'.$x, $row->laporan_vehicle_category);
			$sheet->setCellValue('I'.$x, $row->cso_name);
			$sheet->setCellValue('J'.$x, $row->cc_name);
			$sheet->setCellValue('K'.$x, $row->tic_name);
			$sheet->setCellValue('L'.$x, $row->laporan_created_timestamp);
			$sheet->setCellValue('M'.$x, $row->laporan_forward_to_tic_timestamp);
			$sheet->setCellValue('N'.$x, $row->laporan_forward_to_petugas_timestamp);
			$sheet->setCellValue('O'.$x, $row->laporan_petugas_arrived_timestamp);
			$sheet->setCellValue('P'.$x, $row->laporan_closed_timestamp);
			$sheet->setCellValue('Q'.$x, $row->durasi_forward);
			$sheet->setCellValue('R'.$x, $row->durasi_assign);
			$sheet->setCellValue('S'.$x, $row->durasi_response_time);
			$sheet->setCellValue('T'.$x, $row->durasi_response_time_petugas);
			$sheet->setCellValue('U'.$x, $row->waktu_penanganan);
			$sheet->setCellValue('V'.$x, $row->waktu_pelayanan);
			$sheet->setCellValueExplicit('W'.$x, $kendaraan,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$sheet->setCellValue('X'.$x, $petugas);			
			$sheet->setCellValue('Y'.$x, $row->feedback_rate);
			$sheet->setCellValue('Z'.$x, $row->feedback_comment);
			$sheet->setCellValue('AA'.$x, $row->feedback_suggest);
			
			
		
			$x++;
		}

		$writer = new Xlsx($spreadsheet);
		$filename = $data['option'].'_'.$get.'_'.$data['tgl1'].'_'.$data['tgl2'];
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function report_detail_petugas($data)
	{
		
		$data['option']	 = 'Detail Petugas';

		$judul=$data['option'];
		$tanggal_search=$data['tgl1'].' s/d '.$data['tgl2'];
		$get=$this->management->getRuasName($data['ruas']);		
		
		//constructor
		$spreadsheet = new Spreadsheet();
		
		$sheet = $spreadsheet->getActiveSheet($data);
		$sheet->setCellValue('A1', 'Judul :');
		$sheet->setCellValue('B1', $judul);
		$sheet->setCellValue('A2', 'Tanggal :');
		$sheet->setCellValue('B2', $tanggal_search);
		$sheet->setCellValue('A3', 'Ruas :');
		$sheet->setCellValue('B3', $get);
		
		//Header
		$sheet->setCellValue('A5', 'No');
		$sheet->setCellValue('B5', 'Nama Petugas');
		$sheet->setCellValue('C5', 'Npp Petugas');
		$sheet->setCellValue('D5', 'No Kendaraan');
		$sheet->setCellValue('E5', 'Ruas');
		$sheet->setCellValue('F5', 'Laporan ID');
		$sheet->setCellValue('G5', 'Tanggal Laporan');
		$sheet->setCellValue('H5', 'Waktu Assign');
		$sheet->setCellValue('I5', 'Waktu Tiba');
		$sheet->setCellValue('J5', 'Waktu Selesai');
		$sheet->setCellValue('K5', 'Status Laporan');
		$sheet->setCellValue('L5', 'Rating Pelanggan');
		
		//data model
		$item=$this->management->getReportingDetailPetugas($data);	
		
		$no = 1;
		$x = 6;
		foreach($item as $row)
		{		


			//$nomor_kendaraan=$this->management->getNomorKendaraan($row->npp_petugas,$row->kendaraan_assigned);


			$sheet->setCellValue('A'.$x, $no++);
			$sheet->setCellValue('B'.$x, $row->nama_petugas);
			$sheet->setCellValueExplicit('C'.$x, $row->npp_petugas,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$sheet->setCellValue('D'.$x, $row->kendaraan_assigned);
			$sheet->setCellValue('E'.$x, $row->ruas_name);
			$sheet->setCellValue('F'.$x, $row->laporan_id);
			$sheet->setCellValue('G'.$x, $row->laporan_created_timestamp);
			$sheet->setCellValue('H'.$x, $row->laporan_forward_to_petugas_timestamp);
			$sheet->setCellValue('I'.$x, $row->laporan_petugas_arrived_timestamp);
			$sheet->setCellValue('J'.$x, $row->laporan_closed_timestamp);
			$sheet->setCellValue('K'.$x, $row->status_name);
			$sheet->setCellValue('L'.$x, $row->feedback_rate);
		
		
			$x++;
		}

		$writer = new Xlsx($spreadsheet);
		$filename = $data['option'].'_'.$get.'_'.$data['tgl1'].'_'.$data['tgl2'];
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function report_summary_petugas($data)
	{
		
		$data['option']	 = 'Summary Petugas';

		$judul=$data['option'];
		$tanggal_search=$data['tgl1'].' s/d '.$data['tgl2'];
		$get=$this->management->getRuasName($data['ruas']);		
		
		//constructor
		$spreadsheet = new Spreadsheet();
		
		$sheet = $spreadsheet->getActiveSheet($data);
		$sheet->setCellValue('A1', 'Judul :');
		$sheet->setCellValue('B1', $judul);
		$sheet->setCellValue('A2', 'Tanggal :');
		$sheet->setCellValue('B2', $tanggal_search);
		$sheet->setCellValue('A3', 'Ruas :');
		$sheet->setCellValue('B3', $get);
		
		//Header
		//$sheet->mergeCells('A5:A6');
		$sheet->setCellValue('A5', 'No');	
		//$sheet->mergeCells('B5:B6');
		$sheet->setCellValue('B5', 'Ruas');
		//$sheet->mergeCells('C5:C6');
		$sheet->setCellValue('C5', 'Nama Petugas');
		//$sheet->mergeCells('D5:D6');
		$sheet->setCellValue('D5', 'NPP');
		//$sheet->mergeCells('E5:I5');
		$sheet->setCellValue('E5', 'Rating');
		$sheet->setCellValue('E6', 'Rating 5');
		$sheet->setCellValue('F6', 'Rating 4');
		$sheet->setCellValue('G6', 'Rating 3');
		$sheet->setCellValue('H6', 'Rating 2');
		$sheet->setCellValue('I6', 'Rating 1');
		
		
		//data model
		$item=$this->management->getReportingSummaryPetugas($data);	
		
		$no = 1;
		$x = 7;
		foreach($item as $row)
		{		


			$sheet->setCellValue('A'.$x, $no++);
			$sheet->setCellValue('B'.$x, $row->ruas_name);
			$sheet->setCellValue('C'.$x, $row->nama_petugas);
			$sheet->setCellValueExplicit('D'.$x, $row->npp_petugas,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$sheet->setCellValue('E'.$x, $row->x5);
			$sheet->setCellValue('F'.$x, $row->x4);
			$sheet->setCellValue('G'.$x, $row->x3);
			$sheet->setCellValue('H'.$x, $row->x2);
			$sheet->setCellValue('I'.$x, $row->x1);
		
			$x++;
		}
		
		
		$writer = new Xlsx($spreadsheet);
		$filename = $data['option'].'_'.$get.'_'.$data['tgl1'].'_'.$data['tgl2'];
		
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
		header('Cache-Control: max-age=0');

		$writer->save('php://output');
	}

	public function report_response_time()
	{
		
	}

	public function report_rating_feedback()
	{
		
	}

	public function report_permintaan_bantuan()
	{
		
	}

	public function report_waktu_penanganan()
	{
		
	}


	public function ajax_list_laporan_management()
	{
		$list = $this->laporan->make_datatables();

		$data = array(); 
        
        foreach ($list as $item) {

			$rating='<div id="basic" class="star-rating" style="width: 160px; height: 32px; background-size: 32px;" title="5/5"><div class="star-value" style="background-size: 32px; width: 0%;"></div></div>';
			
			$waktu=explode(" ",$item->laporan_created_timestamp);
			$waktu_str=$waktu[0]."</br>".$waktu[1];
			
            $row = array();
			$row[] = $item->laporan_id;
			$row[] = $item->laporan_name;
			$row[] = $item->laporan_phone_no;
			$row[] = $item->ruas_name;
			$row[] = $item->laporan_km;
			$row[] = $item->laporan_jalur;
			$row[] = $item->laporan_vehicle_category;
			$row[] = $item->laporan_plat_no;
			$row[] = $item->status_name;		
			$row[] = $item->feedback_rate;
            $data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->laporan->get_all_data(),
			"recordsFiltered" => $this->laporan->get_filtered_data(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	public function ajax_list_user()
	{
		$list = $this->user->make_datatables();

		$data = array(); 
        
        foreach ($list as $item) {

			$button='<div class="btn-group" role="group" aria-label="Basic example">
						<button type="button" onclick="editUser('.$item->user_id.')" class="btn btn-warning"><i class="fa fa-edit"></i></button>
						<button type="button" onclick="deleteUser('.$item->user_id.')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
					</div>';


            $row = array();
			$row[] = $item->user_id;
			$row[] = $item->username;
			$row[] = $item->npp;	
			$row[] = $item->jabatan;
			$row[] = $item->group_name;			
			$row[] = $button;
            $data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->user->get_all_data(),
			"recordsFiltered" => $this->user->get_filtered_data(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	public function laporanOngoing()
	{
		$get=$this->management->getlaporanOngoing();	
		
		echo json_encode($get);
	}
	
}