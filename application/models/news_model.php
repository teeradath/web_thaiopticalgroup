<?php
class News_model extends CI_Model{
	public function __construct() {
		parent::__construct();
	}
	//@Show News from Language
	public function GetNews($lang = 'th'){
		$this->db->cache_on();
		return $this->db->limit(3)->order_by("news.news_date desc")->
		join("news_language", "news_language.news_id = news.news_id")->join("language", "news_language.lang_id = language.lang_id")->
		where("language.language = '".$lang."' and is_front_page = 1")->
		select('news.news_id, news.news_date, news.is_front_page, news_language.news_title, news_language.news_description')->get("news");
	}
	
	//@Search News from Language
	public function GetNewsSearch($keyword,$lang = 'th'){
		return $this->db->order_by("news.news_date desc")->
		join("news_language", "news_language.news_id = news.news_id")->join("language", "news_language.lang_id = language.lang_id")->
		where("language.language = '".$lang."'
				and (news.news_date >= '".$keyword."' and news.news_date <= now() or
					 news_language.news_title like '%".$keyword."%' or
					 news_language.news_description like '%".$keyword."%'
					)
				")->
		select('news.news_id, news.news_date, news.is_front_page , news.news_view, news_language.news_title, news_language.news_description')->get("news");
	}
	
	public function GetNews_list($perPage,$numberPage,$lang = 'th'){
		$this->db->cache_on();
		return $this->db->limit($perPage,$numberPage)->order_by("news.news_date desc")->
		join("news_language", "news_language.news_id = news.news_id")->join("language", "news_language.lang_id = language.lang_id")->
		where("language.language = '".$lang."'")->select('news.news_id, news.news_date, news.is_front_page, news_language.news_title, news.news_view, news_language.news_description')->get("news");
	}
	
	public function GetNewsByID($id,$lang){
		return $this->db->order_by("news.news_date desc")->
		join("news_language", "news_language.news_id = news.news_id")->join("language", "news_language.lang_id = language.lang_id")->
		where("news.news_id = ".$id.($lang!=""?" and language.language = '".$lang."'":""))->
		select('news.news_id, news.news_date, news.is_front_page, news_language.news_title, news_language.news_description, news_language.news_text, language.*')->get("news");
	}
	
	public function GetNewsOlder($news_date,$lang){
		return $this->db->limit(1)->order_by("news.news_date desc")->
		join("news_language", "news_language.news_id = news.news_id")->join("language", "news_language.lang_id = language.lang_id")->
		where("news.news_date < '".$news_date."' and language.language = '".$lang."'")->
		select('news.news_id, news_language.news_title')->get("news");
	}
	
	public function GetNewsNewer($news_date,$lang){
		return $this->db->limit(1)->order_by("news.news_date asc")->
		join("news_language", "news_language.news_id = news.news_id")->join("language", "news_language.lang_id = language.lang_id")->
		where("news.news_date > '".$news_date."' and language.language = '".$lang."'")->
		select('news.news_id, news_language.news_title')->get("news");
	}
	
}