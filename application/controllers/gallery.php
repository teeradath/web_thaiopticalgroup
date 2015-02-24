<?php
class Gallery extends CI_Controller{
	public function index(){
		//@ delete sess Active Menu
		$this->session->unset_userdata('activeTopMenu_id');
		
		$this->load->library('load_language');
		 //@ friendly Url
		$this->load->library('url_friendly');
		
		if($this->input->post('search')!=null && $this->input->post('keyword')!=''){
			$this->load->model('gallery_model');
			$data['gallery_list'] = $this->gallery_model->GetGallerySearch($this->input->post('keyword'),$this->session->userdata('lang_id'))->result_array();
			$data['keyword']=  $this->input->post('keyword');
		}else {
			// pagination --------------------------------------------
			$this->setConfigPagination($config);
			$this->pagination->initialize($config);
			$data['pagination'] = $this->pagination->create_links();
			//--------------------------------------------------------
			//Get Gallery List
			$this->load->model('gallery_model');
			$data['gallery_list'] = $this->gallery_model->GetGallery_list($config["per_page"],$this->uri->segment(2),$this->session->userdata('lang_id'))->result_array();
		}
		//init Template
		$this->template->title = 'Gallery | ThaiOpricalGroup';
		$this->template->content_data = $data;
		$this->template->load_template('gallery/gallery_all');
	}
	
	public function gallery_detail($gal_cat,$gal_id){
		/*//-----------------------------------------------------------------------------
		$this->load->library('load_language');
		//@ friendly Url
		$this->load->library('url_friendly');
		//Get image Gallery
		$this->load->model('gallery_model');
		$roww = $this->gallery_model->GetGalleryByID($gal_id,$this->session->userdata('lang_id'))->row();
		$data['row_gallery'] = $roww;
		$data['arr_gallery_img'] = $this->gallery_model->GetGalleryImageID($gal_id)->result_array();
		$data['newer_id'] = $this->gallery_model->GetGalleryNewer($roww->gal_date,$this->session->userdata('lang_id'))->row();
		$data['older_id'] = $this->gallery_model->GetGalleryOlder($roww->gal_date,$this->session->userdata('lang_id'))->row();
		
		//@insert Gallery View
		$view = $this->db->where('gal_id = '.$gal_id)->select('gal_views')->get('gallery')->row();
		$this->db->update('gallery',array('gal_views'=> $view->gal_views+1),'gal_id = '.$gal_id);
		$data['view'] = $view->gal_views;
		//init Template
		$this->template->title = $gal_cat.' | ThaiOpricalGroup';
		$this->template->content_data = $data;
		$this->template->load_template('gallery/gallery_detail');
		//---------------------------------------------------------------------------------*/
		//@ delete sess Active Menu
		$this->session->unset_userdata('activeTopMenu_id');
	
		$this->load->library('load_language');
		//@ friendly Url
		$this->load->library('url_friendly');
		//Get image Gallery
		$this->load->model('gallery_model');
		$roww = $this->gallery_model->GetGalleryByID($gal_id,$this->session->userdata('lang_id'))->row();
		//@insert Gallery View
		$view = $this->db->where('gal_id = '.$gal_id)->select('gal_views')->get('gallery')->row();
		$this->db->update('gallery',array('gal_views'=> $view->gal_views+1),'gal_id = '.$gal_id);
		
		$data['title'] = $gal_cat.' | ThaiOpricalGroup';
		$data['row_gallery'] = $roww;
		$data['arr_gallery_img'] = $this->gallery_model->GetGalleryImageID2($gal_id,$roww->gal_date,$this->session->userdata('lang_id'));
		$this->load->view('gallery/gallery_image',$data);
	}
	
	// Config Pagination Class Bootstrap----------------------------------------------------
	public function setConfigPagination(&$config){
	
		$config["base_url"] = base_url("Gallery.html/");
		$config["uri_segment"] = 2;
		$config["per_page"] = 20;
		$total_row = $this->db->join("gallery_language", "gallery_language.gal_id = gallery.gal_id")->join("language", "gallery_language.lang_id = language.lang_id")->where("language.language = '".$this->session->userdata('lang_id')."'")->get("gallery")->num_rows();
		$config["total_rows"] = $total_row;
		$config['full_tag_open'] = '<ul class="pagination" style="margin: 0">';
		$config['full_tag_close'] = '</ul>';
		$config['prev_link'] = '&laquo;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['first_link'] = FALSE;
		$config['last_link'] = FALSE;
	
	}
	//------------------------------------------------------------------
}