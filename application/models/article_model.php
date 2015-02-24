<?php
class Article_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	public function GetArticleByID($id, $lang){
		$this->db->cache_on();
		return $this->db->join("article_language", "article_language.article_id = article.article_id")->join("language", "language.lang_id=article_language.lang_id")->
		where("article.menu_id = ".$id.($lang!=""?" and language.language = '".$lang."'":""))->get("article");
	}
}