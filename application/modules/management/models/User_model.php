<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    
    var $table              = 'user_management';
    var $select_column      =  array('user_management.user_id','user_management.username','user_management.password','user_management.npp','user_management.role','user_management.ruas','user_management.ruas_group','management_ruas.ruas_name','user_role.role as jabatan','management_group_ruas.group_name');
    var $order_column      =  array('user_management.user_id','user_management.username','user_management.password','user_management.npp','user_management.role','user_management.ruas','user_management.ruas_group','management_ruas.ruas_name','user_role.role as jabatan','management_group_ruas.group_name');
  
    var $select_columnx      =  array('user_management.user_id','user_management.username','user_management.npp','management_ruas.ruas_name','user_role.role','management_group_ruas.group_name');

    public function make_query()
    {
      
        $this->db->select($this->select_column);
        $this->db->from($this->table);
        $this->db->join('management_ruas', 'management_ruas.ruas_id = user_management.ruas','left');
        $this->db->join('user_role', 'user_role.role_id = user_management.role','left');
        $this->db->join('management_group_ruas', 'management_group_ruas.group_id = user_management.ruas_group','left');

        $i = 0;
	
		foreach ($this->select_columnx as $item) // loop column 
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

				if(count($this->select_columnx) - 1 == $i) //last loop
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
             $this->db->order_by("user_management.user_id","ASC");
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