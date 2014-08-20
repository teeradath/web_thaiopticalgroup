<?php
class News_model extends CI_Model{
	public function __construct() {
		parent::__construct();
	}
	
	public function GetNews($lang = 'th'){
		$rs = $this->db->limit(5)->order_by("news.news_date desc")->
		join("news_language", "news_language.news_id = news.news_id")->join("language", "news_language.lang_id = language.lang_id")->
		where("language.language = '".$lang."' and is_front_page = 1")->select('news.news_id, news.news_date, news.is_front_page, news_language.news_title, news_language.news_description')->
		get("news");
		return $rs;
	}
	
	public function GetNews_list($perPage,$numberPage,$lang = 'th'){
		$this->db->cache_on();
		$rs = $this->db->limit($perPage,$numberPage)->order_by("news.news_date desc")->
		join("news_language", "news_language.news_id = news.news_id")->join("language", "news_language.lang_id = language.lang_id")->
		where("language.language = '".$lang."' and is_front_page = 1")->select('news.news_id, news.news_date, news.is_front_page, news_language.news_title, news_language.news_description')->
		get("news");
		return $rs;
	}
}