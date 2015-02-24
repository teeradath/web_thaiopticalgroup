<?php
class Annual_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	public function GetAnnual($year,$lang){
		return $this->db->limit(5)->join('language', 'language.lang_id = annual_report.lang_id')->
				order_by('annual_report.year desc')->where("language.language = '".$lang."' ".($year!=0?"and annual_report.year <= ".$year:""))->get('annual_report')->result_array();
	}
	
	public function GetOlder($year,$lang){
	
		return $this->db->limit(1)->order_by("annual_report.year desc")->
		join("language", "annual_report.lang_id = language.lang_id")->where("annual_report.year < '".$year."' and language.language = '".$lang."'")->
		get("annual_report");
	}
	
	public function GetNewer($year,$lang){
		$rs = $this->db->limit(5)->order_by("annual_report.year asc")->
		join("language", "annual_report.lang_id = language.lang_id")->where("annual_report.year > '".$year."' and language.language = '".$lang."'")->
		get("annual_report")->result_array();
		return @$rs[count($rs)-1]['year'];
	}
	
	public function GetAnnual_list($perPage,$numberPage,$lang='th'){
		return $this->db->limit($perPage,$numberPage)->order_by('year desc')->join("language", "annual_report.lang_id = language.lang_id")->
				where("language.language = '".$lang."'")->get('annual_report')->result_array();
	}
	
	public function GetAnnual_list_Search($keyword,$lang='th'){
		return $this->db->order_by('year desc')->join("language", "annual_report.lang_id = language.lang_id")->
		where("language.language = '".$lang."' and annual_report.year like '%".$keyword."%'")->get('annual_report')->result_array();
	}
	
	public function GetAnnual_ByID($id){
		return $this->db->order_by('year desc')->join("language", "annual_report.lang_id = language.lang_id")->
		where("annual_report.id = '".$id."'")->get('annual_report')->result_array();
	}
	
}