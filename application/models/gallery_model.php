<?php
class Gallery_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	public function GetGallery($lang){
		return $this->db->limit(8)->join('gallery_language', 'gallery_language.gal_id = gallery.gal_id')->
		join('language', 'language.lang_id = gallery_language.lang_id')->order_by('gallery.gal_date desc')->
		select('gallery.gal_id, gallery.gal_image_url, gallery_language.gal_category, gallery_language.gal_description')->
		where("language.language = '".$lang."'")->get('gallery')->result_array();
	}
}