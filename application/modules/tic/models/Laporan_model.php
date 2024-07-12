<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {
    
    var $table              = 'list_laporan';
    var $select_column      = array('list_laporan.laporan_id','list_laporan.laporan_created_timestamp','list_laporan.laporan_name','list_laporan.laporan_phone_no','list_laporan.laporan_vehicle_category','list_laporan.laporan_problem_category','list_laporan.laporan_plat_no','list_laporan.laporan_ruas_id','list_laporan.laporan_jalur','list_laporan.laporan_description',
                                    'list_laporan.status_id','list_laporan.cso_id','list_laporan.command_center_id','list_laporan.tic_id','list_laporan.laporan_km','list_laporan.laporan_priority_status_id','management_ruas.ruas_name','management_jenis_kendala.kendala','status_laporan_reference.status_name',
                                    'a.username as normal_priority_name','list_laporan.created_at as normal_priority_time','b.username as medium_priority_name','list_laporan.laporan_medium_priority_created_timestamp as medium_priority_time',
                                    'c.username as high_priority_name','list_laporan.laporan_high_priority_created_timestamp as high_priority_time','list_laporan.kendaraan_assigned');

    var $order_column       = array('laporan_id','laporan_created_timestamp','laporan_name','laporan_phone_no','laporan_vehicle_category','laporan_problem_category','laporan_plat_no','laporan_ruas_id','laporan_jalur','laporan_description',
                                    'list_laporan.status_id','cso_id','command_center_id','tic_id','laporan_km','laporan_priority_status_id','management_ruas.ruas_name','management_jenis_kendala.kendala','status_laporan_reference.status_name',
                                    'a.username as normal_priority_name','created_at as normal_priority_time','b.username as medium_priority_name','laporan_medium_priority_created_timestamp as medium_priority_time',
                                    'c.username as high_priority_name','laporan_high_priority_created_timestamp as high_priority_time');

    var $select_column_n      = array('list_laporan.laporan_created_timestamp','list_laporan.laporan_name','list_laporan.laporan_phone_no','management_ruas.ruas_name','list_laporan.laporan_km',
                                      'list_laporan.laporan_jalur','list_laporan.laporan_description','management_jenis_kendala.kendala','status_laporan_reference.status_name');

    public function make_query($id)
    {
      
        $this->db->select($this->select_column);
        $this->db->from($this->table);
        $this->db->join('management_ruas', 'management_ruas.ruas_id = list_laporan.laporan_ruas_id','left');
        $this->db->join('management_jenis_kendala', 'management_jenis_kendala.kendala_id = list_laporan.laporan_problem_category','left');
        $this->db->join('status_laporan_reference', 'status_laporan_reference.status_id = list_laporan.status_id','left');
        $this->db->join('user_management a', 'a.npp = list_laporan.created_by','left');
        $this->db->join('user_management b', 'b.npp = list_laporan.medium_created_by','left');
        $this->db->join('user_management c', 'c.npp = list_laporan.high_created_by','left');
        
        //$this->db->or_where('list_laporan.laporan_assigned_ruas_id',$this->session->ruas);


        switch($id)
        {
            case 1 :
                $acc = array('2');
                //$this->db->group_start();
                // $this->db->where('list_laporan.laporan_ruas_id',$this->session->ruas);
                // $this->db->or_where('list_laporan.laporan_assigned_ruas_id ', $this->session->ruas);
                // $this->db->group_end();
                $this->db->where('IF(laporan_ruas_group_id > 0,laporan_ruas_group_id = '.$this->session->ruas_group.',laporan_ruas_id= '.$this->session->ruas.')',NULL,FALSE);
                $this->db->where_in('list_laporan.status_id ', $acc);
                $this->db->where('list_laporan.laporan_forward_to_tic_timestamp is NOT NULL', NULL, FALSE);                         
                break;
            case 2 :
                $acc = array('3','4');  
                // $this->db->group_start();
                // $this->db->where('list_laporan.laporan_ruas_id',$this->session->ruas);
                // $this->db->or_where('list_laporan.laporan_assigned_ruas_id ', $this->session->ruas);
                // $this->db->group_end(); 
                $this->db->where('IF(laporan_ruas_group_id > 0,laporan_ruas_group_id = '.$this->session->ruas_group.',laporan_ruas_id= '.$this->session->ruas.')',NULL,FALSE);              
                $this->db->where_in('list_laporan.status_id ', $acc);
                break;
            case 3 :
                $acc = array('5','6');
                // $this->db->group_start();
                // $this->db->where('list_laporan.laporan_ruas_id',$this->session->ruas);
                // $this->db->or_where('list_laporan.laporan_assigned_ruas_id ', $this->session->ruas);
                // $this->db->group_end();     
                $this->db->where('IF(laporan_ruas_group_id > 0,laporan_ruas_group_id = '.$this->session->ruas_group.',laporan_ruas_id= '.$this->session->ruas.')',NULL,FALSE);              
              
                $this->db->where('list_laporan.laporan_forward_to_tic_timestamp is NOT NULL', NULL, FALSE);               
                $this->db->where_in('list_laporan.status_id ', $acc);
                break;
        }

        $i = 0;
	
		foreach ($this->select_column_n as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					 $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					 $this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					 $this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->select_column_n) - 1 == $i) //last loop
					 $this->db->group_end(); //close bracket
			}

			$i++;
		}
       
        
        if(isset($_POST["order"]))
        {
             $this->db->order_by($this->order_column[$_POST['order']['0']['column']],$_POST['order']['0']['dir']);
        }
        else
        {
            // $this->db->order_by('FIELD(list_laporan.status_id,5,6)'); 
            // $this->db->order_by("list_laporan.laporan_priority_status_id","DESC"); 
            // $this->db->order_by("list_laporan.laporan_id","ASC");    
            switch($id)
            {
                case 1 :
                    //$this->db->order_by('FIELD(list_laporan.status_id,5,6)'); 
                    $this->db->order_by("list_laporan.laporan_priority_status_id","DESC"); 
                    $this->db->order_by("list_laporan.laporan_id","ASC");                                    
                    break;
                case 2 :
                    $this->db->order_by("list_laporan.laporan_created_timestamp","DESC");       
                    break;
                case 3 :
                    $this->db->order_by("list_laporan.laporan_created_timestamp","DESC");      
                    break;
            }
        }
        
    }

    public function make_datatables($id)
    {
        $this->make_query($id);
        if($_POST["length"] != -1)
        {
             $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query=  $this->db->get();
        return $query->result();
    }

    public function get_filtered_data($id)
    {
        $this->make_query($id);
        $query= $this->db->get();
        return $query->num_rows();
    }

    public function get_all_data()
    {
         $this->db->select('*');
         $this->db->from($this->table);
        return  $this->db->count_all_results();
    }

    




}