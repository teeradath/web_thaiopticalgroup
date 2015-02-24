<?php
class Gallery_model extends CI_Model{
	public function __construct(){
		parent::__construct();
	}
	
	public function GetGallery($lang){
		$this->db->cache_on();
		return $this->db->limit(4)->join('gallery_language', 'gallery_language.gal_id = gallery.gal_id')->
		join('language', 'language.lang_id = gallery_language.lang_id')->order_by('gallery.gal_date desc')->where("language.language = '".$lang."'")->
		select('gallery.gal_id, gallery.gal_image_url, gallery_language.gal_category, gallery_language.gal_description')->get('gallery');
	}
	
	public function GetGallery_list($perPage,$numberPage,$lang = 'th'){
		$this->db->cache_on();
		return $this->db->limit($perPage,$numberPage)->join('gallery_language', 'gallery_language.gal_id = gallery.gal_id')->
		join('language', 'language.lang_id = gallery_language.lang_id')->order_by('gallery.gal_date desc')->where("language.language = '".$lang."'")->
		select('gallery.gal_id, gallery.gal_image_url, gallery.gal_date, gallery.gal_views, gallery_language.gal_category, gallery_language.gal_description')->get('gallery');
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
		select('gallery.gal_id, gallery.gal_image_url, gallery.gal_date, gallery.gal_views, gallery_language.gal_category, gallery_language.gal_description')->get('gallery');
	}
	
	public function GetGalleryByID($id,$lang){
		return $this->db->join('gallery_language', 'gallery_language.gal_id = gallery.gal_id')->
		join('language', 'language.lang_id = gallery_language.lang_id')->order_by('gallery.gal_date desc')->where("gallery.gal_id = ".$id.($lang!=""?" and language.language = '".$lang."'":""))->
		select('gallery.gal_id, gallery.gal_image_url, gallery.gal_date, gallery_language.gal_category, gallery_language.gal_description, gallery_language.gal_text, language.*')->get('gallery');
	}
	
	public function GetGalleryImageID($id){
		return $this->db->join('gallery', 'gallery_images.gal_id = gallery.gal_id')->
		order_by('gallery_images.img_id desc')->where("gallery.gal_id = ".$id)->
		select('gallery.gal_id,gallery_images.img_id,gallery_images.gal_id,gallery_images.image_url')->get('gallery_images');
	}
	
	public function GetGalleryImageID2($id,$date,$lang){
		$this->db->cache_on;
		$rs = $this->db->limit(4)->join('gallery_language', 'gallery_language.gal_id = gallery.gal_id')->join('language', 'language.lang_id = gallery_language.lang_id')->
		order_by('gallery.gal_date desc')->where("(gallery.gal_id = ".$id." or gallery.gal_date<'".$date."') and language.language = '".$lang."'")->
		select('gallery.gal_id, gallery.gal_date, gallery_language.gal_category')->get('gallery')->result_array();
		for($i=0;$i<count($rs);$i++){
			$rs_img = $this->db->order_by('gallery_images.img_id desc')->where("gallery_images.gal_id = ".$rs[$i]['gal_id'])->
			select('gallery_images.image_url, gallery_images.image_url_thumb')->get('gallery_images')->result_array();
			$rs[$i]['gal_img']= $rs_img;
		}
		return $rs;
	}
	
	public function GetGalleryOlder($gal_date,$lang){
		$this->db->cache_on();
		return $this->db->limit(1)->order_by("gallery.gal_date desc")->
		join("gallery_language", "gallery_language.gal_id = gallery.gal_id")->join("language", "gallery_language.lang_id = language.lang_id")->
		where("gallery.gal_date < '".$gal_date."' and language.language = '".$lang."'")->
		select('gallery.gal_id, gallery_language.gal_category')->get("gallery");
	}
	
	public function GetGalleryNewer($gal_date,$lang){
		$this->db->cache_on();
		return $this->db->limit(1)->order_by("gallery.gal_date asc")->
		join("gallery_language", "gallery_language.gal_id = gallery.gal_id")->join("language", "gallery_language.lang_id = language.lang_id")->
		where("gallery.gal_date > '".$gal_date."' and language.language = '".$lang."'")->
		select('gallery.gal_id, gallery_language.gal_category')->get("gallery");
	}
	

}