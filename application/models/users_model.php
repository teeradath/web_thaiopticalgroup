<?php
class Users_model extends CI_Model{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function Check_login($email,$pass){
		$rs = $this->db->join("roles", "roles.roles_id = users.roles_id")->
		where("users.is_disable = 0 and users.user_email = '".$email."' and users.user_pass = '".$pass."'")->get('users');
		return $rs;
	}
	
	public function GetUesr($email){
		return $this->db->join("roles", "roles.roles_id = users.roles_id")->
		where("users.is_disable = 0 and users.user_email = '".$email."'")->get('users');

	}
	
	public function GetUesrList($per_page,$page){
		return $this->db->limit($per_page,$page)->join("roles", "roles.roles_id = users.roles_id")->get('users')->result_array();
	
	}
	
	public function GetUesrSearch($keyword){
		return $this->db->join("roles", "roles.roles_id = users.roles_id")
		->where("users.user_email like '%".$keyword."%' or users.full_name like '%".$keyword."%' or roles.roles_name like '%".$keyword."%'")
		->get('users')->result_array();
	
	}
	
	public function GetUesrList_byID($id){
		return $this->db->join("roles", "roles.roles_id = users.roles_id")->where("users.user_id = ".$id)->get('users')->row();
	
	}
	
	public function GetComboRoles(){
		$roles_id = $this->session->userdata('sess_roles');
		$rs = $this->db->where($roles_id==1?"roles_id > 0":"roles_id > 1")->get('roles')->result_array();
		foreach ($rs as $row){
			$options[$row['roles_id']] = $row['roles_name'];
		}
		return $options;
	}
	public function GetComboRoles_add(){
		$roles_id = $this->session->userdata('sess_roles');
		$options[""] = "-- Select --";
		$rs = $this->db->where($roles_id==1?"roles_id > 0":"roles_id > 1")->get('roles')->result_array();
		foreach ($rs as $row){
			$options[$row['roles_id']] = $row['roles_name'];
		}
		return $options;
	}
}