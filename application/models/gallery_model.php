<?php
class Gallery_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	public function GetGallery($lang){
		return $this->db->limit(4)->join('gallery_language', 'gallery_language.gal_id = gallery.gal_id')->
		join('language', 'language.lang_id = gallery_language.lang_id')->order_by('gallery.gal_date desc')->where("language.language = '".$lang."'")->
		select('gallery.gal_id, gallery.gal_image_url, gallery_language.gal_category, gallery_language.gal_description')->get('gallery');
	}
	
	public function GetGallery_list($perPage,$numberPage,$lang = 'th'){
		return $this->db->limit($perPage,$numberPage)->join('gallery_language', 'gallery_language.gal_id = gallery.gal_id')->
		join('language', 'language.lang_id = gallery_language.lang_id')->order_by('gallery.gal_date desc')->where("language.language = '".$lang."'")->
		select('gallery.gal_id, gallery.gal_image_url, gallery.gal_date, gallery_language.gal_category, gallery_language.gal_description')->get('gallery');
	}
	
	public function GetGallerySearch($keyword,$lang = 'th'){
		return $this->db->join('gallery_language', 'gallery_language.gal_id = gallery.gal_id')->
		join('language', 'language.lang_id = gallery_language.lang_id')->order_by('gallery.gal_date desc')->
		where("language.language = '".$lang."'
				and ( gallery.gal_date >= '".$keyword."' and gallery.gal_date <= now() or
					 gallery_language.gal_category like '%".$keyword."%' or
					 gallery_language.gal_description like '%".$keyword."%'
					)
				")->
		select('gallery.gal_id, gallery.gal_image_url, gallery.gal_date, gallery_language.gal_category, gallery_language.gal_description')->get('gallery');
	}
	
	public function GetGalleryByID($id,$lang){
		return $this->db->join('gallery_language', 'gallery_language.gal_id = gallery.gal_id')->
		join('language', 'language.lang_id = gallery_language.lang_id')->order_by('gallery.gal_date desc')->where("gallery.gal_id = ".$id.($lang!=""?" and language.language = '".$lang."'":""))->
		select('gallery.gal_id, gallery.gal_image_url, gallery.gal_date, gallery_language.gal_category, gallery_language.gal_description, gallery_language.gal_text, language.*')->get('gallery');
	}

}