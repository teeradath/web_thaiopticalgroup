<?php
class financial_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	public function GetFinancial_front($lang='th'){
		$this->db->cache_on();
		$rs = $this->db->limit(5)->order_by('year desc')->get('financial')->result_array();
		for($i=0; $i < count($rs); $i++){
			$rs2 = $this->db->limit(5)->order_by('financial_upload.upload_id desc')->
				join('language','financial_upload.lang_id = language.lang_id')->where("language.language = '".$lang."' and financial_upload.financial_id = ".$rs[$i]['financial_id'])->
				select('financial_upload.text, financial_upload.url_file')->get('financial_upload')->result_array();
			$rs[$i]['financial_upload'] = $rs2; 
		}
		 return $rs;
	}
	
	public function GetFinancial_front_archive($last_year,$lang='th'){
		$this->db->cache_on();
		$archive = $this->db->limit(15)->order_by('year desc')->where('year < '.$last_year)->get('financial')->result_array();
		if(count($archive)>0){
			for($i=0; $i < count($archive); $i++){
				$rs = $this->db->limit(5)->order_by('financial_upload.upload_id desc')->
					join('language','financial_upload.lang_id = language.lang_id')->where("language.language = '".$lang."' and financial_upload.financial_id = ".$archive[$i]['financial_id'])->
					select('financial_upload.text, financial_upload.url_file')->get('financial_upload')->result_array();
				$archive[$i]['financial_upload'] = $rs; 
			}
		}
		return $archive;
	}
	
	public function GetFinancial_admin($perPage,$numberPage){
		return $this->db->limit($perPage,$numberPage)->order_by('year desc')->get('financial')->result_array();
	}
	
	public function GetFinancial_Search($keyword){
		return $this->db->order_by('year desc')->where("year like '%".$keyword."%'")->get('financial')->result_array();
	}
	
	public function GetFinancial_upload($id){
		return $this->db->order_by('upload_id desc')->join('language', 'financial_upload.lang_id = language.lang_id')->
		where("financial_upload.financial_id = '".$id."'")->get('financial_upload')->result_array();
	}
}