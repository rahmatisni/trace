<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CommandCenter_model extends CI_Model {

    
    public function getRuasOption()
    {
        $this->db->select('*');
        $this->db->from('management_ruas');
        $this->db->order_by("ruas_id", "asc");
        return $this->db->get()->result();
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
    
    public function assignRuasModel($data)
    {   
        $this->db->set('laporan_forward_to_tic_timestamp', date('Y-m-d H:i:s'));
        $this->db->set('command_center_id', $data['user_id']);
        $this->db->set('status_id', 2);
        $this->db->set('laporan_assigned_ruas_id', $data['ruas']);
        $this->db->where('laporan_id', $data['id']);
        $data = $this->db->update('list_laporan');

        return $data;
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



   
}