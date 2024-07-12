<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();	
		$this->load->database('default');	
	}
	
	public function login($data)
	{
		$this->db->select('user_management.user_id,user_management.username,user_management.npp,user_management.role,user_management.ruas,user_role.role as jabatan,user_management.ruas_group,management_group_ruas.group_name,management_ruas.ruas_name');
		$this->db->from('user_management');
		$this->db->join('user_role','user_role.role_id = user_management.role');
		$this->db->join('management_group_ruas','management_group_ruas.group_id = user_management.ruas_group');
		$this->db->join('management_ruas','management_ruas.ruas_id = user_management.ruas');
		$this->db->where('user_management.npp',$data['username']);
		$this->db->where('user_management.password',$data['password']);
		
		$query=$this->db->get(); 
		
		return $query->row();
		 	
	}

}
