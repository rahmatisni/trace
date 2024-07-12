<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Management_model extends CI_Model {

    
    public function getRuasOption()
    {
        $this->db->select('*');
        $this->db->from('management_ruas');
        $this->db->order_by("ruas_id", "asc");
        return $this->db->get()->result();
    }

    public function getRoleOption()
    {
        $this->db->select('*');
        $this->db->from('user_role');
        return $this->db->get()->result();
    }

    public function cekNPPmodel($data)
    {
        $this->db->select('*');
        $this->db->from('user_management');
        $this->db->where('npp',$data['npp']);
        $this->db->where('ruas',$data['ruas']);

        return $this->db->get()->num_rows();
    }

    public function getKendalaOption()
    {
        $this->db->select('*');
        $this->db->from('management_jenis_kendala');
        return $this->db->get()->result();
    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function getDetailLaporanModel($data)
    {
        $this->db->select('*');
        $this->db->from('list_laporan');
        $this->db->where('laporan_created_timestamp',$data['waktu']);
        $this->db->where('laporan_phone_no',$data['hp']);
        $this->db->where('laporan_plat_no',$data['nopol']);
        return $this->db->get()->row();
    }

    public function getDetailLaporanByIDModel($data)
    {
        $this->db->select('list_laporan.*,management_ruas.ruas_name,management_jenis_kendala.kendala,status_laporan_reference.status_name,cso.username csnama,cc.username ccnama,tic.username ticnama,tbl_feedback.*');
        $this->db->from('list_laporan');
        $this->db->join('management_ruas', 'management_ruas.ruas_id = list_laporan.laporan_ruas_id','left');
        $this->db->join('management_jenis_kendala', 'management_jenis_kendala.kendala_id = list_laporan.laporan_problem_category','left');
        $this->db->join('status_laporan_reference', 'status_laporan_reference.status_id = list_laporan.status_id','left');
        $this->db->join('tbl_feedback', 'tbl_feedback.blast_url = list_laporan.blast_url','left');
        $this->db->join('user_management cso', 'cso.npp = list_laporan.cso_id','left');
        $this->db->join('user_management cc', 'cc.npp = list_laporan.command_center_id','left');
        $this->db->join('user_management tic', 'tic.npp = list_laporan.tic_id','left');
        $this->db->where('list_laporan.laporan_id',$data['id']);
        return $this->db->get()->row();
    }

    public function getReportingLaporanMasuk($data)
    {
   
        if($data['ruas']!='0')
        {
            $where="and a.laporan_ruas_id=".$data['ruas'];
        }else
        {
            $where="and a.laporan_ruas_id>".$data['ruas'];
        } 
        
    
       $sql="SELECT a.*,
                    b.ruas_name,
                    c.kendala,
                    d.status_name,
                    e.feedback_suggest,
                    e.feedback_rate,
                    e.feedback_comment,
                    cso.username cso_name,
                    tic.username tic_name,
                    cc.username cc_name,
                    TIMESTAMPDIFF(MINUTE,a.laporan_created_timestamp,laporan_forward_to_tic_timestamp) durasi_forward,
                    TIMESTAMPDIFF(MINUTE,a.laporan_forward_to_tic_timestamp,laporan_forward_to_petugas_timestamp) durasi_assign,
                    TIMESTAMPDIFF(MINUTE, laporan_forward_to_petugas_timestamp,a.laporan_petugas_arrived_timestamp) durasi_response_time,
                    TIMESTAMPDIFF(MINUTE,a.laporan_created_timestamp,laporan_petugas_arrived_timestamp) durasi_response_time_petugas,
                    TIMESTAMPDIFF(MINUTE,a.laporan_petugas_arrived_timestamp,laporan_closed_timestamp) waktu_penanganan,
                    TIMESTAMPDIFF(MINUTE,a.laporan_created_timestamp,laporan_closed_timestamp) waktu_pelayanan                    
                   			 
                FROM `list_laporan` a 
                LEFT JOIN management_ruas b on b.ruas_id=a.laporan_ruas_id 
                LEFT JOIN management_jenis_kendala c on c.kendala_id=a.laporan_problem_category 
                LEFT JOIN status_laporan_reference d on d.status_id=a.status_id 
                LEFT JOIN tbl_feedback e on e.blast_url=a.blast_url
                LEFT JOIN user_management cso on cso.npp=a.cso_id
                LEFT JOIN user_management cc on cc.npp=a.command_center_id
                LEFT JOIN user_management tic on tic.npp=a.tic_id
                WHERE a.laporan_name not like '%test%' and  DATE(laporan_created_timestamp) BETWEEN '".$data['tgl1']."' and '".$data['tgl2']."' ".$where." and a.status_id in(5,6);";
        
      
        $query=$this->db->query($sql);
 
        return $query->result();
    }
    
    public function getReportingDetailPetugas($data)
    {
        if($data['ruas']!='0')
        {
            $where="and b.laporan_ruas_id=".$data['ruas'];
        }else
        {
            $where="and b.laporan_ruas_id>".$data['ruas'];
        } 
        
    
       $sql="select b.laporan_name,c.nama_petugas,c.npp_petugas,b.kendaraan_assigned,b.laporan_id,b.laporan_created_timestamp,
                b.laporan_forward_to_petugas_timestamp,b.laporan_petugas_arrived_timestamp,b.laporan_closed_timestamp,d.ruas_name, 
                e.status_name,f.feedback_rate
                from tbl_operasional_petugas a
                left join list_laporan b on b.laporan_id=a.laporan_id
                left join management_petugas c on c.id_petugas=a.petugas_id
                left join management_ruas d on d.ruas_id=a.ruas_id
                left join status_laporan_reference e on e.status_id=b.status_id
                left join tbl_feedback f on f.feedback_id=b.laporan_id
                where a.waktu_selesai is not null and b.laporan_name not like '%test%' and DATE(b.laporan_created_timestamp) BETWEEN '".$data['tgl1']."' and '".$data['tgl2']."' ".$where."
                order by a.id asc";
        
      
        $query=$this->db->query($sql);
 
        return $query->result();

    }

    public function getReportingSummaryPetugas($data)
    {
        if($data['ruas']!='0')
        {
            $where="and b.laporan_ruas_id=".$data['ruas'];
        }else
        {
            $where="and b.laporan_ruas_id>".$data['ruas'];
        } 
        
    
       $sql="select b.laporan_name,d.ruas_name,g.nama_petugas,g.npp_petugas,
            COUNT(IF(f.feedback_rate=5,f.feedback_rate,null)) as 'x5',
            COUNT(IF(f.feedback_rate=4,f.feedback_rate,null)) as 'x4',
            COUNT(IF(f.feedback_rate=3,f.feedback_rate,null)) as 'x3',
            COUNT(IF(f.feedback_rate=2,f.feedback_rate,null)) as 'x2',
            COUNT(IF(f.feedback_rate=1,f.feedback_rate,null)) as 'x1',
            COUNT(IF(f.feedback_rate is null,f.feedback_rate,null)) as 'no_rate'
            from tbl_operasional_petugas a 
            left join list_laporan b on b.laporan_id=a.laporan_id
            left join management_petugas c on c.id_petugas=a.petugas_id
            left join management_ruas d on d.ruas_id=a.ruas_id
            left join tbl_feedback f on f.blast_url=b.blast_url
            left join management_petugas g on g.id_petugas=a.petugas_id
            where a.waktu_selesai is not NULL and b.laporan_name not like '%test%'  and  DATE(a.waktu_mulai) BETWEEN '".$data['tgl1']."' and '".$data['tgl2']."' ".$where."
            GROUP BY g.npp_petugas ORDER BY d.ruas_name asc";
        
      
        $query=$this->db->query($sql);
 
        return $query->result();

    }



    public function getRuasName($ruas)
    {
        if($ruas=='0')
        {
            return 'All Ruas';
        }
        else
        {
            $this->db->select('ruas_name');
            $this->db->from('management_ruas');
            $this->db->where('ruas_id',$ruas);
            return $this->db->get()->row()->ruas_name;
        }
        
    }
    
    public function getPetugasNameModel($data)
    {   
        $data=json_decode($data);
        $nama=array();

        foreach($data as $row)
        {
            $this->db->select('nama_petugas');
            $this->db->from('management_petugas');
            $this->db->where('id_petugas',$row);
            $dataz=$this->db->get()->row();
            array_push($nama, $dataz->nama_petugas);
          
        }

        return ($nama);
    }

    public function getNomoKendaraanModel($data)
    {   
        $data=json_decode($data);
        $nama=array();

        foreach($data as $row)
        {
            $this->db->select('kendaraan_nomor');
            $this->db->from('kendaraan');
            $this->db->where('kendaraan_id',$row);
            $dataz=$this->db->get()->row();
            array_push($nama, $dataz->kendaraan_nomor);
          
        }

        return ($nama);
    }

    public function AddOrEditUserModel($data)
    {
        if($data['id']=='0')
        {
            // //insert data
            $ojek = array(
                'username' => $data['nama'],
                'password' => $data['password'],
                'npp' =>  $data['npp'],
                'role' => $data['role'],
                'ruas' => $data['ruas'],
                'ruas_group' => $data['ruas_group']
            );

            $a=$this->db->insert('user_management', $ojek);
            $hasil = array('event'=>'tambah','status'=> $a);

        }else
        {
            //update
            $hasil = array('event'=>'edit','status'=>false);
        }

        return $hasil;
    }


    public function AddOrEditLaporanModel($data)
    {   
        if($data['id']=='0')
        {
            //insert data

            $query="insert into list_laporan (laporan_created_timestamp,
                                                    laporan_priority_status_id,                                                 
                                                    laporan_name,
                                                    laporan_phone_no,
                                                    laporan_vehicle_category,
                                                    laporan_problem_category,
                                                    laporan_plat_no,
                                                    laporan_ruas_id,
                                                    laporan_jalur,
                                                    laporan_description,
                                                    status_id,
                                                    cso_id,
                                                    created_at,
                                                    blast_url,
                                                    created_by,
                                                    laporan_km)
                                                values(
                                                    '".date("Y-m-d H:i:s")."',
                                                    '".$data['priority_id']."',                                                    
                                                    '".$data['nama']."',
                                                    '".$data['hp']."',
                                                    '".$data['jenis']."',
                                                    '".$data['kendala']."',
                                                    '".$data['nopol']."',
                                                    '".$data['ruas']."',
                                                    '".$data['jalur']."',
                                                    '".$data['keterangan']."',
                                                    1,
                                                    '".$this->session->npp."',
                                                    '".date("Y-m-d H:i:s")."',
                                                    '".$this->generateRandomString(10)."',
                                                    '".$data['user_id']."',
                                                    '".$data ['km']."' )
                                                    ";

            $data=$this->db->query($query);

            $result = array('event'=> 'tambah','status'=>$data);
            
            return $result;
            

        }elseif($data['id'] > 0)
        {
            if($data['priority_id']== 2)
            {
                 $update="laporan_medium_priority_created_timestamp='".date("Y-m-d H:i:s")."',medium_created_by='".$this->session->user_id."',";
            }elseif($data['priority_id']== 3)
            {
                 $update="laporan_high_priority_created_timestamp='".date("Y-m-d H:i:s")."',high_created_by='".$this->session->user_id."',";
            }else
            {
                $update='';
            }

            //update data
            $query="update list_laporan set laporan_created_timestamp='".date("Y-m-d H:i:s")."',
                                        laporan_priority_status_id='".$data['priority_id']."',                                                 
                                        laporan_name='".$data['nama']."',
                                        laporan_phone_no='".$data['hp']."',
                                        laporan_vehicle_category= '".$data['jenis']."',
                                        laporan_problem_category= '".$data['kendala']."',
                                        laporan_plat_no='".$data['nopol']."',
                                        laporan_ruas_id= '".$data['ruas']."',
                                        laporan_jalur='".$data['jalur']."',
                                        laporan_description='".$data['keterangan']."',
                                        status_id=1,
                                        cso_id= '".$this->session->npp."',
                                        $update
                                        laporan_km='".$data ['km']."'
                                        
                                        where laporan_id='".$data['id']."';
                                        ";      

                                
            $data=$this->db->query($query);

            $result = array('event'=> 'update','status'=>$data);
            
            return $result;


        }
       
    }

    public function getSummaryDataTop()
    {
        $sql="SELECT count(laporan_id) as laporan_masuk,
            COUNT(if(status_id in(1,2,3,4),laporan_id,null)) as laporan_ongoing,
            COUNT(if(status_id in(5,6),laporan_id,null)) as laporan_selesai,
            (SELECT count(laporan_id)  from list_laporan_cancel) as laporan_tidak_selesai
            FROM `list_laporan` ";
        
      
        $query=$this->db->query($sql);
 
        return $query->row();
    }

    public function getSummaryGrafikLaporanMasuk()
    {
        $sql="select a.id,IFNULL(b.jumlah,0) jumlah 
        from tbl_ref_bulan a
        left join 
            (
            
            select MONTH(a.laporan_created_timestamp) bulan,count(laporan_id) jumlah from 
            (
                select * from list_laporan
                union
                select `laporan_id`, `laporan_created_timestamp`, `laporan_closed_timestamp`, `laporan_name`, `laporan_phone_no`, `laporan_vehicle_category`, `laporan_vehicle_colour`, `laporan_problem_category`, `laporan_plat_no`, `laporan_ruas_id`, `laporan_ruas_group_id`, `laporan_jalur`, `laporan_description`, `status_id`, `cso_id`, `command_center_id`, `tic_id`, `laporan_forward_to_tic_timestamp`, `laporan_forward_to_petugas_timestamp`, `laporan_priority_status_id`, `laporan_medium_priority_created_timestamp`, `laporan_high_priority_created_timestamp`, `data_petugas_id`, `kendaraan_assigned`, `created_at`, `updated_at`, `laporan_km`, `feedback_id`, `blast_state`, `blast_at`, `blast_url`, `laporan_petugas_arrived_timestamp`, `laporan_assigned_ruas_id`, `medium_created_by`, `high_created_by`, `created_by` from list_laporan_cancel
            ) a
            GROUP BY MONTH(a.laporan_created_timestamp)
        )b on a.id=b.bulan";
    
  
        $query=$this->db->query($sql);

        return $query->result();
    }

    public function getSummaryGrafikLaporanMasukByTahun($tahun)
    {
        $sql="select a.id,IFNULL(b.jumlah,0) jumlah 
        from tbl_ref_bulan a
        left join 
            (
            
            select MONTH(a.laporan_created_timestamp) bulan,count(laporan_id) jumlah from 
            (
                select * from list_laporan
                union
                select `laporan_id`, `laporan_created_timestamp`, `laporan_closed_timestamp`, `laporan_name`, `laporan_phone_no`, `laporan_vehicle_category`, `laporan_vehicle_colour`, `laporan_problem_category`, `laporan_plat_no`, `laporan_ruas_id`, `laporan_ruas_group_id`, `laporan_jalur`, `laporan_description`, `status_id`, `cso_id`, `command_center_id`, `tic_id`, `laporan_forward_to_tic_timestamp`, `laporan_forward_to_petugas_timestamp`, `laporan_priority_status_id`, `laporan_medium_priority_created_timestamp`, `laporan_high_priority_created_timestamp`, `data_petugas_id`, `kendaraan_assigned`, `created_at`, `updated_at`, `laporan_km`, `feedback_id`, `blast_state`, `blast_at`, `blast_url`, `laporan_petugas_arrived_timestamp`, `laporan_assigned_ruas_id`, `medium_created_by`, `high_created_by`, `created_by` from list_laporan_cancel
            ) a WHERE YEAR ( laporan_created_timestamp )= '".$tahun."' 
            GROUP BY MONTH(a.laporan_created_timestamp)
        )b on a.id=b.bulan";
    
  
        $query=$this->db->query($sql);

        return $query->result();
    }

    public function getSummaryRatingLaporanMasuk()
    {
        $sql="select DISTINCT(feedback_rate) rating, count(feedback_rate) jumlah from tbl_feedback group by feedback_rate desc";

        $query=$this->db->query($sql);

        return $query->result();
    }

    public function getSummaryBlastStatus()
    {
        $sql="SELECT * FROM `unsent_kuesioner`";

        $query=$this->db->query($sql);

        return $query->result();
    }

    

    public function getSummaryAllruasPetugas()
    {
        $sql="select jenis_petugas, COUNT(id_petugas) jumlah from management_petugas GROUP BY jenis_petugas";
    
  
        $query=$this->db->query($sql);

        return $query->result();
    }

    public function getSummaryAllruasAgent()
    {
        $sql="select role, COUNT(user_id) jumlah from user_management where role != 4 GROUP BY role ";
    
  
        $query=$this->db->query($sql);

        return $query->result();
    }

    public function getSummaryAllruasKendaraan()
    {
        $sql="select kendaraan_jenis, COUNT(kendaraan_id) jumlah from kendaraan GROUP BY kendaraan_jenis";
    
  
        $query=$this->db->query($sql);

        return $query->result();
    }

    public function getlaporanOngoing()
    {
        $ignore = array(5,6);
        $this->db->select('list_laporan.laporan_name,list_laporan.laporan_phone_no,list_laporan.laporan_km,list_laporan.laporan_created_timestamp,management_ruas.ruas_name,status_laporan_reference.status_name');
        $this->db->from('list_laporan');        
        $this->db->join('management_ruas', 'management_ruas.ruas_id = list_laporan.laporan_ruas_id','left');
        // $this->db->join('management_jenis_kendala', 'management_jenis_kendala.kendala_id = list_laporan.laporan_problem_category','left');
        $this->db->join('status_laporan_reference', 'status_laporan_reference.status_id = list_laporan.status_id','left');
        $this->db->where_not_in('list_laporan.status_id ', $ignore);  

        return $this->db->get()->result();
    }
   
}