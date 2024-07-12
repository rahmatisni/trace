<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kendaraan_model extends CI_Model {
    
    var $table              = 'kendaraan';
    var $select_column      = array('kendaraan.kendaraan_id','kendaraan.kendaraan_jenis','kendaraan.kendaraan_nomor','kendaraan.ruas_id','kendaraan.status','management_ruas.ruas_name','management_jenis_kendaraan.jenis_kendaraan');
    var $order_column       = array('kendaraan.kendaraan_id','kendaraan.kendaraan_jenis','kendaraan.kendaraan_nomor','kendaraan.ruas_id','kendaraan.status','management_ruas.ruas_name','management_jenis_kendaraan.jenis_kendaraan');
    var $select_column_x      = array('kendaraan.kendaraan_nomor','management_jenis_kendaraan.jenis_kendaraan','management_ruas.ruas_name');
    public function make_query()
    {
      
        $this->db->select($this->select_column);
        $this->db->from($this->table);
       
        $this->db->join('management_ruas', 'management_ruas.ruas_id = kendaraan.ruas_id','left');
        $this->db->join('management_jenis_kendaraan', 'management_jenis_kendaraan.jenis_kendaraan_id = kendaraan.kendaraan_jenis','left');
        $this->db->where('IF(kendaraan.group_ruas > 0,kendaraan.group_ruas = '.$this->session->ruas_group.',kendaraan.ruas_id= '.$this->session->ruas.')',NULL,FALSE);    

        $i = 0;
	
		foreach ($this->select_column_x as $item) // loop column 
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

				if(count($this->select_column_x) - 1 == $i) //last loop
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
            $this->db->order_by("kendaraan.status","DESC");
            $this->db->order_by("kendaraan.kendaraan_jenis","ASC");
            $this->db->order_by("kendaraan.kendaraan_nomor","ASC");
        }
        
    }

    public function make_datatables()
    {
        $this->make_query();
        if($_POST["length"] != -1)
        {
             $this->db->limit($_POST['length'], $_POST['start']);
        }
        $query=  $this->db->get();
        return $query->result();
    }

    public function get_filtered_data()
    {
        $this->make_query();
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