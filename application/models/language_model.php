<?php
class Language_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	public function GetLangusge(){
		$this->db->cache_on();
		return $this->db->where("is_disable = 0")->order_by("lang_id")->get("language");
	}
}