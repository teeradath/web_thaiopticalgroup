<?php
class Form_56_1_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	public function GetForm56($perPage,$numberPage,$lang){
		return $this->db->limit($perPage,$numberPage)->join('language', 'language.lang_id = form_56_1.lang_id')->
				order_by('form_56_1.form_year desc')->where("language.language = '".$lang."'")->get('form_56_1')->result_array();
	}
	
	public function GetForm56_search($keyword,$lang){
		return $this->db->join('language', 'language.lang_id = form_56_1.lang_id')->
		order_by('form_56_1.form_year desc')->where("language.language = '".$lang."' and form_56_1.form_year like '%".$keyword."%'")->get('form_56_1')->result_array();
	}
	
	public function GetForm56_ByID($id){
		return $this->db->join('language', 'language.lang_id = form_56_1.lang_id')->where("form_56_1.form_id = ".$id)->get('form_56_1')->result_array();
	}
	
}