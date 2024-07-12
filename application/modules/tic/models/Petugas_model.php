<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas_model extends CI_Model {
    
    var $table              = 'management_petugas';
    var $select_column      = array( 'management_petugas.nama_petugas', 'management_petugas.jenis_petugas', 'management_petugas.ruas_id', 'management_petugas.nik_petugas','management_petugas.npp_petugas','management_petugas.no_hp','management_ruas.ruas_name','management_jenis_kendaraan.jenis_kendaraan','management_petugas.status');
    var $order_column       = array( 'management_petugas.nama_petugas', 'management_petugas.nik_petugas','management_petugas.npp_petugas','management_petugas.no_hp','management_ruas.ruas_name');
    var $select_column_x       = array( 'management_petugas.npp_petugas','management_petugas.nama_petugas','management_jenis_kendaraan.jenis_kendaraan','management_ruas.ruas_name','management_petugas.no_hp');
    public function make_query()
    {
      
        $this->db->select($this->select_column);
        $this->db->from($this->table);
       
        $this->db->join('management_ruas', 'management_ruas.ruas_id = management_petugas.ruas_id','left');
        $this->db->join('management_jenis_kendaraan', 'management_jenis_kendaraan.jenis_kendaraan_id = management_petugas.jenis_petugas','left');

        
        $this->db->where('IF(management_petugas.ruas_group_id > 0,management_petugas.ruas_group_id = '.$this->session->ruas_group.',management_petugas.ruas_id= '.$this->session->ruas.')',NULL,FALSE);              
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
             $this->db->order_by("nama_petugas","ASC");
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