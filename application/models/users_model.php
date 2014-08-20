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
}